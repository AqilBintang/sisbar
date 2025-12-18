<?php

use Illuminate\Support\Facades\Route;

// Main route - New Figma Design
Route::get('/', function () {
    return view('barbershop.index');
});

// Original routes (backup)
Route::get('/old-dashboard', function () {
    return view('users.dashboard');
});

Route::get('/layanan', function () {
    return view('users.layanan');
});

// Route::get('/booking', function () {
//     return view('users.booking');
// }); // Commented out - conflicts with new booking system

Route::get('/history', function () {
    return view('users.history');
});

Route::get('/profile', function () {
    return view('users.profile');
});

// New Barbershop SPA routes
Route::get('/barbershop', function () {
    return view('barbershop.optimized');
});

Route::get('/services', [App\Http\Controllers\ServiceController::class, 'index'])->name('services');
Route::get('/api/services', [App\Http\Controllers\ServiceController::class, 'getServices']);

Route::get('/barbers', function () {
    $barbers = App\Models\Barber::with('schedules')->active()->where('is_present', true)->orderBy('level', 'desc')->orderBy('rating', 'desc')->get();
    return view('barbershop.barbers', compact('barbers'));
})->name('barbers');

Route::get('/confirmation', function () {
    return view('barbershop.index');
});

Route::get('/notifications', function () {
    return view('barbershop.index');
});

// Admin routes
Route::prefix('admin')->group(function () {
    // Public routes (no middleware)
    Route::get('/', [App\Http\Controllers\AdminController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [App\Http\Controllers\AdminController::class, 'login'])->name('admin.login.post');
    

    
    // Protected routes (require admin middleware)
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/services', [App\Http\Controllers\AdminController::class, 'services'])->name('admin.services');
        Route::post('/services', [App\Http\Controllers\AdminController::class, 'storeService'])->name('admin.services.store');
        Route::get('/services/{id}/edit', [App\Http\Controllers\AdminController::class, 'editService'])->name('admin.services.edit');
        Route::put('/services/{id}', [App\Http\Controllers\AdminController::class, 'updateService'])->name('admin.services.update');
        Route::delete('/services/{id}', [App\Http\Controllers\AdminController::class, 'destroyService'])->name('admin.services.destroy');
        Route::get('/barbers', [App\Http\Controllers\AdminController::class, 'barbers'])->name('admin.barbers');
        Route::post('/barbers', [App\Http\Controllers\AdminController::class, 'storeBarber'])->name('admin.barbers.store');
        Route::get('/barbers/{id}/edit', [App\Http\Controllers\AdminController::class, 'editBarber'])->name('admin.barbers.edit');
        Route::put('/barbers/{id}', [App\Http\Controllers\AdminController::class, 'updateBarber'])->name('admin.barbers.update');
        Route::delete('/barbers/{id}', [App\Http\Controllers\AdminController::class, 'destroyBarber'])->name('admin.barbers.destroy');
        Route::post('/barbers/{id}/toggle-presence', [App\Http\Controllers\AdminController::class, 'toggleBarberPresence'])->name('admin.barbers.toggle-presence');
        Route::get('/bookings', [App\Http\Controllers\AdminController::class, 'bookings'])->name('admin.bookings');
        Route::get('/bookings/{id}/receipt', function($id) {
            $booking = App\Models\Booking::with(['barber', 'service'])->findOrFail($id);
            return view('admin.receipt', compact('booking'));
        })->name('admin.bookings.receipt');
        Route::put('/bookings/{id}/status', [App\Http\Controllers\AdminController::class, 'updateBookingStatus'])->name('admin.bookings.status');
        Route::delete('/bookings/{id}', [App\Http\Controllers\AdminController::class, 'deleteBooking'])->name('admin.bookings.destroy');
        Route::get('/barber-users', [App\Http\Controllers\AdminController::class, 'barberUsers'])->name('admin.barber-users');
        Route::post('/barber-users', [App\Http\Controllers\AdminController::class, 'storeBarberUser'])->name('admin.barber-users.store');
        Route::get('/barber-users/{id}/edit', [App\Http\Controllers\AdminController::class, 'editBarberUser'])->name('admin.barber-users.edit');
        Route::put('/barber-users/{id}', [App\Http\Controllers\AdminController::class, 'updateBarberUser'])->name('admin.barber-users.update');
        Route::post('/barber-users/{id}/reset-password', [App\Http\Controllers\AdminController::class, 'resetBarberPassword'])->name('admin.barber-users.reset-password');
        Route::delete('/barber-users/{id}', [App\Http\Controllers\AdminController::class, 'destroyBarberUser'])->name('admin.barber-users.destroy');
        Route::get('/chart-data/revenue', [App\Http\Controllers\AdminController::class, 'getRevenueChartData'])->name('admin.chart.revenue');
        Route::get('/chart-data/services', [App\Http\Controllers\AdminController::class, 'getServiceChartData'])->name('admin.chart.services');
        
        // Broadcast routes
        Route::prefix('broadcast')->name('admin.broadcast.')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\BroadcastController::class, 'index'])->name('index');
            Route::get('/create', [App\Http\Controllers\Admin\BroadcastController::class, 'create'])->name('create');
            Route::get('/create-simple', function() {
                $templates = [];
                return view('admin.broadcast.create-simple', compact('templates'));
            })->name('create-simple');
            Route::get('/config', [App\Http\Controllers\Admin\BroadcastController::class, 'config'])->name('config');
            Route::post('/', [App\Http\Controllers\Admin\BroadcastController::class, 'store'])->name('store');
            Route::get('/{broadcast}', [App\Http\Controllers\Admin\BroadcastController::class, 'show'])->name('show');
            Route::post('/{broadcast}/send', [App\Http\Controllers\Admin\BroadcastController::class, 'send'])->name('send');
            Route::delete('/{broadcast}', [App\Http\Controllers\Admin\BroadcastController::class, 'destroy'])->name('destroy');
            Route::post('/preview-targets', [App\Http\Controllers\Admin\BroadcastController::class, 'previewTargets'])->name('preview');
            Route::get('/template', [App\Http\Controllers\Admin\BroadcastController::class, 'getTemplate'])->name('template');
        });
        
        Route::post('/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');
    });
});

