<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingNotification extends Model
{
    protected $fillable = [
        'booking_id',
        'recipient_type',
        'barber_id',
        'type',
        'title',
        'message',
        'data',
        'is_read',
        'read_at'
    ];

    protected $casts = [
        'data' => 'array',
        'is_read' => 'boolean',
        'read_at' => 'datetime'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function barber()
    {
        return $this->belongsTo(Barber::class);
    }

    public function markAsRead()
    {
        $this->update([
            'is_read' => true,
            'read_at' => now()
        ]);
    }

    public static function createForNewBooking(Booking $booking)
    {
        // Notification for admin
        self::create([
            'booking_id' => $booking->id,
            'recipient_type' => 'admin',
            'type' => 'new_booking',
            'title' => 'Booking Baru',
            'message' => "Booking baru dari {$booking->customer_name} untuk {$booking->service->name}",
            'data' => [
                'customer_name' => $booking->customer_name,
                'service_name' => $booking->service->name,
                'barber_name' => $booking->barber->name,
                'booking_date' => $booking->formatted_date,
                'booking_time' => $booking->formatted_time,
                'total_price' => $booking->total_price
            ]
        ]);

        // Notification for barber
        self::create([
            'booking_id' => $booking->id,
            'recipient_type' => 'barber',
            'barber_id' => $booking->barber_id,
            'type' => 'new_booking',
            'title' => 'Booking Baru untuk Anda',
            'message' => "Anda mendapat booking baru dari {$booking->customer_name} pada {$booking->formatted_date} {$booking->formatted_time}",
            'data' => [
                'customer_name' => $booking->customer_name,
                'service_name' => $booking->service->name,
                'booking_date' => $booking->formatted_date,
                'booking_time' => $booking->formatted_time,
                'total_price' => $booking->total_price
            ]
        ]);
    }

    public static function createForStatusChange(Booking $booking, $oldStatus, $newStatus)
    {
        $statusMessages = [
            'pending' => 'Menunggu Konfirmasi',
            'confirmed' => 'Dikonfirmasi',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan'
        ];

        // Notification for barber when admin changes status
        if ($newStatus === 'confirmed') {
            self::create([
                'booking_id' => $booking->id,
                'recipient_type' => 'barber',
                'barber_id' => $booking->barber_id,
                'type' => 'booking_confirmed',
                'title' => 'Booking Dikonfirmasi',
                'message' => "Booking dari {$booking->customer_name} telah dikonfirmasi admin",
                'data' => [
                    'customer_name' => $booking->customer_name,
                    'old_status' => $statusMessages[$oldStatus] ?? $oldStatus,
                    'new_status' => $statusMessages[$newStatus] ?? $newStatus
                ]
            ]);
        }

        // Notification for admin when barber changes status
        if (in_array($newStatus, ['completed', 'cancelled'])) {
            self::create([
                'booking_id' => $booking->id,
                'recipient_type' => 'admin',
                'type' => 'booking_status_changed',
                'title' => 'Status Booking Diupdate',
                'message' => "Kapster {$booking->barber->name} mengubah status booking menjadi {$statusMessages[$newStatus]}",
                'data' => [
                    'barber_name' => $booking->barber->name,
                    'customer_name' => $booking->customer_name,
                    'old_status' => $statusMessages[$oldStatus] ?? $oldStatus,
                    'new_status' => $statusMessages[$newStatus] ?? $newStatus
                ]
            ]);
        }
    }

    public function scopeForAdmin($query)
    {
        return $query->where('recipient_type', 'admin');
    }

    public function scopeForBarber($query, $barberId)
    {
        return $query->where('recipient_type', 'barber')->where('barber_id', $barberId);
    }

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}