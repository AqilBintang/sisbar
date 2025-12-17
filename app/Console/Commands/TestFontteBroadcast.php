<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\FontteWhatsAppService;
use App\Models\User;

class TestFontteBroadcast extends Command
{
    protected $signature = 'fontte:test {--number=085729421875}';
    protected $description = 'Test Fonnte WhatsApp service';

    public function handle()
    {
        $number = $this->option('number');
        
        $this->info("Testing Fontte WhatsApp service...");
        $this->info("Target number: $number");
        
        // Check if Fonnte is configured
        if (!config('services.fonnte.token') || config('services.fonnte.token') === 'your_fonnte_token_here') {
            $this->error("Fonnte token not configured!");
            $this->info("Please set FONNTE_TOKEN in your .env file");
            $this->info("Get your token from: https://fonnte.com");
            return 1;
        }
        
        $fontteService = new FontteWhatsAppService();
        
        $message = "🧪 Test Broadcast dari Sisbar Hairstudio\n\n";
        $message .= "Halo! Ini adalah pesan test untuk memastikan sistem broadcast WhatsApp berfungsi dengan baik.\n\n";
        $message .= "✅ Jika Anda menerima pesan ini, berarti sistem broadcast sudah siap digunakan!\n\n";
        $message .= "Terima kasih,\nTim Sisbar Hairstudio";
        
        $this->info("Sending test message...");
        
        $result = $fontteService->sendMessage($number, $message);
        
        if ($result['success']) {
            $this->info("✅ Test message sent successfully!");
            $messageId = $result['message_id'] ?? 'N/A';
            if (is_array($messageId)) {
                $messageId = json_encode($messageId);
            }
            $this->info("Message ID: " . $messageId);
        } else {
            $this->error("❌ Failed to send test message");
            $this->error("Error: " . $result['error']);
        }
        
        // Test with all users who have WhatsApp numbers
        $this->info("\n--- Testing with registered users ---");
        
        $users = User::whereNotNull('whatsapp_number')
                    ->where('allow_broadcast', true)
                    ->get();
                    
        $this->info("Found " . $users->count() . " users with WhatsApp numbers");
        
        foreach ($users as $user) {
            $this->info("Testing user: {$user->name} ({$user->whatsapp_number})");
            
            $personalMessage = "Halo {$user->name}!\n\n";
            $personalMessage .= "Ini adalah test broadcast personal dari Sisbar Hairstudio.\n\n";
            $personalMessage .= "Sistem broadcast WhatsApp sudah siap digunakan untuk:\n";
            $personalMessage .= "📅 Pengingat booking\n";
            $personalMessage .= "🎉 Promo spesial\n";
            $personalMessage .= "💬 Notifikasi penting\n\n";
            $personalMessage .= "Terima kasih sudah bergabung dengan kami!";
            
            $result = $fontteService->sendMessage($user->whatsapp_number, $personalMessage);
            
            if ($result['success']) {
                $this->info("  ✅ Sent to {$user->name}");
            } else {
                $this->error("  ❌ Failed to send to {$user->name}: " . $result['error']);
            }
            
            // Small delay to avoid rate limiting
            sleep(1);
        }
        
        return 0;
    }
}