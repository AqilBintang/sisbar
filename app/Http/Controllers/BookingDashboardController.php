<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Barber;
use Carbon\Carbon;

class BookingDashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['barber', 'service']);

        // Filter by date range
        if ($request->date_from) {
            $query->whereDate('booking_date', '>=', $request->date_from);
        }
        
        if ($request->date_to) {
            $query->whereDate('booking_date', '<=', $request->date_to);
        }

        // Filter by month/year if no specific date range
        if (!$request->date_from && !$request->date_to) {
            $month = $request->month ?? now()->month;
            $year = $request->year ?? now()->year;
            
            $query->whereMonth('booking_date', $month)
                  ->whereYear('booking_date', $year);
        }

        // Filter by barber
        if ($request->barber_id && $request->barber_id !== 'all') {
            $query->where('barber_id', $request->barber_id);
        }

        // Filter by status
        if ($request->status && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $bookings = $query->orderBy('booking_date', 'desc')
            ->orderBy('booking_time', 'desc')
            ->paginate(20);

        // Get all barbers for filter
        $barbers = Barber::active()->orderBy('name')->get();

        // Statistics
        $stats = [
            'total' => $query->count(),
            'pending' => (clone $query)->where('status', 'pending')->count(),
            'confirmed' => (clone $query)->where('status', 'confirmed')->count(),
            'completed' => (clone $query)->where('status', 'completed')->count(),
            'cancelled' => (clone $query)->where('status', 'cancelled')->count(),
        ];

        // Calendar data for current month
        $calendarData = $this->getCalendarData($request);

        return view('booking-dashboard', compact('bookings', 'barbers', 'stats', 'calendarData'));
    }

    private function getCalendarData($request)
    {
        $month = $request->month ?? now()->month;
        $year = $request->year ?? now()->year;
        
        $startDate = Carbon::create($year, $month, 1);
        $endDate = $startDate->copy()->endOfMonth();
        
        $bookings = Booking::with(['barber', 'service'])
            ->whereBetween('booking_date', [$startDate, $endDate])
            ->get()
            ->groupBy(function($booking) {
                return $booking->booking_date->format('Y-m-d');
            });

        $calendar = [];
        $current = $startDate->copy();
        
        while ($current <= $endDate) {
            $dateKey = $current->format('Y-m-d');
            $dayBookings = $bookings->get($dateKey, collect());
            
            $calendar[$dateKey] = [
                'date' => $current->copy(),
                'day' => $current->day,
                'bookings' => $dayBookings,
                'total' => $dayBookings->count(),
                'pending' => $dayBookings->where('status', 'pending')->count(),
                'confirmed' => $dayBookings->where('status', 'confirmed')->count(),
                'completed' => $dayBookings->where('status', 'completed')->count(),
            ];
            
            $current->addDay();
        }
        
        return [
            'month' => $month,
            'year' => $year,
            'month_name' => $startDate->format('F Y'),
            'calendar' => $calendar,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];
    }

    public function getBookingsForDate(Request $request)
    {
        $request->validate([
            'date' => 'required|date'
        ]);

        $bookings = Booking::with(['barber', 'service'])
            ->whereDate('booking_date', $request->date)
            ->orderBy('booking_time')
            ->get();

        return response()->json([
            'success' => true,
            'date' => Carbon::parse($request->date)->format('d F Y'),
            'bookings' => $bookings->map(function($booking) {
                return [
                    'id' => $booking->id,
                    'time' => $booking->formatted_time,
                    'customer_name' => $booking->customer_name,
                    'customer_phone' => $booking->customer_phone,
                    'barber_name' => $booking->barber->name,
                    'service_name' => $booking->service->name,
                    'service_duration' => $booking->service->duration,
                    'total_price' => $booking->total_price,
                    'formatted_price' => 'Rp ' . number_format($booking->total_price, 0, ',', '.'),
                    'status' => $booking->status,
                    'status_display' => $booking->status_display,
                    'status_color' => $booking->status_color,
                    'notes' => $booking->notes,
                ];
            })
        ]);
    }
}