<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Visitor extends Model
{
    protected $fillable = [
        'ip_address',
        'country',
        'city',
        'region',
        'user_agent',
        'session_id',
        'last_visit_at',
        'visit_count',
    ];

    protected $casts = [
        'last_visit_at' => 'datetime',
        'visit_count' => 'integer',
    ];

    /**
     * Find or create a visitor record
     */
    public static function findOrCreateVisitor(string $ipAddress, string $sessionId): self
    {
        $visitor = self::where('ip_address', $ipAddress)
            ->where('session_id', $sessionId)
            ->first();

        if (!$visitor) {
            $visitor = self::create([
                'ip_address' => $ipAddress,
                'session_id' => $sessionId,
                'user_agent' => request()->userAgent(),
                'last_visit_at' => now(),
                'visit_count' => 0,
            ]);
        }

        return $visitor;
    }

    /**
     * Get visitor statistics
     */
    public static function getStatistics(): array
    {
        return [
            'total_visitors' => self::count(),
            'visits_today' => self::whereDate('last_visit_at', today())->sum('visit_count'),
            'unique_visitors_today' => self::whereDate('last_visit_at', today())->count(),
            'top_countries' => self::selectRaw('country, COUNT(*) as count')
                ->whereNotNull('country')
                ->groupBy('country')
                ->orderBy('count', 'desc')
                ->limit(10)
                ->get()
                ->toArray(),
            'top_states' => self::selectRaw('state, COUNT(*) as count')
                ->whereNotNull('state')
                ->groupBy('state')
                ->orderBy('count', 'desc')
                ->limit(10)
                ->get()
                ->toArray(),
            'top_lgas' => self::selectRaw('lga, state, COUNT(*) as count')
                ->whereNotNull('lga')
                ->groupBy('lga', 'state')
                ->orderBy('count', 'desc')
                ->limit(10)
                ->get()
                ->toArray(),
            'recent_visits' => self::orderBy('last_visit_at', 'desc')
                ->limit(20)
                ->get()
                ->toArray(),
        ];
    }
}
