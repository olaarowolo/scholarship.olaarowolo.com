<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Visitor;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip tracking for admin routes, API routes, and static assets
        if ($this->shouldSkipTracking($request)) {
            return $next($request);
        }

        $ip = $this->getClientIp($request);
        $sessionId = session()->getId();

        // Skip private IPs
        if ($this->isPrivateIp($ip)) {
            return $next($request);
        }

        // Find or create visitor record
        $visitor = Visitor::findOrCreateVisitor($ip, $sessionId);

        // Update location data if not already set
        if (!$visitor->country) {
            $locationData = $this->getLocationFromIp($ip);
            if ($locationData) {
                $visitor->update([
                    'country' => $locationData['country'] ?? null,
                    'city' => $locationData['city'] ?? null,
                    'region' => $locationData['region'] ?? null,
                ]);
            }
        }

        // Update visit information
        $visitor->update([
            'last_visit_at' => now(),
            'visit_count' => $visitor->visit_count + 1,
        ]);

        return $next($request);
    }

    /**
     * Check if tracking should be skipped for this request
     */
    private function shouldSkipTracking(Request $request): bool
    {
        $path = $request->path();

        // Skip admin routes
        if (str_starts_with($path, 'admin/')) {
            return true;
        }

        // Skip API routes
        if (str_starts_with($path, 'api/')) {
            return true;
        }

        // Skip static assets
        if (preg_match('/\.(css|js|png|jpg|jpeg|gif|ico|svg|woff|woff2|ttf|eot)$/i', $path)) {
            return true;
        }

        return false;
    }

    /**
     * Get the real client IP address
     */
    private function getClientIp(Request $request): string
    {
        $headers = [
            'HTTP_CF_CONNECTING_IP',
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_X_CLUSTER_CLIENT_IP',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'REMOTE_ADDR'
        ];

        foreach ($headers as $header) {
            if ($request->server($header)) {
                $ip = $request->server($header);

                // Handle comma-separated IPs (X-Forwarded-For)
                if (str_contains($ip, ',')) {
                    $ip = trim(explode(',', $ip)[0]);
                }

                // Validate IP
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
                    return $ip;
                }
            }
        }

        return $request->ip();
    }

    /**
     * Check if IP is private
     */
    private function isPrivateIp(string $ip): bool
    {
        return !filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE);
    }

    /**
     * Get location data from IP using ip-api.com
     */
    private function getLocationFromIp(string $ip): ?array
    {
        try {
            $response = Http::timeout(5)->get("http://ip-api.com/json/{$ip}");

            if ($response->successful()) {
                $data = $response->json();

                if ($data['status'] === 'success') {
                    return [
                        'country' => $data['country'] ?? null,
                        'city' => $data['city'] ?? null,
                        'region' => $data['regionName'] ?? null,
                        'regionName' => $data['regionName'] ?? null, // State/Province
                        'district' => $data['district'] ?? null, // Local Government Area/District
                    ];
                }
            }
        } catch (\Exception $e) {
            // Log error but don't fail the request
            \Log::warning('Failed to get location data for IP: ' . $ip . ' - ' . $e->getMessage());
        }

        return null;
    }
}
