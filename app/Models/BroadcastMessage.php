<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BroadcastMessage extends Model
{
    protected $fillable = [
        'title',
        'message',
        'type',
        'target_criteria',
        'status',
        'scheduled_at',
        'sent_at',
        'total_recipients',
        'successful_sends',
        'failed_sends',
        'created_by'
    ];

    protected $casts = [
        'target_criteria' => 'array',
        'scheduled_at' => 'datetime',
        'sent_at' => 'datetime',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function recipients(): HasMany
    {
        return $this->hasMany(BroadcastRecipient::class);
    }

    public function pendingRecipients(): HasMany
    {
        return $this->hasMany(BroadcastRecipient::class)->where('status', 'pending');
    }

    public function sentRecipients(): HasMany
    {
        return $this->hasMany(BroadcastRecipient::class)->where('status', 'sent');
    }

    public function failedRecipients(): HasMany
    {
        return $this->hasMany(BroadcastRecipient::class)->where('status', 'failed');
    }
}
