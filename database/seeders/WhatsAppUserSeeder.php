<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class WhatsAppUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create test users with WhatsApp numbers
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('password'),
                'whatsapp_number' => '+6281234567890',
                'whatsapp_verified' => true,
                'allow_broadcast' => true,
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => Hash::make('password'),
                'whatsapp_number' => '+6281234567891',
                'whatsapp_verified' => true,
                'allow_broadcast' => true,
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Bob Johnson',
                'email' => 'bob@example.com',
                'password' => Hash::make('password'),
                'whatsapp_number' => '+6281234567892',
                'whatsapp_verified' => true,
                'allow_broadcast' => false, // This user opted out
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Alice Brown',
                'email' => 'alice@example.com',
                'password' => Hash::make('password'),
                'whatsapp_number' => '+6281234567893',
                'whatsapp_verified' => false, // Not verified yet
                'allow_broadcast' => true,
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Charlie Wilson',
                'email' => 'charlie@example.com',
                'password' => Hash::make('password'),
                'whatsapp_number' => '+6281234567894',
                'whatsapp_verified' => true,
                'allow_broadcast' => true,
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Diana Prince',
                'email' => 'diana@example.com',
                'password' => Hash::make('password'),
                'whatsapp_number' => '+6285678901234',
                'whatsapp_verified' => true,
                'allow_broadcast' => true,
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Edward Smith',
                'email' => 'edward@example.com',
                'password' => Hash::make('password'),
                'whatsapp_number' => '+6287890123456',
                'whatsapp_verified' => true,
                'allow_broadcast' => true,
                'email_verified_at' => now(),
            ],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }

        $this->command->info('WhatsApp test users created successfully!');
    }
}
