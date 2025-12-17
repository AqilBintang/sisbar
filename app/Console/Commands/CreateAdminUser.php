<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class CreateAdminUser extends Command
{
    protected $signature = 'admin:create';
    protected $description = 'Create admin user for broadcast testing';

    public function handle()
    {
        $adminUser = User::where('email', 'admin@sisbar.com')->first();
        
        if (!$adminUser) {
            $adminUser = User::create([
                'name' => 'Admin Sisbar',
                'email' => 'admin@sisbar.com',
                'password' => bcrypt('admin123'),
                'role' => 'admin',
                'whatsapp_number' => '+6285729421875',
                'whatsapp_verified' => true,
                'allow_broadcast' => false
            ]);
            
            $this->info("✅ Admin user created successfully!");
            $this->info("Email: admin@sisbar.com");
            $this->info("Password: admin123");
        } else {
            $this->info("✅ Admin user already exists!");
            $this->info("Email: " . $adminUser->email);
        }
        
        $this->info("\n🚀 Now you can:");
        $this->info("1. Visit: http://localhost:8000/admin-login-test (auto login)");
        $this->info("2. Or login manually at admin panel");
        
        return 0;
    }
}