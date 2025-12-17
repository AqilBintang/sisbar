<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Services\BroadcastService;
use App\Services\WhatsAppService;

class TestBroadcast extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'broadcast:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test broadcast functionality';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Testing Broadcast Functionality...');
        
        // Check users with WhatsApp
        $users = User::whereNotNull('whatsapp_number')
                    ->where('allow_broadcast', true)
                    ->get();
        
        $this->info("Found {$users->count()} users with WhatsApp numbers:");
        
        foreach ($users as $user) {
            $verified = $user->whatsapp_verified ? '✅' : '❌';
            $this->line("- {$user->name} ({$user->whatsapp_number}) {$verified}");
        }
        
        if ($users->count() === 0) {
            $this->error('No users found with WhatsApp numbers!');
            return;
        }
        
        // Test WhatsApp service
        $testNumber = $users->first()->whatsapp_number;
        
        $this->info("\nTesting WhatsApp service with number: {$testNumber}");
        
        // Determine which service to use
        if (config('services.fonnte.token') && config('services.fonnte.token') !== 'your_fonnte_token_here') {
            $this->info("Using FONNTE WhatsApp service");
            $whatsappService = new \App\Services\FontteWhatsAppService();
        } elseif (config('services.twilio.sid') && config('services.twilio.sid') !== 'your_twilio_account_sid_here') {
            $this->info("Using TWILIO WhatsApp service");
            $whatsappService = app(WhatsAppService::class);
        } else {
            $this->warn("Using MOCK WhatsApp service (No service configured)");
            $whatsappService = new \App\Services\MockWhatsAppService();
        }
        
        $result = $whatsappService->sendMessage($testNumber, "🧪 Test message dari Sisbar Hairstudio!\n\nSistem broadcast WhatsApp sudah siap digunakan!");
        
        if ($result['success']) {
            $this->info("✅ Test message sent successfully!");
            $messageId = $result['message_id'] ?? $result['message_sid'] ?? 'N/A';
            if (is_array($messageId)) {
                $messageId = json_encode($messageId);
            }
            $this->line("Message ID: " . $messageId);
        } else {
            $this->error("❌ Failed to send test message:");
            $this->error($result['error'] ?? 'Unknown error');
        }
        
        // Test broadcast service
        $this->info("\nTesting Broadcast Service...");
        $broadcastService = app(BroadcastService::class);
        
        $targetUsers = $broadcastService->getTargetUsers(['user_type' => 'all']);
        $this->info("Target users for broadcast: {$targetUsers->count()}");
        
        return 0;
    }
}
