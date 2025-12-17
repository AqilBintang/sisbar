<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use Carbon\Carbon;

class ExpireBookings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bookings:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expire and delete unpaid online bookings older than 5 minutes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking for expired bookings...');
        
        // Find bookings that are:
        // 1. Online payment method
        // 2. Pending payment status
        // 3. Payment expired (payment_expires_at < now)
        $expiredBookings = Booking::where('payment_method', 'online')
            ->where('payment_status', 'pending')
            ->where('payment_expires_at', '<', Carbon::now())
            ->whereNotNull('payment_expires_at')
            ->get();
        
        if ($expiredBookings->isEmpty()) {
            $this->info('No expired bookings found.');
            return 0;
        }
        
        $count = $expiredBookings->count();
        
        foreach ($expiredBookings as $booking) {
            $this->info("Expiring booking ID: {$booking->id} (Customer: {$booking->customer_name})");
            $booking->delete();
        }
        
        $this->info("✅ Expired and deleted {$count} booking(s).");
        
        return 0;
    }
}
