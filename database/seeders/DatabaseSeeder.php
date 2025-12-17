<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@barbershop.com',
            'password' => bcrypt('password'),
        ]);

        // Seed all barbershop data
        $this->call([
            ServiceSeeder::class,
            BarberSeeder::class,
            BarberScheduleSeeder::class,
            BookingSeeder::class,
            BarberUserSeeder::class,
        ]);
    }
}
