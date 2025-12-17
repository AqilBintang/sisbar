<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Performance Optimization Settings
    |--------------------------------------------------------------------------
    |
    | These settings help optimize the application performance for development
    | and production environments.
    |
    */

    'cache_dashboard_stats' => env('CACHE_DASHBOARD_STATS', true),
    'dashboard_cache_ttl' => env('DASHBOARD_CACHE_TTL', 300), // 5 minutes
    
    'enable_query_caching' => env('ENABLE_QUERY_CACHING', true),
    'query_cache_ttl' => env('QUERY_CACHE_TTL', 60), // 1 minute
    
    'optimize_images' => env('OPTIMIZE_IMAGES', true),
    'lazy_load_charts' => env('LAZY_LOAD_CHARTS', true),
];