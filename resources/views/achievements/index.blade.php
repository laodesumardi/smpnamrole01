@extends('layouts.app')

@section('title', 'Prestasi Siswa - SMP Negeri 01 Namrole')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Hero Section -->
    <div class="bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="max-w-3xl mx-auto">
                <h1 class="text-5xl font-bold mb-6">Prestasi Siswa</h1>
                <p class="text-xl text-primary-100 mb-8">Pencapaian membanggakan dari siswa-siswi SMP Negeri 01 Namrole yang mengharumkan nama sekolah</p>
                <div class="flex items-center justify-center space-x-8 text-primary-100">
                    <div class="text-center">
                        <div class="text-3xl font-bold">{{ $achievements->total() }}</div>
                        <div class="text-sm">Total Prestasi</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold">{{ $achievements->where('is_featured', true)->count() }}</div>
                        <div class="text-sm">Prestasi Unggulan</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Filter Prestasi</h2>
                <p class="text-gray-600">Temukan prestasi yang Anda cari dengan mudah</p>
            </div>
            <form method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                <!-- Search -->
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Cari Prestasi
                    </label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors" 
                           placeholder="Cari prestasi...">
                </div>

                <!-- Type Filter -->
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        Jenis
                    </label>
                    <select name="type" id="type" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
                        <option value="">Semua Jenis</option>
                        @foreach($types as $type)
                            <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                                {{ $type == 'academic' ? 'Akademik' : 'Non-Akademik' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Level Filter -->
                <div>
                    <label for="level" class="block text-sm font-medium text-gray-700 mb-2">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Tingkat
                    </label>
                    <select name="level" id="level" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
                        <option value="">Semua Tingkat</option>
                        @foreach($levels as $level)
                            <option value="{{ $level }}" {{ request('level') == $level ? 'selected' : '' }}>
                                {{ ucfirst($level) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Year Filter -->
                <div>
                    <label for="year" class="block text-sm font-medium text-gray-700 mb-2">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Tahun
                    </label>
                    <select name="year" id="year" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
                        <option value="">Semua Tahun</option>
                        @foreach($years as $year)
                            <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Button -->
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-primary-600 text-white px-6 py-3 rounded-lg hover:bg-primary-700 transition-colors font-semibold flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.414A1 1 0 013 6.707V4z"></path>
                        </svg>
                        Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Achievements Grid -->
    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($achievements->count() > 0)
                <!-- Results Header -->
                <div class="mb-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900">Daftar Prestasi</h2>
                            <p class="text-gray-600 mt-2">Menampilkan {{ $achievements->count() }} dari {{ $achievements->total() }} prestasi</p>
                        </div>
                        @if(request()->hasAny(['search', 'type', 'level', 'year']))
                        <a href="{{ route('achievements.index') }}" class="text-primary-600 hover:text-primary-700 font-medium flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Reset Filter
                        </a>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($achievements as $achievement)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 group">
                        <!-- Achievement Image -->
                        @if($achievement->photo || $achievement->certificate_image)
                        <div class="h-56 bg-gray-200 relative overflow-hidden">
                            @if($achievement->photo)
                                <img src="{{ Storage::url($achievement->photo) }}" alt="{{ $achievement->title }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @elseif($achievement->certificate_image)
                                <img src="{{ Storage::url($achievement->certificate_image) }}" alt="{{ $achievement->title }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @endif
                            <!-- Overlay with achievement info -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-4 left-4 right-4">
                                <div class="flex items-center justify-between">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold {{ $achievement->type == 'academic' ? 'bg-blue-500 text-white' : 'bg-green-500 text-white' }}">
                                        {{ $achievement->type_label }}
                                    </span>
                                    <span class="text-white text-sm font-medium bg-black/30 px-2 py-1 rounded">{{ $achievement->year }}</span>
                                </div>
                                @if($achievement->is_featured)
                                <div class="mt-2">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold bg-yellow-400 text-yellow-900">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                        Unggulan
                                    </span>
                                </div>
                                @endif
                            </div>
                        </div>
                        @else
                        <!-- Default image if no photo -->
                        <div class="h-56 bg-gradient-to-br from-primary-500 via-primary-600 to-primary-700 flex items-center justify-center relative overflow-hidden">
                            <div class="absolute inset-0 bg-black/20"></div>
                            <div class="text-center text-white relative z-10">
                                <svg class="w-16 h-16 mx-auto mb-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <p class="text-lg font-semibold">Prestasi Siswa</p>
                                <p class="text-sm opacity-90">{{ $achievement->year }}</p>
                            </div>
                        </div>
                        @endif
                        
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                @if(!$achievement->photo && !$achievement->certificate_image)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold {{ $achievement->type == 'academic' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $achievement->type_label }}
                                </span>
                                <span class="text-sm text-gray-500 font-medium">{{ $achievement->year }}</span>
                                @endif
                            </div>
                            
                            <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">{{ $achievement->title }}</h3>
                        
                            @if($achievement->description)
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3 leading-relaxed">{{ $achievement->description }}</p>
                            @endif
                            
                            <div class="space-y-3">
                                @if($achievement->position)
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $achievement->position }}</p>
                                        <p class="text-xs text-gray-500">Posisi/Juara</p>
                                    </div>
                                </div>
                                @endif
                                
                                @if($achievement->participant_name)
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $achievement->participant_name }}</p>
                                        <p class="text-xs text-gray-500">Peserta</p>
                                    </div>
                                </div>
                                @endif
                                
                                @if($achievement->level_label)
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $achievement->level_label }}</p>
                                        <p class="text-xs text-gray-500">Tingkat</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-16 flex justify-center">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                        {{ $achievements->links() }}
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-20">
                    <div class="max-w-md mx-auto">
                        <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Tidak ada prestasi ditemukan</h3>
                        <p class="text-gray-600 mb-8">Coba ubah filter pencarian Anda atau periksa kembali kata kunci yang digunakan.</p>
                        @if(request()->hasAny(['search', 'type', 'level', 'year']))
                        <a href="{{ route('achievements.index') }}" class="inline-flex items-center px-6 py-3 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors font-semibold">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Reset Filter
                        </a>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection
