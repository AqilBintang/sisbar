<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cache;
use App\Services\PerformanceService;

class PerformanceMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $startTime = microtime(true);
        
        // Enable query logging for performance monitoring
        if (config('app.debug')) {
            PerformanceService::enableQueryLogging();
        }
        
        // Preload critical data for first-time visitors
        if (!Cache::has('critical_data_loaded')) {
            PerformanceService::preloadCriticalData();
            Cache::put('critical_data_loaded', true, 3600); // 1 hour
        }
        
        $response = $next($request);
        
        // Add performance headers
        $executionTime = round((microtime(true) - $startTime) * 1000, 2);
        
        if ($response instanceof \Illuminate\Http\Response) {
            $response->headers->set('X-Execution-Time', $executionTime . 'ms');
            $response->headers->set('X-Memory-Usage', round(memory_get_peak_usage(true) / 1024 / 1024, 2) . 'MB');
            
            // Add cache headers for static content
            if ($request->is('images/*') || $request->is('css/*') || $request->is('js/*')) {
                $response->headers->set('Cache-Control', 'public, max-age=31536000'); // 1 year
                $response->headers->set('Expires', gmdate('D, d M Y H:i:s \G\M\T', time() + 31536000));
            }
            
            // Add compression hint
            if (!$response->headers->has('Content-Encoding')) {
                $response->headers->set('Vary', 'Accept-Encoding');
            }
        }
        
        return $response;
    }
}
