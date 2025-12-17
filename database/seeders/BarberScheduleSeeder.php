<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barber;
use App\Models\BarberSchedule;

class BarberScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barbers = Barber::all();

        foreach ($barbers as $barber) {
            // Create different schedules for each barber
            switch ($barber->name) {
                case 'Budi Santoso': // Master - Selasa - Minggu
                    $days = ['tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                    $startTime = '10:00';
                    $endTime = '19:00';
                    break;
                    
                case 'Ahmad Rizki': // Senior - Senin - Sabtu
                    $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
                    $startTime = '09:00';
                    $endTime = '18:00';
                    break;
                    
                case 'Dedi Kurniawan': // Professional - Senin - Sabtu
                    $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
                    $startTime = '11:00';
                    $endTime = '20:00';
                    break;
                    
                case 'Eko Prasetyo': // Junior - Senin - Minggu
                    $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                    $startTime = '09:00';
                    $endTime = '21:00';
                    break;
                    
                case 'Fajar Ramadhan': // Specialist - Rabu - Minggu
                    $days = ['wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                    $startTime = '10:00';
                    $endTime = '18:00';
                    break;
                    
                case 'Gilang Pratama': // Creative - Selasa - Sabtu
                    $days = ['tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
                    $startTime = '12:00';
                    $endTime = '21:00';
                    break;
                    
                default:
                    $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];
                    $startTime = '09:00';
                    $endTime = '17:00';
                    break;
            }

            foreach ($days as $day) {
                BarberSchedule::create([
                    'barber_id' => $barber->id,
                    'day_of_week' => $day,
                    'start_time' => $startTime,
                    'end_time' => $endTime,
                    'is_available' => true,
                ]);
            }
        }
    }
}
