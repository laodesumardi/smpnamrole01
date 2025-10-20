@extends('layouts.admin')

@section('title', 'Tambah Sosial Media')
@section('page-title', 'Tambah Sosial Media')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <div>
                <h3 class="text-lg font-medium text-gray-900">Tambah Sosial Media</h3>
                <p class="text-sm text-gray-500">Tambahkan sosial media baru untuk website</p>
            </div>
            <a href="{{ route('admin.social-media.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg flex items-center transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
        </div>
        
        <form action="{{ route('admin.social-media.store') }}" method="POST" class="p-6 space-y-6">
            @csrf
            
            <!-- Nama Sosial Media -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Sosial Media *</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 @error('name') border-red-500 @enderror" 
                       placeholder="Contoh: Facebook, Instagram, Twitter" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- URL -->
            <div>
                <label for="url" class="block text-sm font-medium text-gray-700 mb-2">URL *</label>
                <input type="url" name="url" id="url" value="{{ old('url') }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 @error('url') border-red-500 @enderror" 
                       placeholder="https://facebook.com/smpnamrole01" required>
                @error('url')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Icon -->
            <div>
                <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">Icon</label>
                <input type="text" name="icon" id="icon" value="{{ old('icon') }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 @error('icon') border-red-500 @enderror" 
                       placeholder="facebook, instagram, youtube, twitter, tiktok, whatsapp, linkedin">
                <p class="text-sm text-gray-500 mt-1">Kosongkan untuk menggunakan nama sebagai icon (otomatis)</p>
                @error('icon')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Warna -->
            <div>
                <label for="color" class="block text-sm font-medium text-gray-700 mb-2">Warna *</label>
                <div class="flex items-center space-x-4">
                    <input type="color" name="color" id="color" value="{{ old('color', '#3B82F6') }}" 
                           class="w-16 h-10 border border-gray-300 rounded-lg cursor-pointer @error('color') border-red-500 @enderror" required>
                    <input type="text" name="color_text" id="color_text" value="{{ old('color', '#3B82F6') }}" 
                           class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 @error('color') border-red-500 @enderror" 
                           placeholder="#3B82F6" required>
                </div>
                @error('color')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Urutan -->
            <div>
                <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Urutan *</label>
                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 @error('sort_order') border-red-500 @enderror" 
                       min="0" required>
                <p class="text-sm text-gray-500 mt-1">Angka yang lebih kecil akan ditampilkan lebih dulu</p>
                @error('sort_order')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status Aktif -->
            <div>
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} 
                           class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                    <span class="ml-2 text-sm text-gray-700">Aktif</span>
                </label>
                <p class="text-sm text-gray-500 mt-1">Sosial media yang tidak aktif tidak akan ditampilkan di website</p>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.social-media.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors">
                    Simpan Sosial Media
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const colorInput = document.getElementById('color');
    const colorTextInput = document.getElementById('color_text');
    
    // Sync color picker with text input
    colorInput.addEventListener('input', function() {
        colorTextInput.value = this.value;
    });
    
    // Sync text input with color picker
    colorTextInput.addEventListener('input', function() {
        if (this.value.match(/^#[0-9A-F]{6}$/i)) {
            colorInput.value = this.value;
        }
    });
});
</script>
@endsection
