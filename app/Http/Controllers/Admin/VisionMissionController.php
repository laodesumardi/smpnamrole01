<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolProfile;
use Illuminate\Http\Request;

class VisionMissionController extends Controller
{
    /**
     * Display the vision and mission edit form
     */
    public function index()
    {
        return $this->edit();
    }

    /**
     * Display the vision and mission edit form
     */
    public function edit()
    {
        // Get the complete school profile (without section_key)
        $profile = SchoolProfile::whereNull('section_key')->first();
        
        if (!$profile) {
            // Create a new profile if it doesn't exist
            $profile = SchoolProfile::create([
                'school_name' => 'SMP Negeri 01 Namrole',
                'vision' => 'Menjadi sekolah unggul yang menghasilkan lulusan berkarakter, berprestasi, dan berdaya saing global',
                'mission' => 'Menyelenggarakan pendidikan berkualitas dengan nilai karakter\nMengembangkan potensi siswa melalui pembelajaran kreatif dan inovatif\nMembina hubungan harmonis antara sekolah, orang tua, dan masyarakat\nMenyediakan fasilitas pembelajaran yang memadai dan modern\nMembentuk siswa yang peduli sosial dan lingkungan',
                'is_active' => true
            ]);
        }
        
        return view('admin.vision-mission.edit', compact('profile'));
    }

    /**
     * Update the vision and mission
     */
    public function update(Request $request)
    {
        $request->validate([
            'vision' => 'required|string|max:1000',
            'mission' => 'required|string|max:2000',
        ], [
            'vision.required' => 'Visi harus diisi',
            'vision.max' => 'Visi maksimal 1000 karakter',
            'mission.required' => 'Misi harus diisi',
            'mission.max' => 'Misi maksimal 2000 karakter',
        ]);

        // Get the complete school profile
        $profile = SchoolProfile::whereNull('section_key')->first();
        
        if (!$profile) {
            return redirect()->back()->withErrors(['error' => 'Profil sekolah tidak ditemukan.']);
        }

        // Clean up mission data by removing numbered prefixes
        $cleanMission = preg_replace('/^\d+\.\s*/m', '', $request->mission);
        
        // Update vision and mission
        $profile->update([
            'vision' => $request->vision,
            'mission' => $cleanMission,
        ]);

        return redirect()->route('admin.vision-mission.edit')
            ->with('success', 'Visi & Misi berhasil diperbarui!');
    }
}