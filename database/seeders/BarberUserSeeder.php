<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BarberUser;
use App\Models\Barber;

class BarberUserSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Get first few barbers to create accounts for
        $barbers = Barber::take(3)->get();
        
        if ($barbers->count() > 0) {
            // Create account for first barber
            BarberUser::create([
                'barber_id' => $barbers[0]->id,
                'username' => 'kapster1',
                'password' => 'password123',
                'name' => $barbers[0]->name,
                'email' => 'kapster1@sisbar.com',
                'phone' => '081234567890',
                'is_active' => true,
            ]);
            
            if ($barbers->count() > 1) {
                // Create account for second barber
                BarberUser::create([
                    'barber_id' => $barbers[1]->id,
                    'username' => 'kapster2',
                    'password' => 'password123',
                    'name' => $barbers[1]->name,
                    'email' => 'kapster2@sisbar.com',
                    'phone' => '081234567891',
                    'is_active' => true,
                ]);
            }
            
            if ($barbers->count() > 2) {
                // Create account for third barber
                BarberUser::create([
                    'barber_id' => $barbers[2]->id,
                    'username' => 'kapster3',
                    'password' => 'password123',
                    'name' => $barbers[2]->name,
                    'email' => 'kapster3@sisbar.com',
                    'phone' => '081234567892',
                    'is_active' => true,
                ]);
            }
        }
    }
}