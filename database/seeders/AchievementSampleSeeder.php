<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Achievement;

class AchievementSampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $achievements = [
            [
                'type' => 'academic',
                'title' => 'Juara 1 Olimpiade Matematika Tingkat Kabupaten',
                'description' => 'Siswa berhasil meraih juara 1 dalam olimpiade matematika tingkat kabupaten dengan skor tertinggi.',
                'level' => 'kabupaten',
                'year' => 2024,
                'position' => 'Juara 1',
                'participant_name' => 'Ahmad Rizki',
                'is_active' => true,
                'is_featured' => true,
                'photo' => 'uploads/achievements/sample-achievement-1.jpg',
                'certificate_image' => 'uploads/achievements/sample-certificate-1.jpg'
            ],
            [
                'type' => 'non_academic',
                'title' => 'Juara 2 Lomba Pidato Bahasa Indonesia',
                'description' => 'Prestasi membanggakan dalam lomba pidato bahasa Indonesia tingkat provinsi.',
                'level' => 'provinsi',
                'year' => 2024,
                'position' => 'Juara 2',
                'participant_name' => 'Siti Nurhaliza',
                'is_active' => true,
                'is_featured' => true,
                'photo' => 'uploads/achievements/sample-achievement-2.jpg',
                'certificate_image' => 'uploads/achievements/sample-certificate-2.jpg'
            ],
            [
                'type' => 'academic',
                'title' => 'Juara 3 Olimpiade IPA Nasional',
                'description' => 'Siswa berhasil meraih juara 3 dalam olimpiade IPA tingkat nasional.',
                'level' => 'nasional',
                'year' => 2023,
                'position' => 'Juara 3',
                'participant_name' => 'Muhammad Fajar',
                'is_active' => true,
                'is_featured' => false,
                'photo' => 'uploads/achievements/sample-achievement-3.jpg',
                'certificate_image' => 'uploads/achievements/sample-certificate-3.jpg'
            ],
            [
                'type' => 'non_academic',
                'title' => 'Juara 1 Lomba Tari Tradisional',
                'description' => 'Prestasi dalam lomba tari tradisional tingkat kabupaten.',
                'level' => 'kabupaten',
                'year' => 2024,
                'position' => 'Juara 1',
                'participant_name' => 'Putri Sari',
                'is_active' => true,
                'is_featured' => false,
                'photo' => 'uploads/achievements/sample-achievement-4.jpg',
                'certificate_image' => 'uploads/achievements/sample-certificate-4.jpg'
            ],
            [
                'type' => 'academic',
                'title' => 'Juara 2 Olimpiade Bahasa Inggris',
                'description' => 'Prestasi dalam olimpiade bahasa Inggris tingkat provinsi.',
                'level' => 'provinsi',
                'year' => 2023,
                'position' => 'Juara 2',
                'participant_name' => 'Rizki Pratama',
                'is_active' => true,
                'is_featured' => true,
                'photo' => 'uploads/achievements/sample-achievement-5.jpg',
                'certificate_image' => 'uploads/achievements/sample-certificate-5.jpg'
            ]
        ];

        foreach ($achievements as $achievement) {
            Achievement::create($achievement);
        }
    }
}