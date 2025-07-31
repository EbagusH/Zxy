@extends('dashboard.layouts-admin.admin')

@section('title', 'Tambah Layanan - Dinas Sosial Kota Majalengka')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex items-center space-x-3">
            <a href="{{ route('dashboard.layanan-admin') }}" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Tambah Layanan Baru</h1>
                <p class="text-gray-600">Tambahkan layanan baru Dinas Sosial Kota Majalengka</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="max-w-4xl">
        <form action="{{ route('dashboard.layanan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="bg-white shadow rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Layanan -->
                    <div class="md:col-span-2">
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Layanan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('nama') border-red-500 @enderror"
                            placeholder="Masukkan nama layanan" required>
                        @error('nama')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Bidang -->
                    <div>
                        <label for="bidang" class="block text-sm font-medium text-gray-700 mb-2">
                            Bidang <span class="text-red-500">*</span>
                        </label>
                        <select name="bidang" id="bidang"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('bidang') border-red-500 @enderror" required>
                            <option value="">Pilih Bidang</option>
                            <option value="Linjamsos" {{ old('bidang') == 'Linjamsos' ? 'selected' : '' }}>Linjamsos</option>
                            <option value="Dayasos" {{ old('bidang') == 'Dayasos' ? 'selected' : '' }}>Dayasos</option>
                            <option value="Resos" {{ old('bidang') == 'Resos' ? 'selected' : '' }}>Resos</option>
                        </select>
                        @error('bidang')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Foto -->
                    <div>
                        <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">
                            Foto Layanan
                        </label>
                        <input type="file" name="foto" id="foto" accept="image/*"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('foto') border-red-500 @enderror">
                        <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, GIF. Maksimal 2MB</p>
                        @error('foto')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Preview Foto -->
                    <div class="md:col-span-2">
                        <div id="preview-container" class="hidden">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Preview Foto</label>
                            <div class="max-w-xs">
                                <img id="preview-image" src="" alt="Preview" class="w-full h-48 object-cover rounded-lg border border-gray-300">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('dashboard.layanan-admin') }}"
                    class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Batal
                </a>
                <button type="submit"
                    class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan Layanan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Preview foto
    document.getElementById('foto').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const previewContainer = document.getElementById('preview-container');
        const previewImage = document.getElementById('preview-image');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            previewContainer.classList.add('hidden');
        }
    });
</script>

@endsection