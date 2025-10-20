@extends('layouts.app')

@php
use Illuminate\Support\Facades\Storage;
@endphp

@section('title', 'Profil Sekolah - SMP Negeri 01 Namrole')

@section('content')
<div class="bg-white">
    {{-- Hero Section --}}
    <section class="relative bg-gray-900 text-white py-20">
        @if(isset($profilData['hero_background']) && $profilData['hero_background'])
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ Storage::url($profilData['hero_background']) }}');"></div>
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        @else
            <div class="absolute inset-0 bg-gradient-to-r from-primary-500 to-primary-600"></div>
        @endif
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl font-bold mb-6">{{ $profilData['hero_title'] ?? 'Profil Sekolah' }}</h1>
            <p class="text-xl text-primary-100 mb-8">{{ $profilData['hero_subtitle'] ?? 'SMP Negeri 01 Namrole - Sekolah Unggul Berkarakter' }}</p>
        </div>
    </section>
    
    {{-- Sejarah Sekolah --}}
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ $profilData['sejarah']['judul'] }}</h2>
                <p class="text-gray-700 leading-relaxed text-lg">{{ $profilData['sejarah']['konten'] }}</p>
            </div>
        </div>
    </section>
    
    {{-- Visi & Misi --}}
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">Visi & Misi</h2>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                        <h3 class="text-xl font-bold text-green-800 mb-4">Visi</h3>
                        <p class="text-gray-800 text-lg">{{ $profilData['visi_misi']['visi'] }}</p>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Misi</h3>
                        <ul class="space-y-3">
                            @foreach($profilData['visi_misi']['misi'] as $misi)
                                @php
                                    // Remove any numbered prefixes like "1.", "2.", etc.
                                    $cleanMisi = preg_replace('/^\d+\.\s*/', '', trim($misi));
                                @endphp
                                <li class="flex items-start">
                                    <span class="inline-flex items-center justify-center w-6 h-6 mr-3 rounded-full bg-green-100 text-green-700 text-sm">✓</span>
                                    <span class="text-gray-800">{{ $cleanMisi }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    {{-- Struktur Organisasi --}}
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ $profilData['struktur_organisasi']['judul'] }}</h2>
                <p class="text-gray-700 mb-6">{{ $profilData['struktur_organisasi']['deskripsi'] }}</p>
                @php
                    $strukturUrl = isset($sections['struktur']) && $sections['struktur']->image_url
                        ? $sections['struktur']->image_url
                        : (isset($profilData['struktur_organisasi']['gambar']) ? Storage::url($profilData['struktur_organisasi']['gambar']) : null);
                @endphp
                @if($strukturUrl)
                    <div class="text-center">
                        <img src="{{ $strukturUrl }}" alt="Struktur Organisasi" class="mx-auto rounded-lg shadow-lg max-w-full h-auto" style="max-height: 600px; object-fit: contain;">
                    </div>
                @endif
            </div>
        </div>
    </section>
    
    {{-- Akreditasi --}}
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Akreditasi</h2>
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                    <p class="text-gray-800 text-lg mb-4">{{ $profilData['akreditasi']['content'] }}</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-800">
                        <div><span class="font-semibold">Status:</span> {{ $profilData['akreditasi']['status'] }}</div>
                        <div><span class="font-semibold">Nomor Sertifikat:</span> {{ $profilData['akreditasi']['nomor_akreditasi'] }}</div>
                        <div><span class="font-semibold">Tahun:</span> {{ $profilData['akreditasi']['tahun_akreditasi'] }}</div>
                        <div><span class="font-semibold">Skor:</span> {{ $profilData['akreditasi']['skor'] }}</div>
                        <div><span class="font-semibold">Berlaku Hingga:</span> {{ $profilData['akreditasi']['masa_berlaku'] }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
