<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingNotification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function getAdminNotifications()
    {
        $notifications = BookingNotification::with('booking.barber', 'booking.service')
            ->forAdmin()
            ->recent()
            ->limit(10)
            ->get();

        return response()->json([
            'success' => true,
            'notifications' => $notifications->map(function($notification) {
                return [
                    'id' => $notification->id,
                    'type' => $notification->type,
                    'title' => $notification->title,
                    'message' => $notification->message,
                    'data' => $notification->data,
                    'is_read' => $notification->is_read,
                    'created_at' => $notification->created_at->diffForHumans(),
                    'booking_id' => $notification->booking_id
                ];
            }),
            'unread_count' => BookingNotification::forAdmin()->unread()->count()
        ]);
    }

    public function getBarberNotifications()
    {
        $barberUser = Auth::guard('barber')->user();
        
        $notifications = BookingNotification::with('booking.service')
            ->forBarber($barberUser->barber_id)
            ->recent()
            ->limit(10)
            ->get();

        return response()->json([
            'success' => true,
            'notifications' => $notifications->map(function($notification) {
                return [
                    'id' => $notification->id,
                    'type' => $notification->type,
                    'title' => $notification->title,
                    'message' => $notification->message,
                    'data' => $notification->data,
                    'is_read' => $notification->is_read,
                    'created_at' => $notification->created_at->diffForHumans(),
                    'booking_id' => $notification->booking_id
                ];
            }),
            'unread_count' => BookingNotification::forBarber($barberUser->barber_id)->unread()->count()
        ]);
    }

    public function markAsRead(Request $request, $id)
    {
        $notification = BookingNotification::findOrFail($id);
        $notification->markAsRead();

        return response()->json([
            'success' => true,
            'message' => 'Notification marked as read'
        ]);
    }

    public function markAllAsRead(Request $request)
    {
        if ($request->type === 'admin') {
            BookingNotification::forAdmin()->unread()->update([
                'is_read' => true,
                'read_at' => now()
            ]);
        } elseif ($request->type === 'barber') {
            $barberUser = Auth::guard('barber')->user();
            BookingNotification::forBarber($barberUser->barber_id)->unread()->update([
                'is_read' => true,
                'read_at' => now()
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'All notifications marked as read'
        ]);
    }
}