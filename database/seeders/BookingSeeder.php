<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Barber;
use App\Models\Service;
use Carbon\Carbon;
use Faker\Factory as Faker;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $barbers = Barber::all();
        $services = Service::all();

        if ($barbers->isEmpty() || $services->isEmpty()) {
            $this->command->info('Please run BarberSeeder and ServiceSeeder first');
            return;
        }

        $faker = Faker::create('id_ID');
        
        // Indonesian names for more realistic data
        $indonesianNames = [
            'Ahmad Rizki', 'Budi Santoso', 'Candra Wijaya', 'Dedi Kurniawan', 'Eko Prasetyo',
            'Fajar Ramadhan', 'Gilang Pratama', 'Hendra Saputra', 'Indra Wijaya', 'Joko Susanto',
            'Kevin Hartanto', 'Luki Hermawan', 'Mario Fernandez', 'Nanda Pratama', 'Oki Setiawan',
            'Putra Mahendra', 'Qori Abdullah', 'Rizky Ananda', 'Sandi Permana', 'Toni Setiawan',
            'Umar Hakim', 'Vino Pratama', 'Wahyu Nugroho', 'Xander Wijaya', 'Yudi Santoso',
            'Zaki Rahman', 'Andi Kurniawan', 'Bayu Setiawan', 'Coki Pardede', 'Dimas Anggara',
            'Erick Thohir', 'Fandi Ahmad', 'Gading Marten', 'Hamish Daud', 'Ivan Gunawan',
            'Jordi Onsu', 'Kiesha Alvaro', 'Lucky Hakim', 'Maulana Yusuf', 'Nino Fernandez',
            'Oscar Lawalata', 'Pasha Ungu', 'Qory Sandioriva', 'Raffi Ahmad', 'Syahrini',
            'Tulus Rusydi', 'Uya Kuya', 'Vidi Aldiano', 'Wulan Guritno', 'Yuki Kato',
            'Zaskia Gotik', 'Ariel Noah', 'Bastian Steel', 'Chand Kelvin', 'Desta Mahendra',
            'Enzy Storia', 'Fadil Jaidi', 'Gisella Anastasia', 'Herjunot Ali', 'Iqbaal Ramadhan',
            'Jessica Iskandar', 'Kirana Larasati', 'Luna Maya', 'Mikha Tambayong', 'Nikita Willy',
            'Olla Ramlan', 'Prilly Latuconsina', 'Raisa Andriana', 'Siti Badriah', 'Tasya Kamila',
            'Ussy Sulistiawaty', 'Vanesha Prescilla', 'Wika Salim', 'Yura Yunita', 'Zara Leola'
        ];

        $statuses = ['pending', 'confirmed', 'completed', 'cancelled'];
        $statusWeights = [25, 40, 30, 5]; // Percentage distribution

        $notes = [
            'Mohon potong rambut tidak terlalu pendek',
            'Ingin gaya rambut modern seperti artis Korea',
            'Booking untuk acara pernikahan',
            'Minta dipotong rapi untuk interview kerja',
            'Ingin highlight warna coklat muda',
            'Tolong smoothing yang natural',
            'Cornrow dengan pola geometris',
            'Treatment untuk rambut rontok',
            'Perm dengan gelombang besar',
            'Cukur jenggot model hipster',
            'Potong model undercut',
            'Warna rambut abu-abu silver',
            'Creambath yang relaxing',
            'Gaya rambut untuk photoshoot',
            'Mohon extra hati-hati, rambut sensitif',
            null, null, null, null, null // 25% chance of no notes
        ];

        // Generate bookings for the past 3 months to future 2 months
        $startDate = Carbon::now()->subMonths(3);
        $endDate = Carbon::now()->addMonths(2);
        
        $bookingsCount = 250; // Generate 250 bookings
        
        for ($i = 0; $i < $bookingsCount; $i++) {
            // Random date between start and end date
            $bookingDate = $faker->dateTimeBetween($startDate, $endDate);
            $bookingDate = Carbon::instance($bookingDate);
            
            // Skip Sundays for some realism (many barbershops closed on Sunday)
            if ($bookingDate->dayOfWeek === 0 && $faker->boolean(70)) {
                $bookingDate->addDay();
            }
            
            // Generate realistic booking times (9 AM to 8 PM)
            $hour = $faker->numberBetween(9, 20);
            $minute = $faker->randomElement([0, 15, 30, 45]);
            $bookingTime = sprintf('%02d:%02d', $hour, $minute);
            
            // Set realistic created_at timestamp (booking was made 1-7 days before booking_date)
            $daysBeforeBooking = $faker->numberBetween(1, 7);
            $createdAt = $bookingDate->copy()->subDays($daysBeforeBooking);
            
            // For past bookings, ensure created_at is also in the past
            if ($createdAt->isFuture()) {
                $createdAt = $bookingDate->copy()->subDays($faker->numberBetween(1, 3));
            }
            
            // Determine status based on date
            if ($bookingDate->isPast()) {
                $status = $faker->randomElement(['completed', 'cancelled'], [85, 15]);
            } elseif ($bookingDate->isToday()) {
                $status = $faker->randomElement(['confirmed', 'pending', 'completed'], [60, 25, 15]);
            } else {
                $status = $faker->randomElement(['confirmed', 'pending'], [70, 30]);
            }
            
            // Set payment status and method based on booking status
            if ($status === 'completed') {
                $paymentStatus = 'paid';
                $paymentMethod = $faker->randomElement(['cash', 'online'], [70, 30]);
            } elseif ($status === 'confirmed') {
                $paymentStatus = $faker->randomElement(['paid', 'pending'], [60, 40]);
                $paymentMethod = $faker->randomElement(['cash', 'online'], [60, 40]);
            } elseif ($status === 'cancelled') {
                $paymentStatus = $faker->randomElement(['failed', 'pending'], [30, 70]);
                $paymentMethod = $faker->randomElement(['cash', 'online'], [50, 50]);
            } else { // pending
                $paymentStatus = 'pending';
                $paymentMethod = $faker->randomElement(['cash', 'online'], [80, 20]);
            }
            
            $barber = $barbers->random();
            $service = $services->random();
            $customerName = $faker->randomElement($indonesianNames);
            
            // Generate phone number
            $phoneNumber = '08' . $faker->numerify('##########');
            
            // 70% chance of having email
            $email = $faker->boolean(70) ? $faker->email : null;
            
            // 40% chance of having notes
            $note = $faker->boolean(40) ? $faker->randomElement($notes) : null;
            
            // Generate Midtrans fields for paid online bookings
            $midtransOrderId = null;
            $midtransTransactionId = null;
            $snapToken = null;
            
            if ($paymentStatus === 'paid' && $paymentMethod === 'online') {
                $midtransOrderId = 'ORDER-' . strtoupper($faker->bothify('??##??##'));
                $midtransTransactionId = 'TXN-' . strtoupper($faker->bothify('??##??##??##'));
                $snapToken = $faker->sha256;
            }
            
            try {
                $booking = new Booking([
                    'customer_name' => $customerName,
                    'customer_phone' => $phoneNumber,
                    'customer_email' => $email,
                    'barber_id' => $barber->id,
                    'service_id' => $service->id,
                    'booking_date' => $bookingDate->format('Y-m-d'),
                    'booking_time' => $bookingTime,
                    'status' => $status,
                    'payment_status' => $paymentStatus,
                    'payment_method' => $paymentMethod,
                    'midtrans_order_id' => $midtransOrderId,
                    'midtrans_transaction_id' => $midtransTransactionId,
                    'snap_token' => $snapToken,
                    'notes' => $note,
                    'total_price' => $service->price,
                ]);
                
                // Set custom created_at and updated_at timestamps
                $booking->created_at = $createdAt;
                $booking->updated_at = $createdAt;
                $booking->save();
            } catch (\Exception $e) {
                // Skip if there's a conflict (same barber, date, time)
                continue;
            }
        }

        // Add some specific bookings for today and tomorrow for testing
        $specificBookings = [
            [
                'customer_name' => 'Admin Test',
                'customer_phone' => '081234567890',
                'customer_email' => 'admin@barbershop.com',
                'booking_date' => Carbon::today(),
                'booking_time' => '09:00',
                'status' => 'confirmed',
                'notes' => 'Booking test untuk admin dashboard',
            ],
            [
                'customer_name' => 'Customer VIP',
                'customer_phone' => '081234567891',
                'customer_email' => 'vip@customer.com',
                'booking_date' => Carbon::today(),
                'booking_time' => '14:00',
                'status' => 'pending',
                'notes' => 'Customer VIP - prioritas tinggi',
            ],
            [
                'customer_name' => 'Walk-in Customer',
                'customer_phone' => '081234567892',
                'customer_email' => null,
                'booking_date' => Carbon::tomorrow(),
                'booking_time' => '10:30',
                'status' => 'confirmed',
                'notes' => 'Walk-in customer, mohon siapkan',
            ],
        ];

        foreach ($specificBookings as $bookingData) {
            $barber = $barbers->random();
            $service = $services->random();
            
            // Set payment status based on booking status
            if ($bookingData['status'] === 'confirmed') {
                $paymentStatus = 'paid';
                $paymentMethod = 'online';
                $midtransOrderId = 'ORDER-ADMIN001';
                $midtransTransactionId = 'TXN-ADMIN001';
                $snapToken = 'snap-token-admin-test';
            } else {
                $paymentStatus = 'pending';
                $paymentMethod = 'cash';
                $midtransOrderId = null;
                $midtransTransactionId = null;
                $snapToken = null;
            }
            
            try {
                $booking = new Booking([
                    'customer_name' => $bookingData['customer_name'],
                    'customer_phone' => $bookingData['customer_phone'],
                    'customer_email' => $bookingData['customer_email'],
                    'barber_id' => $barber->id,
                    'service_id' => $service->id,
                    'booking_date' => $bookingData['booking_date'],
                    'booking_time' => $bookingData['booking_time'],
                    'status' => $bookingData['status'],
                    'payment_status' => $paymentStatus,
                    'payment_method' => $paymentMethod,
                    'midtrans_order_id' => $midtransOrderId,
                    'midtrans_transaction_id' => $midtransTransactionId,
                    'snap_token' => $snapToken,
                    'notes' => $bookingData['notes'],
                    'total_price' => $service->price,
                ]);
                
                // Set created_at to a few days before booking_date for test bookings
                $createdAt = Carbon::parse($bookingData['booking_date'])->subDays(2);
                $booking->created_at = $createdAt;
                $booking->updated_at = $createdAt;
                $booking->save();
            } catch (\Exception $e) {
                // Skip if there's a conflict
                continue;
            }
        }

        $this->command->info('Generated ' . Booking::count() . ' bookings successfully!');
    }
}