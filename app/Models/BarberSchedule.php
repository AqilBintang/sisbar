<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BarberSchedule extends Model
{
    protected $fillable = [
        'barber_id',
        'day_of_week',
        'start_time',
        'end_time',
        'is_available'
    ];

    protected $casts = [
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'is_available' => 'boolean'
    ];

    public function barber()
    {
        return $this->belongsTo(Barber::class);
    }

    public function getDayDisplayAttribute()
    {
        return match($this->day_of_week) {
            'monday' => 'Senin',
            'tuesday' => 'Selasa',
            'wednesday' => 'Rabu',
            'thursday' => 'Kamis',
            'friday' => 'Jumat',
            'saturday' => 'Sabtu',
            'sunday' => 'Minggu',
            default => $this->day_of_week
        };
    }

    public function getFormattedTimeAttribute()
    {
        return $this->start_time->format('H:i') . ' - ' . $this->end_time->format('H:i');
    }

    public static function getDayOptions()
    {
        return [
            'monday' => 'Senin',
            'tuesday' => 'Selasa',
            'wednesday' => 'Rabu',
            'thursday' => 'Kamis',
            'friday' => 'Jumat',
            'saturday' => 'Sabtu',
            'sunday' => 'Minggu'
        ];
    }

    // Check if barber is available on a specific date
    public static function isBarberAvailableOnDate($barberId, $date)
    {
        $dayOfWeek = strtolower(Carbon::parse($date)->format('l'));
        
        return self::where('barber_id', $barberId)
            ->where('day_of_week', $dayOfWeek)
            ->where('is_available', true)
            ->exists();
    }

    // Get available barbers for a specific date
    public static function getAvailableBarbersForDate($date)
    {
        $dayOfWeek = strtolower(Carbon::parse($date)->format('l'));
        
        return Barber::whereHas('schedules', function($query) use ($dayOfWeek) {
            $query->where('day_of_week', $dayOfWeek)
                  ->where('is_available', true);
        })->where('is_active', true)->get();
    }
}
