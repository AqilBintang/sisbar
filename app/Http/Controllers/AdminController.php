<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Service;
use App\Models\Barber;
use App\Models\BarberSchedule;
use App\Models\Booking;
use App\Models\BarberUser;
use App\Models\BookingNotification;
use App\Services\DashboardService;

class AdminController extends Controller
{
    public function showLogin()
    {
        // Redirect to dashboard if already logged in
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        
        return view('admin.login');
    }

    public function login(Request $request)
    {
        // Redirect to dashboard if already logged in
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }

        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Simple hardcoded admin credentials for demo
        if ($request->username === 'admin' && $request->password === 'admin123') {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard')->with('success', 'Selamat datang di Admin Panel!');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->withInput($request->only('username'));
    }

    public function dashboard()
    {
        $stats = [
            'total_services' => Service::count(),
            'total_barbers' => Barber::count(),
            'active_services' => Service::active()->count(),
            'active_barbers' => Barber::active()->count(),
            'total_bookings' => Booking::count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'today_bookings' => Booking::whereDate('booking_date', today())->count(),
            'total_barber_users' => BarberUser::count(),
            'active_barber_users' => BarberUser::where('is_active', true)->count(),
            'unread_notifications' => BookingNotification::forAdmin()->unread()->count(),
        ];

        // Get recent notifications
        $recentNotifications = BookingNotification::with('booking.barber', 'booking.service')
            ->forAdmin()
            ->recent()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentNotifications'));
    }

    public function getRevenueChartData(Request $request, DashboardService $dashboardService)
    {
        $days = $request->get('days', 7);
        return response()->json($dashboardService->getRevenueChartData($days));
    }
    
    public function getServiceChartData(Request $request)
    {
        $days = $request->get('days', 7);
        
        $query = \App\Models\Service::select('services.name', \DB::raw('COUNT(bookings.id) as booking_count'))
            ->join('bookings', 'services.id', '=', 'bookings.service_id')
            ->groupBy('services.id', 'services.name')
            ->orderBy('booking_count', 'DESC')
            ->limit(7);
            
        if ($days !== 'all') {
            $query->where('bookings.created_at', '>=', now()->subDays($days));
        }
        
        $serviceData = $query->get();
        
        return response()->json([
            'labels' => $serviceData->pluck('name'),
            'counts' => $serviceData->pluck('booking_count'),
            'total' => $serviceData->sum('booking_count')
        ]);
    }

    public function logout()
    {
        session()->forget('admin_logged_in');
        return redirect()->route('admin.login');
    }

    public function services()
    {
        $services = Service::orderBy('created_at', 'desc')->get();

        return view('admin.services', compact('services'));
    }

    public function barbers()
    {
        $barbers = Barber::with('schedules')->orderBy('created_at', 'desc')->get();

        return view('admin.barbers', compact('barbers'));
    }

    public function storeService(Request $request)
    {
        try {
            // Debug: Log request data
            \Log::info('Store Service Request:', [
                'has_file' => $request->hasFile('image'),
                'all_data' => $request->all(),
                'files' => $request->allFiles()
            ]);

            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'duration' => 'required|integer|min:1',
                'type' => 'required|in:ekonomis,populer,premium,paket',
                'features' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $features = null;
            if ($request->features) {
                $features = array_map('trim', explode(',', $request->features));
            }

            $imagePath = null;
            if ($request->hasFile('image')) {
                // Create services directory if it doesn't exist
                if (!Storage::disk('public')->exists('services')) {
                    Storage::disk('public')->makeDirectory('services');
                }
                
                $file = $request->file('image');
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                $imagePath = $file->storeAs('services', $filename, 'public');
                
                \Log::info('Image uploaded:', ['path' => $imagePath, 'filename' => $filename]);
            } else {
                \Log::info('No image file uploaded');
            }

            $service = Service::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'duration' => $request->duration,
                'type' => $request->type,
                'features' => $features,
                'image' => $imagePath,
                'is_active' => true,
            ]);

            \Log::info('Service created:', ['id' => $service->id, 'image' => $service->image]);

