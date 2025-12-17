<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarberUser;
use App\Models\Booking;
use App\Models\Barber;
use App\Models\BookingNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BarberController extends Controller
{
    public function showLogin()
    {
        return view('barber.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        $barberUser = BarberUser::where('username', $request->username)
            ->where('is_active', true)
            ->first();

        if ($barberUser && Hash::check($request->password, $barberUser->password)) {
            // Update last login
            $barberUser->update(['last_login' => now()]);
            
            // Login the barber user
            Auth::guard('barber')->login($barberUser);
            
            return redirect()->route('barber.dashboard')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['login' => 'Username atau password salah.']);
    }

    public function dashboard()
    {
        $barberUser = Auth::guard('barber')->user();
        $today = Carbon::today();
        
        // Get today's bookings
        $todayBookings = Booking::with(['service'])
            ->where('barber_id', $barberUser->barber_id)
            ->whereDate('booking_date', $today)
            ->orderBy('booking_time')
            ->get();

        // Get upcoming bookings (next 7 days)
        $upcomingBookings = Booking::with(['service'])
            ->where('barber_id', $barberUser->barber_id)
            ->whereBetween('booking_date', [$today->addDay(), $today->copy()->addDays(7)])
            ->orderBy('booking_date')
            ->orderBy('booking_time')
            ->get();

        // Statistics
        $stats = [
            'today_total' => $todayBookings->count(),
            'today_pending' => $todayBookings->where('status', 'pending')->count(),
            'today_confirmed' => $todayBookings->where('status', 'confirmed')->count(),
            'today_completed' => $todayBookings->where('status', 'completed')->count(),
            'upcoming_total' => $upcomingBookings->count(),
            'unread_notifications' => BookingNotification::forBarber($barberUser->barber_id)->unread()->count(),
        ];

        // Get recent notifications
        $recentNotifications = BookingNotification::with('booking.service')
            ->forBarber($barberUser->barber_id)
            ->recent()
            ->limit(5)
            ->get();

        return view('barber.dashboard', compact('barberUser', 'todayBookings', 'upcomingBookings', 'stats', 'recentNotifications'));
    }

    public function bookings(Request $request)
    {
        $barberUser = Auth::guard('barber')->user();
        $query = Booking::with(['service'])
            ->where('barber_id', $barberUser->barber_id);

        // Filter by date range
        if ($request->date_from) {
            $query->whereDate('booking_date', '>=', $request->date_from);
        }
        
        if ($request->date_to) {
            $query->whereDate('booking_date', '<=', $request->date_to);
        }

        // Filter by status
        if ($request->status && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $bookings = $query->orderBy('booking_date', 'desc')
            ->orderBy('booking_time', 'desc')
            ->paginate(20);

        return view('barber.bookings', compact('bookings', 'barberUser'));
    }

    public function updateBookingStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);

        $barberUser = Auth::guard('barber')->user();
        $booking = Booking::where('id', $id)
            ->where('barber_id', $barberUser->barber_id)
            ->firstOrFail();

        $oldStatus = $booking->status;
        $booking->update(['status' => $request->status]);

        // Create notification for status change
        BookingNotification::createForStatusChange($booking, $oldStatus, $request->status);

        return response()->json([
            'success' => true,
            'message' => 'Status booking berhasil diupdate'
        ]);
    }

    public function logout()
    {
        Auth::guard('barber')->logout();
        return redirect()->route('barber.login')->with('success', 'Logout berhasil!');
    }
}