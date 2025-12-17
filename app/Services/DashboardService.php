<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Service;
use App\Models\Barber;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    /**
     * Get dashboard statistics with caching
     */
    public function getDashboardStats()
    {
        return Cache::remember('dashboard_stats', 300, function () {
            return [
                'today' => $this->getTodayStats(),
                'monthly' => $this->getMonthlyStats(),
                'total_revenue' => $this->getTotalRevenue(),
                'service_counts' => $this->getServiceCounts(),
                'barber_counts' => $this->getBarberCounts(),
            ];
        });
    }

    /**
     * Get today's statistics
     */
    private function getTodayStats()
    {
        return Booking::whereDate('created_at', today())
            ->where('payment_status', 'paid')
            ->selectRaw('COUNT(*) as count, COALESCE(SUM(total_price), 0) as revenue')
            ->first();
    }

    /**
     * Get monthly statistics
     */
    private function getMonthlyStats()
    {
        return Booking::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->selectRaw('
                COUNT(*) as total_bookings, 
                COALESCE(SUM(CASE WHEN payment_status = "paid" THEN total_price ELSE 0 END), 0) as revenue,
                COUNT(CASE WHEN status = "pending" THEN 1 END) as pending_bookings
            ')
            ->first();
    }

    /**
     * Get total revenue
     */
    private function getTotalRevenue()
    {
        return Booking::where('payment_status', 'paid')
            ->sum('total_price') ?? 0;
    }

    /**
     * Get service counts
     */
    private function getServiceCounts()
    {
        return Service::where('is_active', true)->count();
    }

    /**
     * Get barber counts
     */
    private function getBarberCounts()
    {
        return Barber::where('is_active', true)->count();
    }

    /**
     * Get revenue chart data with caching
     */
    public function getRevenueChartData($days = 7)
    {
        $cacheKey = "revenue_chart_data_{$days}";
        
        return Cache::remember($cacheKey, 60, function () use ($days) {
            $revenueData = [];
            $labels = [];
            
            for ($i = $days - 1; $i >= 0; $i--) {
                $date = now()->subDays($i);
                $labels[] = $date->format($days > 30 ? 'M d' : 'M d');
                
                $revenue = Booking::whereDate('created_at', $date)
                    ->where('payment_status', 'paid')
                    ->sum('total_price') ?? 0;
                    
                $revenueData[] = (float) $revenue;
            }
            
            $total = array_sum($revenueData);
            $average = $total / count($revenueData);
            
            return [
                'labels' => $labels,
                'revenue' => $revenueData,
                'total' => $total,
                'average' => $average
            ];
        });
    }

    /**
     * Clear dashboard cache
     */
    public function clearCache()
    {
        Cache::forget('dashboard_stats');
        Cache::forget('revenue_chart_data_7');
        Cache::forget('revenue_chart_data_14');
        Cache::forget('revenue_chart_data_30');
        Cache::forget('revenue_chart_data_90');
    }
}