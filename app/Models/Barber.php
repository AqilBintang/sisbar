<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barber extends Model
{
    protected $fillable = [
        'name',
        'experience',
        'specialty',
        'bio',
        'photo',
        'rating',
        'level',
        'skills',
        'is_active'
    ];

    protected $casts = [
        'rating' => 'decimal:2',
        'is_active' => 'boolean',
        'skills' => 'array'
    ];

    public function getFormattedRatingAttribute()
    {
        return number_format($this->rating, 1);
    }

    public function getLevelDisplayAttribute()
    {
        return match($this->level) {
            'junior' => 'Junior Kapster',
            'professional' => 'Professional Kapster',
            'senior' => 'Senior Kapster',
            'master' => 'Master Kapster',
            'specialist' => 'Specialist Kapster',
            'creative' => 'Creative Kapster',
            default => 'Kapster'
        };
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function schedules()
    {
        return $this->hasMany(BarberSchedule::class);
    }

    public function barberUser()
    {
        return $this->hasOne(BarberUser::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function getScheduleDisplayAttribute()
    {
        if ($this->schedules->isEmpty()) {
            return 'Jadwal belum diatur';
        }

        $scheduleGroups = [];
        foreach ($this->schedules as $schedule) {
            $timeRange = $schedule->formatted_time;
            if (!isset($scheduleGroups[$timeRange])) {
                $scheduleGroups[$timeRange] = [];
            }
            $scheduleGroups[$timeRange][] = $schedule->day_display;
        }

        $result = [];
        foreach ($scheduleGroups as $time => $days) {
            if (count($days) > 1) {
                $result[] = implode(', ', $days) . ': ' . $time;
            } else {
                $result[] = $days[0] . ': ' . $time;
            }
        }

        return implode(' | ', $result);
    }

    public function isAvailableOnDate($date)
    {
        return BarberSchedule::isBarberAvailableOnDate($this->id, $date);
    }

    public static function getAvailableForDate($date)
    {
        return BarberSchedule::getAvailableBarbersForDate($date);
    }
}
