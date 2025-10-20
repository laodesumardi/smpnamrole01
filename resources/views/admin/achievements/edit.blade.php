@extends('layouts.admin')

@section('title', 'Edit Prestasi')

@section('content')
<div class="bg-white">
    <!-- Header -->
    <div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white px-6 py-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold">Edit Prestasi</h1>
                    <p class="text-primary-100 mt-2">Edit prestasi: {{ $achievement->title }}</p>
                </div>
                <a href="{{ route('admin.achievements.index') }}" class="bg-white text-primary-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-50 transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-4xl mx-auto px-6 py-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Form Edit Prestasi</h3>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.achievements.update', $achievement) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                                Tipe Prestasi <span class="text-red-500">*</span>
                            </label>
                            <select name="type" id="type" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('type') border-red-500 @enderror" required>
                                <option value="">Pilih Tipe</option>
                                <option value="academic" {{ old('type', $achievement->type) == 'academic' ? 'selected' : '' }}>Akademik</option>
                                <option value="non_academic" {{ old('type', $achievement->type) == 'non_academic' ? 'selected' : '' }}>Non-Akademik</option>
                            </select>
                            @error('type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="level" class="block text-sm font-medium text-gray-700 mb-2">
                                Level <span class="text-red-500">*</span>
                            </label>
                            <select name="level" id="level" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('level') border-red-500 @enderror" required>
                                <option value="">Pilih Level</option>
                                <option value="kabupaten" {{ old('level', $achievement->level) == 'kabupaten' ? 'selected' : '' }}>Kabupaten</option>
                                <option value="provinsi" {{ old('level', $achievement->level) == 'provinsi' ? 'selected' : '' }}>Provinsi</option>
                                <option value="nasional" {{ old('level', $achievement->level) == 'nasional' ? 'selected' : '' }}>Nasional</option>
                                <option value="internasional" {{ old('level', $achievement->level) == 'internasional' ? 'selected' : '' }}>Internasional</option>
                            </select>
                            @error('level')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Judul Prestasi <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title" id="title" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('title') border-red-500 @enderror" value="{{ old('title', $achievement->title) }}" required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea name="description" id="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('description') border-red-500 @enderror">{{ old('description', $achievement->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="year" class="block text-sm font-medium text-gray-700 mb-2">
                                Tahun <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="year" id="year" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('year') border-red-500 @enderror" value="{{ old('year', $achievement->year) }}" min="2000" max="2030" required>
                            @error('year')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="position" class="block text-sm font-medium text-gray-700 mb-2">Posisi/Juara</label>
                            <input type="text" name="position" id="position" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('position') border-red-500 @enderror" value="{{ old('position', $achievement->position) }}" placeholder="Contoh: Juara 1, Juara 2, dll">
                            @error('position')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="participant_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Peserta/Kelompok</label>
                            <input type="text" name="participant_name" id="participant_name" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('participant_name') border-red-500 @enderror" value="{{ old('participant_name', $achievement->participant_name) }}">
                            @error('participant_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
                        <textarea name="notes" id="notes" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('notes') border-red-500 @enderror">{{ old('notes', $achievement->notes) }}</textarea>
                        @error('notes')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image Upload Section -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">Foto Prestasi</label>
                            <input type="file" name="photo" id="photo" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('photo') border-red-500 @enderror" accept="image/*">
                            @error('photo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG, GIF. Maksimal 2MB</p>
                            @if($achievement->photo)
                                <div class="mt-3">
                                    <p class="text-sm font-medium text-gray-700 mb-2">Foto saat ini:</p>
                                    <div class="relative inline-block">
                                        <img src="{{ Storage::url($achievement->photo) }}" alt="Current Photo" class="w-32 h-24 object-cover rounded-lg border border-gray-200" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                        <div class="w-32 h-24 bg-gray-100 rounded-lg border border-gray-200 flex items-center justify-center" style="display: none;">
                                            <div class="text-center">
                                                <svg class="w-8 h-8 text-gray-400 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                <p class="text-xs text-gray-500">Gambar tidak ditemukan</p>
                                            </div>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1">{{ basename($achievement->photo) }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div>
                            <label for="certificate_image" class="block text-sm font-medium text-gray-700 mb-2">Foto Sertifikat</label>
                            <input type="file" name="certificate_image" id="certificate_image" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('certificate_image') border-red-500 @enderror" accept="image/*">
                            @error('certificate_image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG, GIF. Maksimal 2MB</p>
                            @if($achievement->certificate_image)
                                <div class="mt-3">
                                    <p class="text-sm font-medium text-gray-700 mb-2">Sertifikat saat ini:</p>
                                    <div class="relative inline-block">
                                        <img src="{{ Storage::url($achievement->certificate_image) }}" alt="Current Certificate" class="w-32 h-24 object-cover rounded-lg border border-gray-200" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                        <div class="w-32 h-24 bg-gray-100 rounded-lg border border-gray-200 flex items-center justify-center" style="display: none;">
                                            <div class="text-center">
                                                <svg class="w-8 h-8 text-gray-400 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                <p class="text-xs text-gray-500">Gambar tidak ditemukan</p>
                                            </div>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1">{{ basename($achievement->certificate_image) }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center space-x-6">
                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded" value="1" {{ old('is_active', $achievement->is_active) ? 'checked' : '' }}>
                            <label for="is_active" class="ml-2 block text-sm text-gray-900">Aktif</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="is_featured" id="is_featured" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded" value="1" {{ old('is_featured', $achievement->is_featured) ? 'checked' : '' }}>
                            <label for="is_featured" class="ml-2 block text-sm text-gray-900">Featured (Tampilkan di halaman utama)</label>
                        </div>
                    </div>

                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.achievements.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Update
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection