<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class BarberUser extends Authenticatable
{
    protected $fillable = [
        'barber_id',
        'username',
        'password',
        'name',
        'email',
        'phone',
        'is_active',
        'last_login'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'last_login' => 'datetime'
    ];

    public function barber()
    {
        return $this->belongsTo(Barber::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'barber_id', 'barber_id');
    }

    public function todayBookings()
    {
        return $this->bookings()->whereDate('booking_date', today());
    }

    public function upcomingBookings()
    {
        return $this->bookings()->where('booking_date', '>=', today())->orderBy('booking_date')->orderBy('booking_time');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function getFormattedLastLoginAttribute()
    {
        return $this->last_login ? $this->last_login->format('d M Y H:i') : 'Belum pernah login';
    }
}
