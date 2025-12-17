<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\BroadcastMessage;

class ShowBroadcastStatus extends Command
{
    protected $signature = 'broadcast:status';
    protected $description = 'Show current broadcast system status';

    public function handle()
    {
        $this->info('=== SISBAR HAIRSTUDIO - BROADCAST STATUS ===');
        
        // Users with WhatsApp
        $users = User::whereNotNull('whatsapp_number')->get();
        $this->info("\n📱 USERS WITH WHATSAPP:");
        $this->info("Total: " . $users->count() . " users");
        
        foreach ($users as $user) {
            $verified = $user->whatsapp_verified ? '✅' : '❌';
            $broadcast = $user->allow_broadcast ? '📢' : '🔇';
            $this->line("  {$broadcast} {$verified} {$user->name} ({$user->whatsapp_number})");
        }
        
        // Broadcast messages
        $broadcasts = BroadcastMessage::count();
        $this->info("\n📨 BROADCAST MESSAGES:");
        $this->info("Total created: $broadcasts");
        
        if ($broadcasts > 0) {
            $recent = BroadcastMessage::latest()->take(3)->get();
            $this->info("Recent broadcasts:");
            foreach ($recent as $broadcast) {
                $status = match($broadcast->status) {
                    'draft' => '📝',
                    'sent' => '✅',
                    'scheduled' => '⏰',
                    'failed' => '❌',
                    default => '❓'
                };
                $this->line("  {$status} {$broadcast->title} ({$broadcast->status})");
            }
        }
        
        // Service configuration
        $this->info("\n🔧 SERVICE CONFIGURATION:");
        
        if (config('services.fonnte.token') && config('services.fonnte.token') !== 'your_fonnte_token_here') {
            $this->info("  ✅ Fonnte: Configured (Primary)");
        } else {
            $this->warn("  ❌ Fonnte: Not configured");
        }
        
        if (config('services.twilio.sid') && config('services.twilio.sid') !== 'your_twilio_account_sid_here') {
            $this->info("  ✅ Twilio: Configured (Fallback)");
        } else {
            $this->warn("  ❌ Twilio: Not configured");
        }
        
        // Next steps
        $this->info("\n🚀 NEXT STEPS:");
        if (!config('services.fontte.token') || config('services.fontte.token') === 'your_fonnte_token_here') {
            $this->warn("  1. Setup Fonnte token in .env file");
            $this->info("     - Visit: https://fonnte.com");
            $this->info("     - Get token and add: FONNTE_TOKEN=your_token");
        } else {
            $this->info("  1. ✅ Fontte configured");
        }
        
        $this->info("  2. Test broadcast: php artisan broadcast:test");
        $this->info("  3. Access admin panel: /admin/broadcast");
        $this->info("  4. Create your first broadcast!");
        
        return 0;
    }
}