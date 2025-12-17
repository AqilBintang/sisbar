<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\UserInterfaceService;
use App\Services\PerformanceService;
use Illuminate\Support\Facades\Cache;

class WarmCacheCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'cache:warm {--clear : Clear cache before warming}';

    /**
     * The console command description.
     */
    protected $description = 'Warm up application cache for better performance';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔥 Starting cache warming...');
        
        if ($this->option('clear')) {
            $this->info('🧹 Clearing existing cache...');
            Cache::flush();
        }
        
        $uiService = new UserInterfaceService();
        
        // Warm up services cache
        $this->info('📋 Warming services cache...');
        $services = $uiService->getServices();
        $this->line("   ✅ Cached {$services->count()} services");
        
        // Warm up barbers cache
        $this->info('👨‍💼 Warming barbers cache...');
        $barbers = $uiService->getBarbers();
        $this->line("   ✅ Cached {$barbers->count()} barbers");
        
        // Warm up services by type
        $this->info('🏷️ Warming services by type cache...');
        $servicesByType = $uiService->getServicesByType();
        $this->line("   ✅ Cached services in {$servicesByType->count()} categories");
        
        // Warm up barbers by level
        $this->info('⭐ Warming barbers by level cache...');
        $barbersByLevel = $uiService->getBarbersByLevel();
        $this->line("   ✅ Cached barbers in {$barbersByLevel->count()} levels");
        
        // Warm up navigation data
        $this->info('🧭 Warming navigation data cache...');
        $navData = $uiService->getNavigationData();
        $this->line("   ✅ Cached navigation data");
        
        // Preload critical data
        $this->info('🚀 Preloading critical data...');
        PerformanceService::preloadCriticalData();
        Cache::put('critical_data_loaded', true, 3600);
        $this->line("   ✅ Critical data preloaded");
        
        $this->info('');
        $this->info('🎉 Cache warming completed successfully!');
        $this->info('💡 Your application should now load faster.');
        
        return Command::SUCCESS;
    }
}
