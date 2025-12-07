<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserConsent extends Model
{
    protected $fillable = [
        'session_id',
        'ip_address',
        'terms_accepted',
        'privacy_accepted',
        'accepted_at',
        'user_agent',
    ];

    protected $casts = [
        'terms_accepted' => 'boolean',
        'privacy_accepted' => 'boolean',
        'accepted_at' => 'datetime',
    ];

    /**
     * Check if user has given consent
     */
    public static function hasConsent(string $sessionId, string $ipAddress): bool
    {
        return self::where('session_id', $sessionId)
            ->where('ip_address', $ipAddress)
            ->where('terms_accepted', true)
            ->where('privacy_accepted', true)
            ->exists();
    }

    /**
     * Record user consent
     */
    public static function recordConsent(string $sessionId, string $ipAddress, string $userAgent): self
    {
        return self::updateOrCreate(
            [
                'session_id' => $sessionId,
                'ip_address' => $ipAddress,
            ],
            [
                'terms_accepted' => true,
                'privacy_accepted' => true,
                'accepted_at' => now(),
                'user_agent' => $userAgent,
            ]
        );
    }
}
