<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BroadcastMessage;
use App\Models\User;
use App\Services\BroadcastService;
use Illuminate\Support\Facades\Auth;

class SendTestBroadcast extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'broadcast:send-test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send test broadcast to company WhatsApp number';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Sending Test Broadcast...');
        
        // Get admin user (create if not exists)
        $admin = User::firstOrCreate(
            ['email' => 'admin@sisbar.com'],
            [
                'name' => 'Admin Sisbar',
                'email' => 'admin@sisbar.com',
                'password' => bcrypt('admin123'),
                'email_verified_at' => now(),
            ]
        );
        
        // Set admin as authenticated user
        Auth::login($admin);
        
        $broadcastService = app(BroadcastService::class);
        
        // Create test broadcast
        $broadcast = $broadcastService->createBroadcast([
            'title' => 'Test Broadcast Sisbar Hairstudio',
            'message' => "🎉 Halo {name}!\n\nIni adalah test broadcast dari Sisbar Hairstudio.\n\n📱 Nomor WhatsApp Anda: {whatsapp_number}\n⏰ Waktu: " . now()->format('d/m/Y H:i') . "\n\nTerima kasih telah bergabung dengan kami! 💇‍♂️✨",
            'type' => 'general',
            'target_criteria' => ['user_type' => 'all'],
            'status' => 'draft'
        ]);
        
        $this->info("✅ Broadcast created: {$broadcast->title}");
        
        // Send broadcast
        $result = $broadcastService->sendBroadcast($broadcast);
        
        if ($result['success']) {
            $this->info("🎉 Broadcast sent successfully!");
            $this->line("📊 Success: {$result['success_count']} messages");
            $this->line("❌ Failed: {$result['failed_count']} messages");
            
            // Show recipients
            $this->info("\n📱 Messages sent to:");
            foreach ($broadcast->recipients as $recipient) {
                $status = $recipient->status === 'sent' ? '✅' : '❌';
                $this->line("  {$status} {$recipient->user->name} ({$recipient->whatsapp_number})");
            }
            
        } else {
            $this->error("❌ Failed to send broadcast:");
            $this->error($result['message']);
        }
        
        return 0;
    }
}
