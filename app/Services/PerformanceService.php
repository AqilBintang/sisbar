<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PerformanceService
{
    /**
     * Cache duration in seconds (30 minutes)
     */
    const CACHE_DURATION = 1800;

    /**
     * Get cached data with fallback
     */
    public static function remember(string $key, callable $callback, int $duration = self::CACHE_DURATION)
    {
        try {
            return Cache::remember($key, $duration, $callback);
        } catch (\Exception $e) {
            Log::warning("Cache failed for key: {$key}", ['error' => $e->getMessage()]);
            return $callback();
        }
    }

    /**
     * Clear specific cache keys
     */
    public static function clearCache(array $keys = [])
    {
        if (empty($keys)) {
            Cache::flush();
            return;
        }

        foreach ($keys as $key) {
            Cache::forget($key);
        }
    }

    /**
     * Get database performance stats
     */
    public static function getDatabaseStats()
    {
        return self::remember('db_stats', function () {
            return [
                'total_queries' => DB::getQueryLog(),
                'connection_status' => DB::connection()->getPdo() ? 'connected' : 'disconnected',
                'cache_hits' => Cache::get('cache_hits', 0),
            ];
        }, 300); // 5 minutes cache
    }

    /**
     * Optimize images by checking if they exist
     */
    public static function optimizeImagePath(string $path): string
    {
        $fullPath = public_path($path);
        
        if (!file_exists($fullPath)) {
            // Return placeholder or default image
            return asset('images/placeholder.jpg');
        }
        
        return asset($path);
    }

    /**
     * Preload critical resources
     */
    public static function preloadCriticalData()
    {
        // Preload services
        self::remember('critical_services', function () {
            return \App\Models\Service::select('id', 'name', 'price', 'type')
                ->where('is_active', true)
                ->orderBy('type')
                ->limit(6)
                ->get();
        });

        // Preload barbers
        self::remember('critical_barbers', function () {
            return \App\Models\Barber::select('id', 'name', 'level', 'rating', 'photo')
                ->active()
                ->orderBy('rating', 'desc')
                ->limit(6)
                ->get();
        });
    }

    /**
     * Get optimized pagination
     */
    public static function getPaginatedData(string $model, int $perPage = 10, array $columns = ['*'])
    {
        $cacheKey = "paginated_{$model}_{$perPage}_" . md5(implode(',', $columns));
        
        return self::remember($cacheKey, function () use ($model, $perPage, $columns) {
            $modelClass = "\\App\\Models\\{$model}";
            return $modelClass::select($columns)->paginate($perPage);
        }, 600); // 10 minutes
    }

    /**
     * Optimize query with eager loading
     */
    public static function optimizeQuery($query, array $relations = [])
    {
        if (!empty($relations)) {
            $query->with($relations);
        }
        
        return $query;
    }

    /**
     * Monitor slow queries
     */
    public static function enableQueryLogging()
    {
        DB::listen(function ($query) {
            if ($query->time > 1000) { // Log queries taking more than 1 second
                Log::warning('Slow Query Detected', [
                    'sql' => $query->sql,
                    'bindings' => $query->bindings,
                    'time' => $query->time . 'ms'
                ]);
            }
        });
    }
}