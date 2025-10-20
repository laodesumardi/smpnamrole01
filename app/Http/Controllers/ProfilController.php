<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolProfile;
use App\Models\Accreditation;
use App\Models\Achievement;
use App\Models\User;

class ProfilController extends Controller
{
    public function index()
    {
        // Ambil data dari database
        $sections = SchoolProfile::where('is_active', true)
                                ->orderBy('sort_order')
                                ->get()
                                ->keyBy('section_key');
        
        // Ambil data akreditasi dan prestasi dari database
        $accreditation = Accreditation::active()->first();
        $achievements = Achievement::active()->orderBy('year', 'desc')->get();

        // Ambil guru yang terdaftar dan aktif
        $teachers = User::teachers()->active()->orderBy('name')->get();

        // Ambil record profil lengkap (tanpa section_key) bila ada
        $completeProfile = SchoolProfile::whereNull('section_key')->first();

        // Siapkan nilai akreditasi dengan prioritas dari Accreditation model (admin panel)
        $accreditationStatus = $accreditation->status ?? $completeProfile->accreditation_status ?? 'Terakreditasi A';
        $accreditationNumber = $accreditation->certificate_number ?? $completeProfile->accreditation_number ?? 'SK.001/2023';
        $accreditationYear   = $accreditation->year ?? $completeProfile->accreditation_year ?? '2023';
        $accreditationScore  = $accreditation->score ?? $completeProfile->accreditation_score ?? '95';
        $accreditationValid  = $accreditation->valid_until ?? $completeProfile->accreditation_valid_until ?? '2028-12-31';

        // Bangun konten akreditasi: gunakan description dari Accreditation model, selain itu dari section
        $accreditationContent = $accreditation->description ?? $sections->get('akreditasi')->content ?? (
            'SMP Negeri 01 Namrole telah terakreditasi ' . $accreditationStatus . ' dengan skor ' . $accreditationScore . '. Akreditasi ini menunjukkan kualitas pendidikan yang tinggi dan komitmen sekolah dalam memberikan pelayanan terbaik kepada siswa dan masyarakat.'
        );

        // Data profil sekolah dari database
        $profilData = [
            'hero_title' => $sections->get('hero')->title ?? 'Profil Sekolah',
            'hero_subtitle' => $sections->get('hero')->subtitle ?? $sections->get('hero')->content ?? 'SMP Negeri 01 Namrole - Sekolah Unggul Berkarakter',
            'hero_background' => $sections->get('hero')->image ?? null,
            'sejarah' => [
                'judul' => $sections->get('sejarah')->title ?? 'Sejarah Singkat SMP Negeri 01 Namrole',
                'konten' => $sections->get('sejarah')->content ?? 'SMP Negeri 01 Namrole didirikan pada tahun 1985 sebagai salah satu sekolah menengah pertama negeri di Kabupaten Maluku Tengah. Sekolah ini dibangun dengan tujuan untuk memberikan akses pendidikan yang berkualitas kepada masyarakat di...',
                'tahun_berdiri' => '1985',
            ],
            // Tambahkan struktur_organisasi agar sesuai dengan view
            'struktur_organisasi' => [
                'judul' => $sections->get('struktur')->title ?? 'Struktur Organisasi SMP Negeri 01 Namrole',
                'deskripsi' => $sections->get('struktur')->content ?? 'Struktur organisasi sekolah yang menunjukkan hierarki kepemimpinan dan pembagian tugas di SMP Negeri 01 Namrole.',
                'gambar' => $sections->get('struktur')->image ?? null,
            ],
            // Tambahkan visi_misi agar sesuai dengan view
            'visi_misi' => [
                'visi' => $completeProfile->vision ?? ($sections->get('visi-misi')->title ?? 'Menjadi sekolah unggul yang menghasilkan lulusan berkarakter, berprestasi, dan berdaya saing global'),
                'misi' => (function() use ($completeProfile, $sections) {
                    $raw = $completeProfile->mission ?? $sections->get('visi-misi')->content ?? '';
                    $items = preg_split('/\r\n|\r|\n|\.|;|•/', trim($raw));
                    $items = array_filter(array_map('trim', $items), function($v){ return $v !== ''; });
                    if (!empty($items)) return $items;
                    return [
                        'Menyelenggarakan pendidikan berkualitas dengan nilai karakter',
                        'Mengembangkan potensi siswa melalui pembelajaran kreatif dan inovatif',
                        'Membina hubungan harmonis antara sekolah, orang tua, dan masyarakat',
                        'Menyediakan fasilitas pembelajaran yang memadai dan modern',
                        'Membentuk siswa yang peduli sosial dan lingkungan'
                    ];
                })(),
            ],
            'tenaga_pendidik' => [
                'content' => $sections->get('tenaga_pendidik')->content ?? 'SMP Negeri 01 Namrole memiliki tenaga pendidik yang berkualitas dan berpengalaman. Semua guru telah memenuhi kualifikasi akademik dan memiliki sertifikasi pendidik. Mereka berkomitmen untuk memberikan pendidikan terbaik kepada siswa.',
                'guru_mata_pelajaran' => [
                    ['nama' => 'Siti Aminah, S.Pd', 'mata_pelajaran' => 'Matematika', 'pendidikan' => 'S1 Pendidikan Matematika'],
                    ['nama' => 'Budi Santoso, S.Pd', 'mata_pelajaran' => 'Bahasa Indonesia', 'pendidikan' => 'S1 Pendidikan Bahasa Indonesia'],
                    ['nama' => 'Rahmawati, S.Pd', 'mata_pelajaran' => 'IPA', 'pendidikan' => 'S1 Pendidikan Fisika'],
                ],
                'tenaga_kependidikan' => [
                    ['nama' => 'Sari Indah, S.Pd', 'jabatan' => 'Tata Usaha', 'pendidikan' => 'S1 Administrasi Pendidikan'],
                    ['nama' => 'Bambang Sutrisno', 'jabatan' => 'Petugas Kebersihan', 'pendidikan' => 'SMA'],
                    ['nama' => 'Dewi Kartika, S.Pd', 'jabatan' => 'Pustakawan', 'pendidikan' => 'S1 Ilmu Perpustakaan'],
                    ['nama' => 'Ahmad Rifai', 'jabatan' => 'Satpam', 'pendidikan' => 'SMA']
                ]
            ],
            'akreditasi' => [
                'content' => $accreditationContent,
                'status' => $accreditationStatus,
                'nomor_akreditasi' => $accreditationNumber,
                'tahun_akreditasi' => $accreditationYear,
                'skor' => $accreditationScore,
                'masa_berlaku' => $accreditationValid
            ],
            'prestasi' => [
                'akademik' => $achievements->where('type', 'academic')->map(function($achievement) {
                    return [
                        'prestasi' => $achievement->title,
                        'tahun' => $achievement->year,
                        'level' => $achievement->level_label,
                        'position' => $achievement->position,
                        'participant' => $achievement->participant_name
                    ];
                })->toArray(),
                'non_akademik' => $achievements->where('type', 'non_academic')->map(function($achievement) {
                    return [
                        'prestasi' => $achievement->title,
                        'tahun' => $achievement->year,
                        'level' => $achievement->level_label,
                        'position' => $achievement->position,
                        'participant' => $achievement->participant_name
                    ];
                })->toArray()
            ]
        ];

        // Jika ada data guru terdaftar, gunakan untuk menggantikan daftar default
        if ($teachers->isNotEmpty()) {
            $profilData['tenaga_pendidik']['guru_mata_pelajaran'] = $teachers->map(function($t) {
                return [
                    'nama' => $t->name,
                    'mata_pelajaran' => $t->subject ?? '-',
                    'pendidikan' => $t->education ?? '-',
                ];
            })->toArray();
        }

        return view('profil.index', compact('profilData', 'sections'));
    }
}
