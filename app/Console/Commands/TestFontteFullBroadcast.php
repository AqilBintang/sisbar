<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\BroadcastService;
use App\Models\BroadcastMessage;
use App\Models\User;

class TestFontteFullBroadcast extends Command
{
    protected $signature = 'fontte:broadcast-test';
    protected $description = 'Test full broadcast dengan Fontte (semua user akan menerima)';

    public function handle()
    {
        $this->info('🚀 TESTING FONTTE FULL BROADCAST');
        $this->info('==================================');
        
        // Show current users
        $users = User::whereNotNull('whatsapp_number')
                    ->where('allow_broadcast', true)
                    ->get();
                    
        $this->info("\n📱 Target Users (SEMUA AKAN MENERIMA dengan Fontte):");
        foreach ($users as $user) {
            $this->line("  ✅ {$user->name} ({$user->whatsapp_number})");
        }
        
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
        
        // Create test broadcast
        $broadcastService = new BroadcastService();
        
        $broadcast = $broadcastService->createBroadcast([
            'title' => 'Test Fontte Broadcast - ' . now()->format('H:i:s'),
            'message' => "🎉 FONTTE BROADCAST TEST BERHASIL!\n\nHalo {name}!\n\nSelamat! Anda menerima pesan ini karena:\n✅ Sistem sudah menggunakan Fontte\n✅ Tidak ada batasan sandbox\n✅ Semua nomor Indonesia bisa menerima\n\nBroadcast WhatsApp Sisbar Hairstudio siap digunakan!\n\nTerima kasih,\nTim Sisbar Hairstudio 💇‍♂️",
            'type' => 'general',
            'target_criteria' => ['user_type' => 'all'],
            'status' => 'draft'
        ]);
        
        $this->info("\n📨 Broadcast Created: {$broadcast->title}");
        $this->info("ID: {$broadcast->id}");
        
        // Send broadcast
        $this->info("\n🚀 Sending broadcast dengan Fontte...");
        $result = $broadcastService->sendBroadcast($broadcast);
        
        if ($result['success']) {
            $this->info("✅ Broadcast berhasil dikirim!");
            $this->info("✅ Success: {$result['success_count']} users");
            $this->info("❌ Failed: {$result['failed_count']} users");
        } else {
            $this->error("❌ Broadcast failed: {$result['message']}");
            return 1;
        }
        
        // Show detailed results
        $this->info("\n📊 DETAILED RESULTS:");
        $broadcast->refresh();
        $recipients = $broadcast->recipients()->with('user')->get();
        
        $sentCount = 0;
        $failedCount = 0;
        
        foreach ($recipients as $recipient) {
            $statusIcon = match($recipient->status) {
                'sent' => '✅',
                'failed' => '❌',
                'sandbox_limited' => '⚠️',
                default => '❓'
            };
            
            $statusText = match($recipient->status) {
                'sent' => 'TERKIRIM',
                'failed' => 'GAGAL',
                'sandbox_limited' => 'SANDBOX LIMITED',
                default => 'UNKNOWN'
            };
            
            if ($recipient->status === 'sent') {
                $sentCount++;
            } else {
                $failedCount++;
            }
            
            $this->line("  {$statusIcon} {$statusText}: {$recipient->user->name} ({$recipient->whatsapp_number})");
            
            if ($recipient->error_message) {
                $this->line("     Error: {$recipient->error_message}");
            }
        }
        
        $this->info("\n🎯 HASIL AKHIR:");
        if ($sentCount === $users->count()) {
            $this->info("🎉 PERFECT! Semua {$sentCount} user menerima broadcast!");
            $this->info("✅ Fontte berhasil mengatasi masalah Twilio sandbox");
            $this->info("✅ Sistem broadcast siap untuk production!");
        } else {
            $this->warn("⚠️ {$sentCount} berhasil, {$failedCount} gagal");
            $this->info("Cek error message di atas untuk detail");
        }
        
        $this->info("\n📱 CEK WHATSAPP ANDA!");
        $this->info("Semua user yang terdaftar seharusnya menerima pesan broadcast.");
        
        $this->info("\n🎊 SISTEM SIAP PRODUCTION:");
        $this->info("1. Akses admin panel: /admin/broadcast");
        $this->info("2. Buat broadcast untuk customer");
        $this->info("3. Kirim promo, reminder, notifikasi");
        $this->info("4. Monitor hasil di dashboard");
        
        return 0;
    }
}