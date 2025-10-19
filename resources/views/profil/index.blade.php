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
            <div class="container mx-auto px-4 text-center">
                <h1 class="text-4xl font-bold">{{ $profilData['hero_title'] ?? 'Profil Sekolah' }}</h1>
                <p class="mt-4 text-lg">{{ $profilData['hero_subtitle'] ?? 'SMP Negeri 01 Namrole - Sekolah Unggul Berkarakter' }}</p>
            </div>
        </div>
    </section>
    
    {{-- Sejarah Sekolah --}}
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-semibold">{{ $profilData['sejarah']['judul'] }}</h2>
            <p class="mt-4">{{ $profilData['sejarah']['konten'] }}</p>
        </div>
    </section>
    
    {{-- Struktur Organisasi --}}
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-semibold">{{ $profilData['struktur_organisasi']['judul'] }}</h2>
            <p class="mt-4">{{ $profilData['struktur_organisasi']['deskripsi'] }}</p>
            <div class="mt-6">
                @php
                    $strukturUrl = isset($sections['struktur']) && $sections['struktur']->image_url
                        ? $sections['struktur']->image_url
                        : null;
                @endphp
                @if($strukturUrl)
                    <img src="{{ $strukturUrl }}" alt="Struktur Organisasi" class="w-full rounded shadow" onerror="this.src='{{ asset('images/default-school-profile.png') }}'" />
                @else
                    <img src="{{ asset('images/default-school-profile.png') }}" alt="Struktur Organisasi" class="w-full rounded shadow" />
                @endif
            </div>
        </div>
    </section>
    
    {{-- Visi & Misi --}}
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-semibold">Visi & Misi</h2>
            <div class="mt-4">
                <p class="font-semibold">Visi:</p>
                <p>{{ $profilData['visi_misi']['visi'] }}</p>
            </div>
            <div class="mt-4">
                <p class="font-semibold">Misi:</p>
                <ul class="list-disc pl-5">
                    @foreach($profilData['visi_misi']['misi'] as $misi)
                        <li>{{ $misi }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
    
    {{-- Tenaga Pendidik --}}
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-semibold">Tenaga Pendidik</h2>
            <p class="mt-4">{{ $profilData['tenaga_pendidik']['content'] }}</p>
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($profilData['tenaga_pendidik']['guru_mata_pelajaran'] as $guru)
                    <div class="p-4 bg-white rounded shadow">
                        <p class="font-semibold">{{ $guru['nama'] }}</p>
                        <p>Mata Pelajaran: {{ $guru['mata_pelajaran'] }}</p>
                        <p>Pendidikan: {{ $guru['pendidikan'] }}</p>
                    </div>
                @endforeach
            </div>
            <div class="mt-6">
                <h3 class="text-xl font-semibold">Tenaga Kependidikan</h3>
                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($profilData['tenaga_pendidik']['tenaga_kependidikan'] as $tk)
                        <div class="p-4 bg-white rounded shadow">
                            <p class="font-semibold">{{ $tk['nama'] }}</p>
                            <p>Jabatan: {{ $tk['jabatan'] }}</p>
                            <p>Pendidikan: {{ $tk['pendidikan'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    
    {{-- Akreditasi & Prestasi --}}
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-semibold">Akreditasi & Prestasi</h2>
            <div class="mt-6">
                <h3 class="text-xl font-semibold">Akreditasi</h3>
                <p class="mt-2">{{ $profilData['akreditasi']['content'] }}</p>
                <ul class="mt-2">
                    <li>Status: {{ $profilData['akreditasi']['status'] }}</li>
                    <li>Nomor Sertifikat: {{ $profilData['akreditasi']['nomor_akreditasi'] }}</li>
                    <li>Tahun: {{ $profilData['akreditasi']['tahun_akreditasi'] }}</li>
                    <li>Skor: {{ $profilData['akreditasi']['skor'] }}</li>
                    <li>Berlaku Hingga: {{ $profilData['akreditasi']['masa_berlaku'] }}</li>
                </ul>
            </div>
            <div class="mt-6">
                <h3 class="text-xl font-semibold">Prestasi</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <div>
                        <h4 class="font-semibold">Akademik</h4>
                        <ul class="list-disc pl-5">
                            @foreach($profilData['prestasi']['akademik'] as $p)
                                <li>{{ $p['prestasi'] }} ({{ $p['tahun'] }}) - {{ $p['level'] }} - {{ $p['position'] }} - {{ $p['participant'] }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold">Non Akademik</h4>
                        <ul class="list-disc pl-5">
                            @foreach($profilData['prestasi']['non_akademik'] as $p)
                                <li>{{ $p['prestasi'] }} ({{ $p['tahun'] }}) - {{ $p['level'] }} - {{ $p['position'] }} - {{ $p['participant'] }}</li>
                            @endforeach
                        </ul>
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
