<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barber;

class BarberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barbers = [
            // Master Level Barbers
            [
                'name' => 'Budi Santoso',
                'level' => 'master',
                'experience' => '15 Tahun',
                'specialty' => 'All Styles & Hair Art',
                'bio' => 'Maestro dalam semua teknik potong rambut dengan keahlian yang tak tertandingi. Pengalaman lebih dari satu dekade dalam industri barbershop dengan sertifikasi internasional.',
                'photo' => 'barbers/budi-santoso.jpg',
                'skills' => ['All Styles', 'Hair Art', 'Premium Cut', 'Color Expert', 'Perm Specialist'],
                'rating' => 5.0,
                'is_active' => true,
            ],
            [
                'name' => 'Rizky Mahendra',
                'level' => 'master',
                'experience' => '12 Tahun',
                'specialty' => 'Hair Treatment & Coloring Master',
                'bio' => 'Master dalam perawatan rambut dan pewarnaan dengan teknik advanced. Ahli dalam smoothing, perm, dan semua jenis hair treatment.',
                'photo' => 'barbers/rizky-mahendra.jpg',
                'skills' => ['Smoothing Expert', 'Coloring Master', 'Perm Specialist', 'Hair Repair', 'Chemical Treatment'],
                'rating' => 4.95,
                'is_active' => true,
            ],

            // Senior Level Barbers
            [
                'name' => 'Ahmad Rizki',
                'level' => 'senior',
                'experience' => '9 Tahun',
                'specialty' => 'Modern & Classic Cut',
                'bio' => 'Spesialis gaya rambut modern dan klasik dengan sentuhan artistik yang memukau. Berpengalaman dalam berbagai teknik potong rambut profesional.',
                'photo' => 'barbers/ahmad-rizki.jpg',
                'skills' => ['Fade Cut', 'Pompadour', 'Beard Styling', 'Classic Cut', 'Modern Styling'],
                'rating' => 4.9,
                'is_active' => true,
            ],
            [
                'name' => 'Fajar Ramadhan',
                'level' => 'senior',
                'experience' => '8 Tahun',
                'specialty' => 'Beard Expert & Traditional Cut',
                'bio' => 'Ahli dalam perawatan jenggot dan gaya rambut klasik dengan teknik tradisional terbaik yang telah teruji waktu.',
                'photo' => 'barbers/fajar-ramadhan.jpg',
                'skills' => ['Beard Expert', 'Traditional Cut', 'Mustache Styling', 'Wet Shave', 'Classic Pomade'],
                'rating' => 4.88,
                'is_active' => true,
            ],
            [
                'name' => 'Indra Wijaya',
                'level' => 'senior',
                'experience' => '7 Tahun',
                'specialty' => 'Cornrow & Braiding Expert',
                'bio' => 'Spesialis dalam teknik cornrow dan berbagai jenis kepangan rambut dengan pola artistik yang unik dan kreatif.',
                'photo' => 'barbers/indra-wijaya.jpg',
                'skills' => ['Cornrow Expert', 'Braiding Specialist', 'Pattern Design', 'Afro Styling', 'Dreadlock'],
                'rating' => 4.85,
                'is_active' => true,
            ],

            // Professional Level Barbers
            [
                'name' => 'Dedi Kurniawan',
                'level' => 'professional',
                'experience' => '6 Tahun',
                'specialty' => 'Trendy Cut & Hair Treatment',
                'bio' => 'Spesialis gaya rambut trendy dan treatment rambut premium untuk penampilan maksimal yang memukau dan up-to-date.',
                'photo' => 'barbers/dedi-kurniawan.jpg',
                'skills' => ['Trendy Cut', 'Hair Treatment', 'Styling', 'Highlight', 'Scalp Care'],
                'rating' => 4.8,
                'is_active' => true,
            ],
            [
                'name' => 'Hendra Saputra',
                'level' => 'professional',
                'experience' => '5 Tahun',
                'specialty' => 'Hair Repair & Damage Treatment',
                'bio' => 'Ahli dalam perawatan rambut rusak dan berbagai masalah rambut dengan treatment intensif yang efektif.',
                'photo' => 'barbers/hendra-saputra.jpg',
                'skills' => ['Hair Repair', 'Damage Treatment', 'Protein Therapy', 'Moisture Treatment', 'Scalp Therapy'],
                'rating' => 4.75,
                'is_active' => true,
            ],
            [
                'name' => 'Joko Susanto',
                'level' => 'professional',
                'experience' => '6 Tahun',
                'specialty' => 'Dandruff Treatment & Scalp Care',
                'bio' => 'Spesialis dalam mengatasi masalah ketombe dan perawatan kulit kepala dengan metode yang terbukti efektif.',
                'photo' => 'barbers/joko-susanto.jpg',
                'skills' => ['Dandruff Treatment', 'Scalp Analysis', 'Deep Cleansing', 'Scalp Massage', 'Hair Health'],
                'rating' => 4.78,
                'is_active' => true,
            ],

            // Specialist Level Barbers
            [
                'name' => 'Gilang Pratama',
                'level' => 'specialist',
                'experience' => '5 Tahun',
                'specialty' => 'Creative Cut & Hair Art',
                'bio' => 'Kreatif dalam menciptakan gaya rambut unik dan artistik yang memukau setiap mata yang melihatnya dengan sentuhan seni.',
                'photo' => 'barbers/gilang-pratama.jpg',
                'skills' => ['Creative Cut', 'Hair Art', 'Unique Style', 'Color Design', 'Artistic Styling'],
                'rating' => 4.7,
                'is_active' => true,
            ],
            [
                'name' => 'Kevin Hartanto',
                'level' => 'specialist',
                'experience' => '4 Tahun',
                'specialty' => 'Youth Style & Modern Trends',
                'bio' => 'Spesialis gaya rambut anak muda dan trend terkini dengan pemahaman mendalam tentang fashion rambut masa kini.',
                'photo' => 'barbers/kevin-hartanto.jpg',
                'skills' => ['Youth Style', 'Modern Trends', 'Social Media Style', 'K-Pop Style', 'Undercut'],
                'rating' => 4.65,
                'is_active' => true,
            ],

            // Creative Level Barbers
            [
                'name' => 'Luki Hermawan',
                'level' => 'creative',
                'experience' => '4 Tahun',
                'specialty' => 'Experimental Styles & Color Art',
                'bio' => 'Seniman rambut yang suka bereksperimen dengan gaya dan warna unik untuk menciptakan look yang out-of-the-box.',
                'photo' => 'barbers/luki-hermawan.jpg',
                'skills' => ['Experimental Style', 'Color Art', 'Fantasy Color', 'Avant-garde', 'Creative Design'],
                'rating' => 4.6,
                'is_active' => true,
            ],
            [
                'name' => 'Mario Fernandez',
                'level' => 'creative',
                'experience' => '3 Tahun',
                'specialty' => 'Artistic Braiding & Pattern Design',
                'bio' => 'Kreatif dalam menciptakan pola kepangan dan desain rambut artistik yang memadukan seni tradisional dan modern.',
                'photo' => 'barbers/mario-fernandez.jpg',
                'skills' => ['Artistic Braiding', 'Pattern Design', 'Cultural Styles', 'Geometric Cuts', 'Texture Art'],
                'rating' => 4.58,
                'is_active' => true,
            ],

            // Junior Level Barbers
            [
                'name' => 'Eko Prasetyo',
                'level' => 'junior',
                'experience' => '3 Tahun',
                'specialty' => 'Basic Cut & Quick Service',
                'bio' => 'Kapster muda dengan teknik dasar yang solid dan pelayanan cepat untuk kebutuhan potong rambut sehari-hari.',
                'photo' => 'barbers/eko-prasetyo.jpg',
                'skills' => ['Basic Cut', 'Quick Service', 'Student Friendly', 'Simple Styling', 'Affordable Care'],
                'rating' => 4.5,
                'is_active' => true,
            ],
            [
                'name' => 'Nanda Pratama',
                'level' => 'junior',
                'experience' => '2 Tahun',
                'specialty' => 'Kids Cut & Family Service',
                'bio' => 'Spesialis potong rambut anak-anak dengan pendekatan yang sabar dan ramah untuk kenyamanan keluarga.',
                'photo' => 'barbers/nanda-pratama.jpg',
                'skills' => ['Kids Cut', 'Family Service', 'Patient Approach', 'Fun Atmosphere', 'Child Friendly'],
                'rating' => 4.45,
                'is_active' => true,
            ],
            [
                'name' => 'Oki Setiawan',
                'level' => 'junior',
                'experience' => '2 Tahun',
                'specialty' => 'Basic Treatment & Wash Service',
                'bio' => 'Fokus pada layanan dasar seperti keramas, creambath, dan perawatan rambut sederhana dengan kualitas terjamin.',
                'photo' => 'barbers/oki-setiawan.jpg',
                'skills' => ['Basic Treatment', 'Hair Wash', 'Creambath', 'Simple Care', 'Relaxing Service'],
                'rating' => 4.4,
                'is_active' => true,
            ],
        ];

        foreach ($barbers as $barber) {
            Barber::create($barber);
        }
    }
}