@extends('layouts.app')

@php
use Illuminate\Support\Facades\Storage;
@endphp

@section('title', 'Profil Sekolah - SMP Negeri 01 Namrole')

@section('content')
<div class="bg-white">
    {{-- Hero Section --}}
    <section class="relative bg-gray-900 text-white">
        <div
            class="absolute inset-0 bg-cover bg-center"
            style="background-image: url('{{ isset($sections['hero']) && $sections['hero']->image_url ? $sections['hero']->image_url : (isset($profilData['hero_background']) ? Storage::url($profilData['hero_background']) : asset('images/hero-default.jpg')) }}'); {{ isset($sections['hero']) && $sections['hero']->image_position ? 'background-position: ' . $sections['hero']->image_position . ';' : '' }}"
        ></div>
        <div class="relative z-10 bg-black/50 py-24">
            <div class="max-w-6xl mx-auto px-4 text-center">
                <h1 class="text-4xl md:text-5xl font-bold tracking-tight">{{ $profilData['hero_title'] ?? 'Profil Sekolah' }}</h1>
                <p class="mt-4 text-lg md:text-xl text-primary-100">{{ $profilData['hero_subtitle'] ?? 'SMP Negeri 01 Namrole - Sekolah Unggul Berkarakter' }}</p>
            </div>
        </div>
    </section>
    
    {{-- Sejarah Sekolah --}}
    <section class="py-16">
        <div class="max-w-6xl mx-auto px-4">
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ $profilData['sejarah']['judul'] }}</h2>
                <p class="text-gray-700 leading-relaxed">{{ $profilData['sejarah']['konten'] }}</p>
            </div>
        </div>
    </section>
    
    {{-- Struktur Organisasi --}}
    <section class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4">
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">{{ $profilData['struktur_organisasi']['judul'] }}</h2>
                <p class="text-gray-700">{{ $profilData['struktur_organisasi']['deskripsi'] }}</p>
                <div class="mt-6">
                    @php
                        $strukturUrl = isset($sections['struktur']) && $sections['struktur']->image_url
                            ? $sections['struktur']->image_url
                            : (isset($profilData['struktur_organisasi']['gambar']) ? Storage::url($profilData['struktur_organisasi']['gambar']) : null);
                    @endphp
                    @if($strukturUrl)
                        <img src="{{ $strukturUrl }}" alt="Struktur Organisasi" class="mx-auto rounded-lg shadow-lg max-w-full h-auto" style="max-height: 600px; object-fit: contain;">
                    @endif
                </div>
            </div>
        </div>
    </section>
    
    {{-- Visi & Misi --}}
    <section class="py-16">
        <div class="max-w-6xl mx-auto px-4">
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Visi & Misi</h2>
                <div class="mb-6">
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <p class="font-semibold text-green-800 mb-2">Visi</p>
                        <p class="text-gray-800">{{ $profilData['visi_misi']['visi'] }}</p>
                    </div>
                </div>
                <div>
                    <p class="font-semibold text-gray-900 mb-2">Misi</p>
                    <ul class="space-y-2">
                        @foreach($profilData['visi_misi']['misi'] as $misi)
                            <li class="flex items-start">
                                <span class="inline-flex items-center justify-center w-6 h-6 mr-2 rounded-full bg-green-100 text-green-700">✓</span>
                                <span class="text-gray-800">{{ $misi }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
    
    {{-- Tenaga Pendidik --}}
    <section class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4">
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-8">
                <h2 class="text-3xl font-bold text-gray-900">Tenaga Pendidik</h2>
                <p class="mt-3 text-gray-700">{{ $profilData['tenaga_pendidik']['content'] }}</p>
                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($profilData['tenaga_pendidik']['guru_mata_pelajaran'] as $guru)
                        <div class="p-6 bg-white rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition">
                            <div class="flex items-start">
                                <img src="{{ asset('images/default-teacher.png') }}" alt="Guru" class="w-12 h-12 rounded-full mr-4">
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $guru['nama'] }}</p>
                                    <p class="text-gray-700">Mata Pelajaran: {{ $guru['mata_pelajaran'] }}</p>
                                    <p class="text-gray-700">Pendidikan: {{ $guru['pendidikan'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-8">
                    <h3 class="text-2xl font-bold text-gray-900">Tenaga Kependidikan</h3>
                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($profilData['tenaga_pendidik']['tenaga_kependidikan'] as $tk)
                            <div class="p-6 bg-white rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition">
                                <div class="flex items-start">
                                    <img src="{{ asset('images/default-user.png') }}" alt="Tenaga Kependidikan" class="w-12 h-12 rounded-full mr-4">
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $tk['nama'] }}</p>
                                        <p class="text-gray-700">Jabatan: {{ $tk['jabatan'] }}</p>
                                        <p class="text-gray-700">Pendidikan: {{ $tk['pendidikan'] }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    {{-- Akreditasi & Prestasi --}}
    <section class="py-16">
        <div class="max-w-6xl mx-auto px-4">
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-8">
                <h2 class="text-3xl font-bold text-gray-900">Akreditasi & Prestasi</h2>
                <div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                        <h3 class="text-xl font-bold text-blue-900 mb-3">Akreditasi</h3>
                        <p class="text-gray-800">{{ $profilData['akreditasi']['content'] }}</p>
                        <ul class="mt-4 space-y-2 text-gray-800">
                            <li><span class="font-semibold">Status:</span> {{ $profilData['akreditasi']['status'] }}</li>
                            <li><span class="font-semibold">Nomor Sertifikat:</span> {{ $profilData['akreditasi']['nomor_akreditasi'] }}</li>
                            <li><span class="font-semibold">Tahun:</span> {{ $profilData['akreditasi']['tahun_akreditasi'] }}</li>
                            <li><span class="font-semibold">Skor:</span> {{ $profilData['akreditasi']['skor'] }}</li>
                            <li><span class="font-semibold">Berlaku Hingga:</span> {{ $profilData['akreditasi']['masa_berlaku'] }}</li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Prestasi</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                            <div class="bg-white rounded-lg border border-gray-200 p-4">
                                <h4 class="font-semibold text-gray-900 mb-2">Akademik</h4>
                                <ul class="space-y-2 text-gray-800">
                                    @foreach($profilData['prestasi']['akademik'] as $p)
                                        <li>{{ $p['prestasi'] }} ({{ $p['tahun'] }}) - {{ $p['level'] }} - {{ $p['position'] }} - {{ $p['participant'] }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="bg-white rounded-lg border border-gray-200 p-4">
                                <h4 class="font-semibold text-gray-900 mb-2">Non Akademik</h4>
                                <ul class="space-y-2 text-gray-800">
                                    @foreach($profilData['prestasi']['non_akademik'] as $p)
                                        <li>{{ $p['prestasi'] }} ({{ $p['tahun'] }}) - {{ $p['level'] }} - {{ $p['position'] }} - {{ $p['participant'] }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- JavaScript for Tab Navigation -->
<script>
function showSection(sectionId) {
    // Hide all content sections
    const sections = document.querySelectorAll('.content-section');
    sections.forEach(section => {
        section.classList.add('hidden');
    });

    // Remove active class from all tabs
    const tabs = document.querySelectorAll('.tab-button');
    tabs.forEach(tab => {
        tab.classList.remove('active', 'border-primary-500', 'text-primary-600');
        tab.classList.add('border-transparent', 'text-gray-500');
    });

    // Show selected section
    document.getElementById(sectionId).classList.remove('hidden');

    // Add active class to clicked tab
    event.target.classList.add('active', 'border-primary-500', 'text-primary-600');
    event.target.classList.remove('border-transparent', 'text-gray-500');
}
</script>
@endsection
