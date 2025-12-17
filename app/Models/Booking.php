<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Booking extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_phone',
        'customer_email',
        'barber_id',
        'service_id',
        'booking_date',
        'booking_time',
        'status',
        'notes',
        'total_price',
        'payment_method',
        'payment_status',
        'payment_expires_at',
        'midtrans_order_id',
        'midtrans_transaction_id',
        'snap_token'
    ];

    protected $casts = [
        'booking_date' => 'date',
        'booking_time' => 'string',
        'total_price' => 'decimal:2',
        'payment_expires_at' => 'datetime'
    ];

    public function barber()
    {
        return $this->belongsTo(Barber::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function getFormattedDateAttribute()
    {
        return $this->booking_date->format('d F Y');
    }

    public function getFormattedTimeAttribute()
    {
        // If booking_time is already in H:i format, return as is
        if (preg_match('/^\d{2}:\d{2}$/', $this->booking_time)) {
            return $this->booking_time;
        }
        
        // If it's in datetime format, extract time part
        try {
            return \Carbon\Carbon::parse($this->booking_time)->format('H:i');
        } catch (\Exception $e) {
            return $this->booking_time;
        }
    }

    public function getStatusDisplayAttribute()
    {
        return match($this->status) {
            'pending' => 'Menunggu Konfirmasi',
            'confirmed' => 'Dikonfirmasi',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
            default => 'Unknown'
        };
    }

    public function getPaymentMethodDisplayAttribute()
    {
        return match($this->payment_method) {
            'cash' => 'Tunai',
            'online' => 'Online Payment',
            default => 'Tunai'
        };
    }

    public function getPaymentStatusDisplayAttribute()
    {
        return match($this->payment_status) {
            'pending' => 'Menunggu Pembayaran',
            'paid' => 'Sudah Dibayar',
            'failed' => 'Gagal',
            'challenge' => 'Perlu Verifikasi',
            default => 'Unknown'
        };
    }

    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'pending' => 'yellow',
            'confirmed' => 'blue',
            'completed' => 'green',
            'cancelled' => 'red',
            default => 'gray'
        };
    }

    public static function getAvailableTimeSlots($barberId, $date)
    {
        $dayOfWeek = strtolower(Carbon::parse($date)->format('l'));
        
        // Get barber schedule for the day
        $schedule = BarberSchedule::where('barber_id', $barberId)
            ->where('day_of_week', $dayOfWeek)
            ->where('is_available', true)
            ->first();

        if (!$schedule) {
            return [];
        }

        // Generate time slots (30-minute intervals)
        $slots = [];
        $startTime = Carbon::parse($schedule->start_time);
        $endTime = Carbon::parse($schedule->end_time);

        while ($startTime->lt($endTime)) {
            $timeSlot = $startTime->format('H:i');
            
            // Check if this time slot is already booked
            $isBooked = self::where('barber_id', $barberId)
                ->where('booking_date', $date)
                ->where('booking_time', $timeSlot)
                ->whereIn('status', ['pending', 'confirmed'])
                ->exists();

            if (!$isBooked) {
                $slots[] = [
                    'time' => $timeSlot,
                    'display' => $startTime->format('H:i'),
                    'available' => true
                ];
            }

            $startTime->addMinutes(30);
        }

        return $slots;
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopeToday($query)
    {
        return $query->whereDate('booking_date', today());
    }

    public function scopeUpcoming($query)
    {
        return $query->where('booking_date', '>=', today());
    }
}
