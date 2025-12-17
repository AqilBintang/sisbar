<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barber;
use App\Models\BarberSchedule;
use App\Models\Booking;
use App\Models\Service;
use App\Models\BookingNotification;
use Barryvdh\DomPDF\Facade\Pdf;

use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        return view('booking.index');
    }

    public function getAvailableBarbers(Request $request)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today'
        ]);

        $date = $request->date;
        $barbers = Barber::getAvailableForDate($date);

        return response()->json([
            'success' => true,
            'date' => $date,
            'day_name' => Carbon::parse($date)->locale('id')->dayName,
            'barbers' => $barbers->map(function($barber) use ($date) {
                $dayOfWeek = strtolower(Carbon::parse($date)->format('l'));
                $schedule = $barber->schedules()->where('day_of_week', $dayOfWeek)->first();
                
                return [
                    'id' => $barber->id,
                    'name' => $barber->name,
                    'level' => $barber->level_display,
                    'photo' => $barber->photo ? asset('image/' . $barber->photo) : null,
                    'rating' => $barber->formatted_rating,
                    'specialty' => $barber->specialty,
                    'schedule' => $schedule ? $schedule->formatted_time : null,
                ];
            })
        ]);
    }

    public function getTimeSlots(Request $request)
    {
        $request->validate([
            'barber_id' => 'required|exists:barbers,id',
            'date' => 'required|date|after_or_equal:today'
        ]);

        $timeSlots = Booking::getAvailableTimeSlots($request->barber_id, $request->date);

        return response()->json([
            'success' => true,
            'time_slots' => $timeSlots
        ]);
    }

    public function getServices()
    {
        $services = Service::where('is_active', true)->orderBy('price')->get();

        return response()->json([
            'success' => true,
            'services' => $services->map(function($service) {
                return [
                    'id' => $service->id,
                    'name' => $service->name,
                    'price' => $service->price,
                    'duration' => $service->duration,
                    'formatted_price' => 'Rp ' . number_format($service->price, 0, ',', '.')
                ];
            })
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email|max:255',
            'barber_id' => 'required|exists:barbers,id',
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required|date_format:H:i',
            'payment_method' => 'required|in:cash,online',
            'notes' => 'nullable|string|max:500'
        ]);

        try {
            // Check if the time slot is still available
            $existingBooking = Booking::where('barber_id', $request->barber_id)
                ->where('booking_date', $request->booking_date)
                ->where('booking_time', $request->booking_time)
                ->whereIn('status', ['pending', 'confirmed'])
                ->first();

            if ($existingBooking) {
                return response()->json([
                    'success' => false,
                    'message' => 'Maaf, waktu tersebut sudah dibooking. Silakan pilih waktu lain.'
                ], 422);
            }

            // Get service price
            $service = Service::findOrFail($request->service_id);

            // Set status based on payment method
            $status = 'pending';
            $paymentStatus = ($request->payment_method === 'online') ? 'pending' : 'pending';

            // Create booking (handle both authenticated and test users)
            $booking = Booking::create([
                'customer_name' => $request->customer_name ?: (auth()->check() ? auth()->user()->name : 'Test User'),
                'customer_phone' => $request->customer_phone,
                'customer_email' => $request->customer_email ?: (auth()->check() ? auth()->user()->email : 'test@gmail.com'),
                'barber_id' => $request->barber_id,
                'service_id' => $request->service_id,
                'booking_date' => $request->booking_date,
                'booking_time' => $request->booking_time,
                'notes' => $request->notes,
                'total_price' => $service->price,
                'payment_method' => $request->payment_method,
                'payment_status' => $paymentStatus,
                'payment_expires_at' => $request->payment_method === 'online' ? Carbon::now()->addMinutes(5) : null,
                'status' => $status
            ]);

            // Load relasi yang diperlukan untuk notifikasi
            $booking->load(['barber', 'service']);
            
            // Create notifications for admin and barber
            try {
                BookingNotification::createForNewBooking($booking);
            } catch (\Exception $e) {
                \Log::error('Failed to create booking notification: ' . $e->getMessage());
                // Continue without failing the booking process
            }

            $message = ($request->payment_method === 'online') 
                ? 'Booking berhasil dibuat! Silakan lanjutkan pembayaran.'
                : 'Booking berhasil dibuat! Kami akan menghubungi Anda untuk konfirmasi.';

            return response()->json([
                'success' => true,
                'message' => $message,
                'booking_id' => $booking->id,
                'booking' => [
                    'id' => $booking->id,
                    'customer_name' => $booking->customer_name,
                    'customer_phone' => $booking->customer_phone,
                    'customer_email' => $booking->customer_email,
                    'barber_name' => $booking->barber->name,
                    'service_name' => $booking->service->name,
                    'date' => $booking->formatted_date,
                    'time' => $booking->formatted_time,
                    'total_price' => $booking->total_price,
                    'payment_method' => $booking->payment_method,
                    'payment_method_display' => $booking->payment_method_display,
                    'payment_status' => $booking->payment_status_display,
                    'payment_expires_at' => $booking->payment_expires_at ? $booking->payment_expires_at->toISOString() : null,
                    'status' => $booking->status_display,
                    'notes' => $booking->notes,
                    'booking_date' => $booking->booking_date,
                    'booking_time' => $booking->booking_time,
                    'service' => [
                        'name' => $booking->service->name,
                        'duration' => $booking->service->duration,
                        'price' => $booking->service->price
                    ],
                    'barber' => [
                        'name' => $booking->barber->name,
                        'level' => $booking->barber->level_display
                    ]
                ]
            ]);

        } catch (\Exception $e) {
            \Log::error('Booking Creation Error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            \Log::error('Request data: ' . json_encode($request->all()));
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat membuat booking. Silakan coba lagi.',
                'debug' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $booking = Booking::with(['barber', 'service'])->findOrFail($id);

            return response()->json([
                'success' => true,
                'booking' => [
                    'id' => $booking->id,
                    'customer_name' => $booking->customer_name,
                    'customer_phone' => $booking->customer_phone,
                    'customer_email' => $booking->customer_email,
                    'barber_name' => $booking->barber->name,
                    'service_name' => $booking->service->name,
                    'date' => $booking->formatted_date,
                    'time' => $booking->formatted_time,
                    'booking_date' => $booking->booking_date,
                    'booking_time' => $booking->booking_time,
                    'total_price' => $booking->total_price,
                    'payment_method' => $booking->payment_method,
                    'payment_method_display' => $booking->payment_method_display,
                    'payment_status' => $booking->payment_status_display,
                    'payment_expires_at' => $booking->payment_expires_at ? $booking->payment_expires_at->toISOString() : null,
                    'status' => $booking->status_display,
                    'status_color' => $booking->status_color,
                    'notes' => $booking->notes,
                    'barber' => [
                        'name' => $booking->barber->name,
                        'level' => $booking->barber->level_display,
                        'photo' => $booking->barber->photo ? asset('image/' . $booking->barber->photo) : null
                    ],
                    'service' => [
                        'name' => $booking->service->name,
                        'duration' => $booking->service->duration,
                        'price' => $booking->service->price
                    ]
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Booking tidak ditemukan.'
            ], 404);
        }
    }

    public function checkAvailability(Request $request)
    {
        $request->validate([
            'barber_id' => 'required|exists:barbers,id',
            'date' => 'required|date|after_or_equal:today'
        ]);

        $barber = Barber::findOrFail($request->barber_id);
        $isAvailable = $barber->isAvailableOnDate($request->date);

        return response()->json([
            'success' => true,
            'available' => $isAvailable,
            'barber' => $barber->name,
            'date' => $request->date
        ]);
    }



    public function checkStatus(Request $request)
    {
        $request->validate([
            'phone' => 'nullable|string',
            'booking_id' => 'nullable|integer'
        ]);

        // Validate that at least one search criteria is provided
        if (!$request->phone && !$request->booking_id) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan masukkan ID Booking atau Nomor Telepon.'
            ]);
        }

        $query = Booking::with(['barber', 'service']);

        // Search by booking ID or phone number
        if ($request->booking_id && $request->phone) {
            // If both provided, search for exact match
            $query->where('id', $request->booking_id)
                  ->where('customer_phone', $request->phone);
        } elseif ($request->booking_id) {
            // Search by booking ID only
            $query->where('id', $request->booking_id);
        } elseif ($request->phone) {
            // Search by phone number only
            $query->where('customer_phone', $request->phone);
        }

        $bookings = $query->orderBy('booking_date', 'desc')
            ->orderBy('booking_time', 'desc')
            ->limit(10)
            ->get();

        if ($bookings->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ditemukan booking dengan data yang Anda masukkan.'
            ]);
        }

        return response()->json([
            'success' => true,
            'bookings' => $bookings->map(function($booking) {
                return [
                    'id' => $booking->id,
                    'customer_name' => $booking->customer_name,
                    'barber_name' => $booking->barber->name,
                    'service_name' => $booking->service->name,
                    'date' => $booking->formatted_date,
                    'time' => $booking->formatted_time,
                    'total_price' => $booking->total_price,
                    'status' => $booking->status_display,
                    'status_color' => $booking->status_color,
                    'notes' => $booking->notes
                ];
            })
        ]);
    }

    public function downloadReceiptPDF($id)
    {
        try {
            // Validate ID
            if (!is_numeric($id) || $id <= 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'ID booking tidak valid.'
                ], 400);
            }

            $booking = Booking::with(['barber', 'service'])->findOrFail($id);

            // Validate booking has required relationships
            if (!$booking->barber || !$booking->service) {
                \Log::error('PDF Generation Error: Missing barber or service data for booking ID: ' . $id);
                return response()->json([
                    'success' => false,
                    'message' => 'Data booking tidak lengkap. Silakan hubungi customer service.'
                ], 500);
            }

            // Prepare data for PDF
            $data = [
                'booking' => $booking,
                'print_time' => now()->format('d/m/Y H:i:s')
            ];

            // Generate PDF
            $pdf = Pdf::loadView('booking.receipt-pdf', $data);
            
            // Set paper size and orientation
            $pdf->setPaper('A4', 'portrait');
            
            // Set options for better rendering
            $pdf->setOptions([
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled' => true,
                'defaultFont' => 'sans-serif'
            ]);

            // Generate filename
            $filename = 'struk-booking-' . str_pad($booking->id, 4, '0', STR_PAD_LEFT) . '.pdf';

            // Log successful PDF generation
            \Log::info('PDF generated successfully for booking ID: ' . $id);

            // Return PDF download
            return $pdf->download($filename);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            \Log::error('PDF Generation Error: Booking not found for ID: ' . $id);
            
            return response()->json([
                'success' => false,
                'message' => 'Booking tidak ditemukan.'
            ], 404);
            
        } catch (\Exception $e) {
            \Log::error('PDF Generation Error for booking ID ' . $id . ': ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat PDF. Silakan coba lagi atau hubungi customer service.'
            ], 500);
        }
    }

    public function checkDateAvailability(Request $request)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today'
        ]);

        try {
            $date = $request->date;
            
            // Get all bookings for the specified date (only confirmed and pending bookings)
            $bookings = Booking::with(['barber'])
                ->where('booking_date', $date)
                ->whereIn('status', ['pending', 'confirmed'])
                ->orderBy('booking_time')
                ->get();

            // Format the bookings data for display (minimal info for users)
            $bookedTimes = $bookings->map(function($booking) {
                return [
                    'time' => Carbon::parse($booking->booking_time)->format('H:i'),
                    'barber_name' => $booking->barber->name ?? 'Unknown'
                ];
            });

            return response()->json([
                'success' => true,
                'date' => $date,
                'bookings' => $bookedTimes
            ]);

        } catch (\Exception $e) {
            \Log::error('Check Date Availability Error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengecek ketersediaan.'
            ], 500);
        }
    }
}
