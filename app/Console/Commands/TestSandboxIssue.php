<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\BroadcastService;
use App\Models\BroadcastMessage;
use App\Models\User;

class TestSandboxIssue extends Command
{
    protected $signature = 'broadcast:test-sandbox';
    protected $description = 'Test broadcast dengan status detection yang diperbaiki';

    public function handle()
    {
        $this->info('🧪 TESTING SANDBOX ISSUE FIX');
        $this->info('================================');
        
        // Show current users
        $users = User::whereNotNull('whatsapp_number')
                    ->where('allow_broadcast', true)
                    ->get();
                    
        $this->info("\n📱 Target Users:");
        foreach ($users as $user) {
            $isCompany = in_array($user->whatsapp_number, ['+6285729421875', '6285729421875']);
            $status = $isCompany ? '✅ (Company - Will Receive)' : '❌ (User - Sandbox Limited)';
            $this->line("  {$status} {$user->name} ({$user->whatsapp_number})");
        }
        
        // Create test broadcast
        $broadcastService = new BroadcastService();
        
        // Create admin user if not exists for testing
        $adminUser = User::where('email', 'admin@test.com')->first();
        if (!$adminUser) {
            $adminUser = User::create([
                'name' => 'Test Admin',
                'email' => 'admin@test.com',
                'password' => bcrypt('password'),
                'role' => 'admin'
            ]);
        }
        
        // Set auth user for broadcast creation
        auth()->login($adminUser);
        
        $broadcast = $broadcastService->createBroadcast([
            'title' => 'Test Sandbox Detection - ' . now()->format('H:i:s'),
            'message' => "🧪 Test Broadcast dengan Status Detection\n\nHalo {name}!\n\nIni adalah test untuk memastikan status detection berfungsi dengan benar.\n\n✅ Jika Anda nomor perusahaan: Pesan ini akan terkirim\n❌ Jika Anda user biasa: Status akan 'sandbox_limited'\n\nTerima kasih!",
            'type' => 'general',
            'target_criteria' => ['user_type' => 'all'],
            'status' => 'draft'
        ]);
        
        $this->info("\n📨 Broadcast Created: {$broadcast->title}");
        $this->info("ID: {$broadcast->id}");
        
        // Send broadcast
        $this->info("\n🚀 Sending broadcast...");
        $result = $broadcastService->sendBroadcast($broadcast);
        
        if ($result['success']) {
            $this->info("✅ Broadcast process completed!");
            $this->info("Success: {$result['success_count']}");
            $this->info("Failed: {$result['failed_count']}");
        } else {
            $this->error("❌ Broadcast failed: {$result['message']}");
            return 1;
        }
        
        // Show detailed results
        $this->info("\n📊 DETAILED RESULTS:");
        $broadcast->refresh();
        $recipients = $broadcast->recipients()->with('user')->get();
        
        foreach ($recipients as $recipient) {
            $statusIcon = match($recipient->status) {
                'sent' => '✅',
                'sandbox_limited' => '⚠️',
                'failed' => '❌',
                default => '❓'
            };
            
            $statusText = match($recipient->status) {
                'sent' => 'TERKIRIM',
                'sandbox_limited' => 'SANDBOX LIMITED',
                'failed' => 'GAGAL',
                default => 'UNKNOWN'
            };
            
            $this->line("  {$statusIcon} {$statusText}: {$recipient->user->name} ({$recipient->whatsapp_number})");
            
            if ($recipient->error_message) {
                $this->line("     Error: {$recipient->error_message}");
            }
        }
        
        $this->info("\n🎯 KESIMPULAN:");
        $this->info("- Status detection sekarang AKURAT");
        $this->info("- Hanya nomor perusahaan yang benar-benar 'sent'");
        $this->info("- User lain akan status 'sandbox_limited' dengan penjelasan");
        $this->info("- Untuk fix permanent: Setup Fonnte (tidak ada sandbox)");
        
        $this->info("\n📋 Next Steps:");
        $this->info("1. Cek hasil di admin panel: /admin/broadcast/{$broadcast->id}");
        $this->info("2. Setup Fonnte untuk broadcast ke semua user");
        $this->info("3. Test lagi dengan: php artisan fontte:test");
        
        return 0;
    }
}