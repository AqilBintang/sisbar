<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'avatar',
        'whatsapp_number',
        'whatsapp_verified',
        'allow_broadcast',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'whatsapp_verified' => 'boolean',
            'allow_broadcast' => 'boolean',
        ];
    }

    public function broadcastMessages()
    {
        return $this->hasMany(BroadcastMessage::class, 'created_by');
    }

    public function broadcastRecipients()
    {
        return $this->hasMany(BroadcastRecipient::class);
    }

    public function bookings()
    {
        // Since Booking doesn't have user_id, we'll match by phone number
        return $this->hasMany(\App\Models\Booking::class, 'customer_phone', 'whatsapp_number');
    }
}