// Barber routes
Route::prefix('barber')->group(function () {
    // Public routes (no middleware)
    Route::get('/', [App\Http\Controllers\BarberController::class, 'showLogin'])->name('barber.login');
    Route::post('/', [App\Http\Controllers\BarberController::class, 'login'])->name('barber.login.post');
    

    
    // Protected routes (require barber middleware)
    Route::middleware('auth.barber')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\BarberController::class, 'dashboard'])->name('barber.dashboard');
        Route::get('/bookings', [App\Http\Controllers\BarberController::class, 'bookings'])->name('barber.bookings');
        Route::put('/bookings/{id}/status', [App\Http\Controllers\BarberController::class, 'updateBookingStatus'])->name('barber.bookings.status');
        Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'getBarberNotifications'])->name('barber.notifications');
        Route::put('/notifications/{id}/read', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('barber.notifications.read');
        Route::post('/logout', [App\Http\Controllers\BarberController::class, 'logout'])->name('barber.logout');
    });
});

// Notification routes for admin
Route::middleware('admin')->group(function () {
    Route::get('/admin/notifications', [App\Http\Controllers\NotificationController::class, 'getAdminNotifications'])->name('admin.notifications');
    Route::put('/admin/notifications/{id}/read', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('admin.notifications.read');
    Route::post('/admin/notifications/mark-all-read', [App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('admin.notifications.mark-all-read');
});

// Booking status routes
Route::get('/booking-status', function () {
    return view('booking.status');
})->name('booking.status');

Route::post('/booking-status/check', [App\Http\Controllers\BookingController::class, 'checkStatus'])->name('booking.status.check');

// Booking detail route for receipt (no auth required)
Route::get('/booking-detail/{id}', [App\Http\Controllers\BookingController::class, 'show'])->name('booking.detail');

// Booking receipt PDF download (no auth required)
Route::get('/booking-receipt/pdf/{id}', [App\Http\Controllers\BookingController::class, 'downloadReceiptPDF'])->name('booking.receipt.pdf');

// Payment routes
Route::prefix('payment')->group(function () {
    Route::post('/create/{booking}', [App\Http\Controllers\PaymentController::class, 'createPayment'])->name('payment.create');
    Route::post('/notification', [App\Http\Controllers\PaymentController::class, 'handleNotification'])->name('payment.notification');
    Route::get('/finish', [App\Http\Controllers\PaymentController::class, 'finish'])->name('payment.finish');
    Route::get('/unfinish', [App\Http\Controllers\PaymentController::class, 'unfinish'])->name('payment.unfinish');
    Route::get('/error', [App\Http\Controllers\PaymentController::class, 'error'])->name('payment.error');
    Route::get('/status/{booking}', [App\Http\Controllers\PaymentController::class, 'checkStatus'])->name('payment.status');
});

// Webhook notification route (without CSRF protection)
Route::post('/midtrans/notification', [App\Http\Controllers\PaymentController::class, 'handleNotification'])
    ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class])
    ->name('midtrans.notification');

Route::get('/gallery', function () {
    return view('barbershop.index');
});

// Authentication routes
Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [App\Http\Controllers\AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register.post');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login.post');
Route::get('/auth/google', [App\Http\Controllers\AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [App\Http\Controllers\AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');



// Profile routes (protected by authentication)
Route::middleware('auth.user')->prefix('profile')->name('profile.')->group(function () {
    Route::get('/whatsapp-setup', [App\Http\Controllers\ProfileController::class, 'showWhatsAppSetup'])->name('whatsapp.setup');
    Route::post('/whatsapp-setup', [App\Http\Controllers\ProfileController::class, 'setupWhatsApp'])->name('whatsapp.store');
});

// WhatsApp routes (protected by authentication)
Route::middleware('auth.user')->prefix('whatsapp')->name('whatsapp.')->group(function () {
    Route::post('/update', [App\Http\Controllers\WhatsAppController::class, 'updateWhatsApp'])->name('update');
    Route::post('/send-verification', [App\Http\Controllers\WhatsAppController::class, 'sendVerification'])->name('send-verification');
    Route::post('/verify-code', [App\Http\Controllers\WhatsAppController::class, 'verifyCode'])->name('verify-code');
    Route::post('/toggle-broadcast', [App\Http\Controllers\WhatsAppController::class, 'toggleBroadcast'])->name('toggle-broadcast');
});

// Booking routes (protected by authentication)
Route::middleware('auth.user')->group(function () {
    Route::get('/booking', [App\Http\Controllers\BookingController::class, 'index'])->name('booking.index');
    Route::post('/booking/available-barbers', [App\Http\Controllers\BookingController::class, 'getAvailableBarbers'])->name('booking.available-barbers');
    Route::post('/booking/time-slots', [App\Http\Controllers\BookingController::class, 'getTimeSlots'])->name('booking.time-slots');
    Route::get('/booking/services', [App\Http\Controllers\BookingController::class, 'getServices'])->name('booking.services');
    Route::post('/booking/store', [App\Http\Controllers\BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/{id}', [App\Http\Controllers\BookingController::class, 'show'])->name('booking.show');
    Route::get('/booking-confirmation', function () {
        return view('booking.confirmation');
    })->name('booking.confirmation');
    Route::post('/booking/check-availability', [App\Http\Controllers\BookingController::class, 'checkAvailability'])->name('booking.check-availability');
    Route::get('/booking-status', function () {
        return view('booking.status');
    })->name('booking.status');
    Route::post('/booking/check-status', [App\Http\Controllers\BookingController::class, 'checkStatus'])->name('booking.check-status');
});






// Booking receipt page (accessible without auth for testing)
Route::get('/booking-receipt', function () {
    return view('booking.receipt');
})->name('booking.receipt');

// Booking receipt with ID parameter (redirect to receipt with query param)
Route::get('/booking-receipt/{id}', function ($id) {
    return redirect()->route('booking.receipt', ['booking_id' => $id]);
})->name('booking.receipt.id');







// Booking Dashboard (public access to view all bookings)
Route::get('/booking-dashboard', [App\Http\Controllers\BookingDashboardController::class, 'index'])->name('booking.dashboard');
Route::post('/booking-dashboard/date-bookings', [App\Http\Controllers\BookingDashboardController::class, 'getBookingsForDate'])->name('booking.dashboard.date-bookings');

// AJAX routes for optimized loading
Route::prefix('ajax')->name('ajax.')->group(function () {
    Route::get('/services', [App\Http\Controllers\AjaxController::class, 'loadServices'])->name('services');
    Route::get('/barbers', [App\Http\Controllers\AjaxController::class, 'loadBarbers'])->name('barbers');
    Route::get('/gallery', [App\Http\Controllers\AjaxController::class, 'loadGallery'])->name('gallery');
    Route::get('/navigation-data', [App\Http\Controllers\AjaxController::class, 'getNavigationData'])->name('navigation-data');
    Route::post('/preload', [App\Http\Controllers\AjaxController::class, 'preloadResources'])->name('preload');
});

// Availability checker API (public access)
Route::post('/api/check-availability', [App\Http\Controllers\BookingController::class, 'checkDateAvailability'])->name('api.check-availability');

// Simulate payment API (for testing)
Route::post('/api/simulate-payment/{id}', function ($id) {
    try {
        $booking = App\Models\Booking::findOrFail($id);
        $request = request();
        $status = $request->input('status');
        
        if ($status === 'success') {
            // Simulate successful payment
            $booking->update([
                'payment_status' => 'paid',
                'midtrans_order_id' => 'SIMULATE-' . $booking->id . '-' . time(),
                'midtrans_transaction_id' => 'TXN-SIMULATE-' . time(),
                'status' => 'confirmed'
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Payment simulation successful',
                'booking_status' => 'paid'
            ]);
            
        } elseif ($status === 'cancel') {
            // Delete booking (simulate cancel)
            $booking->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Booking cancelled and deleted',
                'booking_status' => 'deleted'
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Invalid status'
        ], 400);
        
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error simulating payment: ' . $e->getMessage()
        ], 500);
    }
})->name('api.simulate-payment');









// PDF Routes
Route::get('/pdf/receipt/{id}/download', [App\Http\Controllers\PDFController::class, 'downloadReceipt'])->name('pdf.receipt.download');
Route::get('/pdf/receipt/{id}/view', [App\Http\Controllers\PDFController::class, 'viewReceipt'])->name('pdf.receipt.view');










