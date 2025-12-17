<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateTestUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create-test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create test user with company WhatsApp number';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Creating test user with company WhatsApp number...');
        
        // Create or update user with company number
        $user = User::updateOrCreate(
            ['email' => 'bintang@sisbar.com'],
            [
                'name' => 'Bintang Pradana (Perusahaan)',
                'email' => 'bintang@sisbar.com',
                'password' => Hash::make('password123'),
                'whatsapp_number' => '+6285729421875',
                'whatsapp_verified' => true, // Set as verified for testing
                'allow_broadcast' => true,
                'email_verified_at' => now(),
            ]
        );
        
        $this->info("✅ User created successfully:");
        $this->line("Name: {$user->name}");
        $this->line("Email: {$user->email}");
        $this->line("WhatsApp: {$user->whatsapp_number}");
        $this->line("Verified: " . ($user->whatsapp_verified ? 'Yes' : 'No'));
        
        return 0;
    }
}
