<?php

namespace App\Services;

use App\Models\Service;
use App\Models\Barber;
use Illuminate\Support\Facades\Cache;

class UserInterfaceService
{
    /**
     * Cache duration in seconds (30 minutes for better performance)
     */
    const CACHE_DURATION = 1800;

    /**
     * Get services with optimized caching
     */
    public function getServices()
    {
        return Cache::remember('ui_services_optimized', self::CACHE_DURATION, function () {
            return Service::select('id', 'name', 'description', 'price', 'duration', 'type', 'image', 'features')
                ->where('is_active', true)
                ->orderBy('type')
                ->orderBy('price')
                ->get()
                ->map(function ($service) {
                    // Optimize image paths
                    if ($service->image) {
                        $service->image = PerformanceService::optimizeImagePath($service->image);
                    }
                    return $service;
                });
        });
    }

    /**
     * Get barbers with optimized caching and eager loading
     */
    public function getBarbers()
    {
        return Cache::remember('ui_barbers_optimized', self::CACHE_DURATION, function () {
            return Barber::select('id', 'name', 'experience', 'specialty', 'bio', 'photo', 'rating', 'level', 'skills')
                ->with(['schedules:id,barber_id,day_of_week,start_time,end_time,is_available'])
                ->active()
                ->where('is_present', true)
                ->orderBy('level', 'desc')
                ->orderBy('rating', 'desc')
                ->get()
                ->map(function ($barber) {
                    // Optimize image paths
                    if ($barber->photo) {
                        $barber->photo = PerformanceService::optimizeImagePath('image/barbers/' . $barber->photo);
                    }
                    return $barber;
                });
        });
    }

    /**
     * Get services by type for faster filtering
     */
    public function getServicesByType()
    {
        return Cache::remember('ui_services_by_type', 600, function () {
            return Service::where('is_active', true)
                ->select('id', 'name', 'description', 'price', 'duration', 'type', 'image', 'features')
                ->get()
                ->groupBy('type');
        });
    }

    /**
     * Get barbers by level for faster filtering
     */
    public function getBarbersByLevel()
    {
        return Cache::remember('ui_barbers_by_level', 600, function () {
            return Barber::where('is_active', true)
                ->where('is_present', true)
                ->select('id', 'name', 'experience', 'specialty', 'bio', 'photo', 'rating', 'level', 'skills')
                ->get()
                ->groupBy('level');
        });
    }

    /**
     * Clear UI cache when data is updated
     */
    public function clearCache()
    {
        Cache::forget('ui_services');
        Cache::forget('ui_barbers');
        Cache::forget('ui_services_by_type');
        Cache::forget('ui_barbers_by_level');
    }

    /**
     * Get minimal data for navigation preloading
     */
    public function getNavigationData()
    {
        return Cache::remember('ui_navigation_data', 1800, function () { // Cache for 30 minutes
            return [
                'services_count' => Service::where('is_active', true)->count(),
                'barbers_count' => Barber::where('is_active', true)->where('is_present', true)->count(),
                'service_types' => Service::where('is_active', true)
                    ->distinct()
                    ->pluck('type')
                    ->toArray(),
                'barber_levels' => Barber::where('is_active', true)
                    ->where('is_present', true)
                    ->distinct()
                    ->pluck('level')
                    ->toArray(),
            ];
        });
    }
}