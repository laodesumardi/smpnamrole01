@extends('layouts.admin')

@section('title', 'Edit Visi & Misi')
@section('page-title', 'Edit Visi & Misi')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Edit Visi & Misi Sekolah</h3>
            <p class="text-sm text-gray-500">Perbarui visi dan misi sekolah</p>
        </div>
        
        <form action="{{ route('admin.vision-mission.update') }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')
            
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Vision Section -->
            <div>
                <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    Visi
                </h4>
                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                    <label for="vision" class="block text-sm font-medium text-green-800 mb-2">Visi Sekolah *</label>
                    <textarea name="vision" id="vision" rows="3" 
                              class="w-full px-3 py-2 border border-green-300 rounded-lg focus:ring-green-500 focus:border-green-500 @error('vision') border-red-500 @enderror" 
                              placeholder="Masukkan visi sekolah..." required>{{ old('vision', $profile->vision) }}</textarea>
                    @error('vision')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-green-600 mt-2">Visi adalah tujuan jangka panjang yang ingin dicapai oleh sekolah</p>
                </div>
            </div>
            
            <!-- Mission Section -->
            <div>
                <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    Misi
                </h4>
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <label for="mission" class="block text-sm font-medium text-blue-800 mb-2">Misi Sekolah *</label>
                    <textarea name="mission" id="mission" rows="6" 
                              class="w-full px-3 py-2 border border-blue-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('mission') border-red-500 @enderror" 
                              placeholder="Masukkan misi sekolah (pisahkan setiap poin dengan baris baru)..." required>{{ old('mission', $profile->mission) }}</textarea>
                    @error('mission')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-blue-600 mt-2">Misi adalah langkah-langkah yang akan dilakukan untuk mencapai visi. Pisahkan setiap poin dengan baris baru.</p>
                </div>
            </div>

            <!-- Preview Section -->
            <div>
                <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    Preview
                </h4>
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
                    <div class="mb-6">
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                            <p class="font-semibold text-green-800 mb-2">Visi</p>
                            <p class="text-gray-800" id="vision-preview">{{ $profile->vision }}</p>
                        </div>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 mb-2">Misi</p>
                        <ul class="space-y-2" id="mission-preview">
                            @foreach(explode("\n", $profile->mission) as $misi)
                                @if(trim($misi))
                                    @php
                                        // Remove any numbered prefixes like "1.", "2.", etc.
                                        $cleanMisi = preg_replace('/^\d+\.\s*/', '', trim($misi));
                                    @endphp
                                    <li class="flex items-start">
                                        <span class="inline-flex items-center justify-center w-6 h-6 mr-3 rounded-full bg-green-100 text-green-700 text-sm">✓</span>
                                        <span class="text-gray-800">{{ $cleanMisi }}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.school-profile.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    Kembali ke Profil Sekolah
                </a>
                <button type="submit" class="px-6 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors">
                    Update Visi & Misi
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Live preview functionality
document.addEventListener('DOMContentLoaded', function() {
    const visionInput = document.getElementById('vision');
    const missionInput = document.getElementById('mission');
    const visionPreview = document.getElementById('vision-preview');
    const missionPreview = document.getElementById('mission-preview');

    function updateVisionPreview() {
        visionPreview.textContent = visionInput.value || 'Masukkan visi sekolah...';
    }

    function updateMissionPreview() {
        const missionText = missionInput.value || 'Masukkan misi sekolah...';
        const missionItems = missionText.split('\n').filter(item => item.trim());
        
        missionPreview.innerHTML = missionItems.map(item => {
            // Remove any numbered prefixes like "1.", "2.", etc.
            const cleanItem = item.trim().replace(/^\d+\.\s*/, '');
            return `<li class="flex items-start">
                <span class="inline-flex items-center justify-center w-6 h-6 mr-3 rounded-full bg-green-100 text-green-700 text-sm">✓</span>
                <span class="text-gray-800">${cleanItem}</span>
            </li>`;
        }).join('');
    }

    visionInput.addEventListener('input', updateVisionPreview);
    missionInput.addEventListener('input', updateMissionPreview);
});
</script>
@endsection
