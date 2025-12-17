<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            // Haircut Services
            [
                'name' => 'Haircut',
                'description' => 'Potong rambut klasik dengan teknik profesional untuk penampilan rapi dan stylish',
                'price' => 35000,
                'duration' => 30,
                'type' => 'populer',
                'image' => 'services/haircut.jpg',
                'features' => ['Konsultasi gaya rambut', 'Potong rambut profesional', 'Styling dasar'],
                'is_active' => true,
            ],
            [
                'name' => 'Haircut Premium',
                'description' => 'Layanan potong rambut premium dengan konsultasi mendalam dan styling eksklusif',
                'price' => 65000,
                'duration' => 45,
                'type' => 'premium',
                'image' => 'services/haircut-premium.jpg',
                'features' => ['Konsultasi mendalam', 'Analisis bentuk wajah', 'Styling premium', 'Hair wash'],
                'is_active' => true,
            ],
            
            // Hair Treatment Services
            [
                'name' => 'Smoothing',
                'description' => 'Perawatan smoothing untuk rambut lurus, halus dan berkilau alami',
                'price' => 150000,
                'duration' => 120,
                'type' => 'premium',
                'image' => 'services/smoothing.jpg',
                'features' => ['Hair analysis', 'Smoothing treatment', 'Blow dry styling', 'Hair protection'],
                'is_active' => true,
            ],
            [
                'name' => 'Coloring',
                'description' => 'Pewarnaan rambut profesional dengan berbagai pilihan warna trendy',
                'price' => 120000,
                'duration' => 90,
                'type' => 'premium',
                'image' => 'services/coloring.jpg',
                'features' => ['Color consultation', 'Professional coloring', 'Hair protection', 'Styling finish'],
                'is_active' => true,
            ],
            [
                'name' => 'Highlight',
                'description' => 'Teknik highlight untuk memberikan dimensi dan aksen warna pada rambut',
                'price' => 100000,
                'duration' => 75,
                'type' => 'premium',
                'image' => 'services/highlight.jpg',
                'features' => ['Highlight technique', 'Color blending', 'Professional application', 'Styling'],
                'is_active' => true,
            ],
            [
                'name' => 'Perm',
                'description' => 'Perawatan perm untuk rambut keriting atau bergelombang yang tahan lama',
                'price' => 180000,
                'duration' => 150,
                'type' => 'premium',
                'image' => 'services/perm.jpg',
                'features' => ['Hair assessment', 'Perm treatment', 'Curl formation', 'Aftercare guidance'],
                'is_active' => true,
            ],
            
            // Specialty Services
            [
                'name' => 'Cornrow',
                'description' => 'Gaya rambut cornrow tradisional dengan teknik kepangan yang rapi dan artistik',
                'price' => 85000,
                'duration' => 90,
                'type' => 'populer',
                'image' => 'services/cornrow.jpg',
                'features' => ['Traditional braiding', 'Pattern design', 'Hair preparation', 'Maintenance tips'],
                'is_active' => true,
            ],
            
            // Hair Care Services
            [
                'name' => 'Perawatan Ketombe',
                'description' => 'Treatment khusus untuk mengatasi masalah ketombe dan kulit kepala bermasalah',
                'price' => 75000,
                'duration' => 60,
                'type' => 'populer',
                'image' => 'services/dandruff-treatment.jpg',
                'features' => ['Scalp analysis', 'Anti-dandruff treatment', 'Deep cleansing', 'Scalp massage'],
                'is_active' => true,
            ],
            [
                'name' => 'Perawatan Rambut Rusak',
                'description' => 'Treatment intensif untuk memperbaiki rambut rusak, kering dan bercabang',
                'price' => 95000,
                'duration' => 75,
                'type' => 'premium',
                'image' => 'services/hair-repair.jpg',
                'features' => ['Hair damage assessment', 'Intensive repair treatment', 'Protein therapy', 'Moisture restoration'],
                'is_active' => true,
            ],
            
            // Package Services
            [
                'name' => 'Paket Lengkap Premium',
                'description' => 'Paket lengkap dengan semua layanan premium untuk pengalaman barbershop terbaik',
                'price' => 200000,
                'duration' => 120,
                'type' => 'paket',
                'image' => 'services/complete-package.jpg',
                'features' => ['Haircut premium', 'Hair treatment', 'Styling', 'Beard grooming', 'Scalp massage'],
                'is_active' => true,
            ],
            [
                'name' => 'Keramas + Creambath',
                'description' => 'Perawatan rambut relaksasi dengan shampo premium dan creambath treatment',
                'price' => 45000,
                'duration' => 40,
                'type' => 'populer',
                'image' => 'services/creambath.jpg',
                'features' => ['Premium shampoo', 'Creambath treatment', 'Scalp massage', 'Hair conditioning'],
                'is_active' => true,
            ],
            [
                'name' => 'Cukur Jenggot',
                'description' => 'Perawatan jenggot profesional dengan teknik tradisional untuk tampilan maskulin',
                'price' => 30000,
                'duration' => 25,
                'type' => 'populer',
                'image' => 'services/beard-trim.jpg',
                'features' => ['Beard consultation', 'Precision trimming', 'Beard shaping', 'Aftershave treatment'],
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}