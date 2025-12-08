<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChallengeReport extends Model
{
    protected $fillable = [
        'user_id',
        'challenge_type',
        'title',
        'description',
        'severity',
        'status',
        'support_needed',
        'admin_response',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
