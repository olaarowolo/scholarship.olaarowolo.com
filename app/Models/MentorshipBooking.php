<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MentorshipBooking extends Model
{
    protected $fillable = [
        'user_id',
        'mentor_preference',
        'preferred_date',
        'preferred_time',
        'session_type',
        'topic',
        'description',
        'status',
        'scheduled_at',
        'admin_notes',
    ];

    protected $casts = [
        'preferred_date' => 'date',
        'scheduled_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