            return redirect()->route('admin.services')->with('success', 'Layanan berhasil ditambahkan!');
        } catch (\Exception $e) {
            \Log::error('Store Service Error:', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return redirect()->back()->withErrors(['error' => 'Gagal menambahkan layanan: ' . $e->getMessage()])->withInput();
        }
    }

    public function editService($id)
    {
        $service = Service::findOrFail($id);
        $services = Service::orderBy('created_at', 'desc')->get();

        return view('admin.services', compact('services', 'service'));
    }

    public function updateService(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'duration' => 'required|integer|min:1',
                'type' => 'required|in:ekonomis,populer,premium,paket',
                'features' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $service = Service::findOrFail($id);

            $features = null;
            if ($request->features) {
                $features = array_map('trim', explode(',', $request->features));
            }

            $imagePath = $service->image;
            if ($request->hasFile('image')) {
                // Create services directory if it doesn't exist
                if (!\Storage::disk('public')->exists('services')) {
                    \Storage::disk('public')->makeDirectory('services');
                }
                
                // Delete old image if exists
                if ($service->image && \Storage::disk('public')->exists($service->image)) {
                    \Storage::disk('public')->delete($service->image);
                }
                
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $imagePath = $file->storeAs('services', $filename, 'public');
            }

            $service->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'duration' => $request->duration,
                'type' => $request->type,
                'features' => $features,
                'image' => $imagePath,
            ]);

            return redirect()->route('admin.services')->with('success', 'Layanan berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal memperbarui layanan: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroyService($id)
    {
        try {
            $service = Service::findOrFail($id);
            
            // Delete image if exists
            if ($service->image && \Storage::disk('public')->exists($service->image)) {
                \Storage::disk('public')->delete($service->image);
            }

            $service->delete();

            return redirect()->route('admin.services')->with('success', 'Layanan berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus layanan: ' . $e->getMessage()]);
        }
    }

    public function storeBarber(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'experience' => 'required|string|max:255',
                'specialty' => 'required|string|max:255',
                'bio' => 'nullable|string',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'rating' => 'nullable|numeric|min:0|max:5',
                'level' => 'required|in:junior,professional,senior,master,specialist,creative',
                'skills' => 'nullable|string',
                'schedules' => 'nullable|array',
                'schedules.*.day' => 'required_with:schedules|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
                'schedules.*.start_time' => 'required_with:schedules|date_format:H:i',
                'schedules.*.end_time' => 'required_with:schedules|date_format:H:i|after:schedules.*.start_time',
            ]);

            $photoPath = null;
            if ($request->hasFile('photo')) {
                // Create image directory if it doesn't exist
                $imageDir = public_path('image');
                if (!file_exists($imageDir)) {
                    mkdir($imageDir, 0755, true);
                }
                
                $file = $request->file('photo');
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                
                // Move file to public/image directory
                $file->move($imageDir, $filename);
                $photoPath = $filename; // Store only filename, not full path
                
                \Log::info('Barber photo uploaded:', ['filename' => $filename, 'path' => $imageDir . '/' . $filename]);
            }

            $skills = null;
            if ($request->skills) {
                $skills = array_map('trim', explode(',', $request->skills));
            }

            $barber = Barber::create([
                'name' => $request->name,
                'experience' => $request->experience,
                'specialty' => $request->specialty,
                'bio' => $request->bio,
                'photo' => $photoPath,
                'rating' => $request->rating ?? 5.0,
                'level' => $request->level,
                'skills' => $skills,
                'is_active' => true,
            ]);

            // Create schedules if provided
            if ($request->schedules) {
                foreach ($request->schedules as $scheduleData) {
                    if (!empty($scheduleData['day']) && !empty($scheduleData['start_time']) && !empty($scheduleData['end_time'])) {
                        BarberSchedule::create([
                            'barber_id' => $barber->id,
                            'day_of_week' => $scheduleData['day'],
                            'start_time' => $scheduleData['start_time'],
                            'end_time' => $scheduleData['end_time'],
                            'is_available' => true,
                        ]);
                    }
                }
            }

            return redirect()->route('admin.barbers')->with('success', 'Kapster berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menambahkan kapster: ' . $e->getMessage()])->withInput();
        }
    }

    public function editBarber($id)
    {
        $barber = Barber::with('schedules')->findOrFail($id);
        $barbers = Barber::with('schedules')->orderBy('created_at', 'desc')->get();

        return view('admin.barbers', compact('barbers', 'barber'));
    }

    public function updateBarber(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'experience' => 'required|string|max:255',
                'specialty' => 'required|string|max:255',
                'bio' => 'nullable|string',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'rating' => 'nullable|numeric|min:0|max:5',
                'level' => 'required|in:junior,professional,senior,master,specialist,creative',
                'skills' => 'nullable|string',
                'schedules' => 'nullable|array',
                'schedules.*.day' => 'required_with:schedules|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
                'schedules.*.start_time' => 'required_with:schedules|date_format:H:i',
                'schedules.*.end_time' => 'required_with:schedules|date_format:H:i|after:schedules.*.start_time',
            ]);

            $barber = Barber::findOrFail($id);

            // Handle photo update - KEEP OLD PHOTO IF NO NEW UPLOAD
            $photoPath = $barber->photo; // Keep existing photo by default
            if ($request->hasFile('photo')) {
                // Create image directory if it doesn't exist
                $imageDir = public_path('image');
                if (!file_exists($imageDir)) {
                    mkdir($imageDir, 0755, true);
                }
                
                // Delete old photo if exists
                if ($barber->photo && file_exists(public_path('image/' . $barber->photo))) {
                    unlink(public_path('image/' . $barber->photo));
                    \Log::info('Old barber photo deleted:', ['filename' => $barber->photo]);
                }
                
                $file = $request->file('photo');
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                
                // Move file to public/image directory
                $file->move($imageDir, $filename);
                $photoPath = $filename; // Store only filename, not full path
                
                \Log::info('Barber photo updated:', ['old' => $barber->photo, 'new' => $filename]);
            }

            $skills = null;
            if ($request->skills) {
                $skills = array_map('trim', explode(',', $request->skills));
            }

            $barber->update([
                'name' => $request->name,
                'experience' => $request->experience,
                'specialty' => $request->specialty,
                'bio' => $request->bio,
                'photo' => $photoPath,
                'rating' => $request->rating ?? $barber->rating,
                'level' => $request->level,
                'skills' => $skills,
            ]);

            // Update schedules
            if ($request->schedules) {
                // Delete existing schedules
                $barber->schedules()->delete();
                
                // Create new schedules
                foreach ($request->schedules as $scheduleData) {
                    if (!empty($scheduleData['day']) && !empty($scheduleData['start_time']) && !empty($scheduleData['end_time'])) {
                        BarberSchedule::create([
                            'barber_id' => $barber->id,
                            'day_of_week' => $scheduleData['day'],
                            'start_time' => $scheduleData['start_time'],
                            'end_time' => $scheduleData['end_time'],
                            'is_available' => true,
                        ]);
                    }
                }
            }

            return redirect()->route('admin.barbers')->with('success', 'Kapster berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal memperbarui kapster: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroyBarber($id)
    {
        try {
            $barber = Barber::findOrFail($id);
            
            // Delete photo if exists in public/image directory
            if ($barber->photo && file_exists(public_path('image/' . $barber->photo))) {
                unlink(public_path('image/' . $barber->photo));
                \Log::info('Barber photo deleted:', ['filename' => $barber->photo]);
            }

            $barber->delete();

            return redirect()->route('admin.barbers')->with('success', 'Kapster berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus kapster: ' . $e->getMessage()]);
        }
    }

    // Booking Management
    public function bookings(Request $request)
    {
        $query = Booking::with(['barber', 'service']);

        // Filter by date range
        if ($request->date_from) {
            $query->whereDate('booking_date', '>=', $request->date_from);
        }
        
        if ($request->date_to) {
            $query->whereDate('booking_date', '<=', $request->date_to);
        }

        // Filter by booking status
        if ($request->status && $request->status !== 'all') {
            $query->where('status', $request->status);
        }
        
        // Filter by payment status
        if ($request->payment_status && $request->payment_status !== 'all') {
            $query->where('payment_status', $request->payment_status);
        }

        $bookings = $query->orderBy('booking_date', 'desc')
            ->orderBy('booking_time', 'desc')
            ->paginate(20);
        
        $stats = [
            'total' => Booking::count(),
            'pending' => Booking::where('status', 'pending')->count(),
            'confirmed' => Booking::where('status', 'confirmed')->count(),
            'completed' => Booking::where('status', 'completed')->count(),
            'cancelled' => Booking::where('status', 'cancelled')->count(),
            'today' => Booking::whereDate('booking_date', today())->count(),
            // Payment stats
            'payment_pending' => Booking::where('payment_status', 'pending')->count(),
            'payment_paid' => Booking::where('payment_status', 'paid')->count(),
            'payment_failed' => Booking::where('payment_status', 'failed')->count(),
        ];

        return view('admin.bookings', compact('bookings', 'stats'));
    }

    public function updateBookingStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);

        $booking = Booking::findOrFail($id);
        $oldStatus = $booking->status;
        $booking->status = $request->status;
        $booking->save();

        // Create notification for status change
        BookingNotification::createForStatusChange($booking, $oldStatus, $request->status);

        return response()->json([
            'success' => true,
            'message' => 'Status booking berhasil diupdate',
            'status' => $booking->status_display
        ]);
    }

    public function deleteBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return response()->json([
            'success' => true,
            'message' => 'Booking berhasil dihapus'
        ]);
    }

    // Barber User Management
    public function barberUsers()
    {
        $barberUsers = BarberUser::with('barber')->orderBy('created_at', 'desc')->get();
        $availableBarbers = Barber::whereDoesntHave('barberUser')->get();

        return view('admin.barber-users', compact('barberUsers', 'availableBarbers'));
    }

    public function storeBarberUser(Request $request)
    {
        try {
            $request->validate([
                'barber_id' => 'required|exists:barbers,id|unique:barber_users,barber_id',
                'username' => 'required|string|max:255|unique:barber_users,username',
                'password' => 'required|string|min:6',
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:barber_users,email',
                'phone' => 'nullable|string|max:20',
            ]);

            BarberUser::create([
                'barber_id' => $request->barber_id,
                'username' => $request->username,
                'password' => $request->password, // Will be hashed by mutator
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'is_active' => true,
            ]);

            return redirect()->route('admin.barber-users')->with('success', 'Akun kapster berhasil dibuat!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal membuat akun kapster: ' . $e->getMessage()])->withInput();
        }
    }

    public function editBarberUser($id)
    {
        $barberUser = BarberUser::with('barber')->findOrFail($id);
        $barberUsers = BarberUser::with('barber')->orderBy('created_at', 'desc')->get();
        $availableBarbers = Barber::whereDoesntHave('barberUser')->orWhere('id', $barberUser->barber_id)->get();

        return view('admin.barber-users', compact('barberUsers', 'availableBarbers', 'barberUser'));
    }

    public function updateBarberUser(Request $request, $id)
    {
        try {
            $barberUser = BarberUser::findOrFail($id);
            
            $request->validate([
                'barber_id' => 'required|exists:barbers,id|unique:barber_users,barber_id,' . $id,
                'username' => 'required|string|max:255|unique:barber_users,username,' . $id,
                'password' => 'nullable|string|min:6',
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:barber_users,email,' . $id,
                'phone' => 'nullable|string|max:20',
                'is_active' => 'boolean',
            ]);

            $updateData = [
                'barber_id' => $request->barber_id,
                'username' => $request->username,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'is_active' => $request->has('is_active'),
            ];

            if ($request->password) {
                $updateData['password'] = $request->password; // Will be hashed by mutator
            }

            $barberUser->update($updateData);

            return redirect()->route('admin.barber-users')->with('success', 'Akun kapster berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal memperbarui akun kapster: ' . $e->getMessage()])->withInput();
        }
    }

    public function resetBarberPassword(Request $request, $id)
    {
        try {
            $request->validate([
                'password' => 'required|string|min:6'
            ]);

            $barberUser = BarberUser::findOrFail($id);
            $barberUser->password = $request->password; // Will be hashed by mutator
            $barberUser->save();

            return response()->json([
                'success' => true,
                'message' => 'Password berhasil direset!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal reset password: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroyBarberUser($id)
    {
        try {
            $barberUser = BarberUser::findOrFail($id);
            $barberUser->delete();

            return redirect()->route('admin.barber-users')->with('success', 'Akun kapster berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus akun kapster: ' . $e->getMessage()]);
        }
    }
}