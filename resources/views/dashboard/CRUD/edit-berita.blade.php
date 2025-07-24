@extends('dashboard.layouts-admin.admin')

@section('title', 'Edit Berita dan Artikel - Dinas Sosial Kota Majalengka')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Berita dan Artikel</h1>
        <p class="text-gray-600">Silakan ubah informasi di bawah ini untuk mengedit berita atau artikel</p>
    </div>

    <!-- Form -->
    <div class="bg-white shadow-sm rounded-lg border border-gray-200">
        <form action="{{ route('dashboard.berita-admin.update', $berita->id) }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PUT')

            <!-- ID Field (Read Only) -->
            <div class="mb-6">
                <label for="id" class="block text-sm font-medium text-gray-700 mb-2">ID</label>
                <input
                    type="text"
                    id="id"
                    name="id"
                    value="{{ $berita->id }}"
                    readonly
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-50 text-gray-500 cursor-not-allowed focus:outline-none">
                <p class="mt-1 text-sm text-gray-500">ID tidak dapat diubah</p>
            </div>

            <!-- Title Field -->
            <div class="mb-6">
                <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">
                    Judul <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    id="judul"
                    name="judul"
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('judul') border-red-300 @enderror"
                    placeholder="Masukkan judul berita atau artikel"
                    value="{{ old('judul', $berita->judul) }}">
                @error('judul')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category Dropdown -->
            <div class="mb-6">
                <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">
                    Kategori <span class="text-red-500">*</span>
                </label>
                <select
                    id="kategori"
                    name="kategori"
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('kategori') border-red-300 @enderror">
                    <option value="">Pilih Kategori</option>
                    <option value="berita" {{ old('kategori', $berita->kategori) == 'berita' ? 'selected' : '' }}>Berita</option>
                    <option value="artikel" {{ old('kategori', $berita->kategori) == 'artikel' ? 'selected' : '' }}>Artikel</option>
                </select>
                @error('kategori')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Content Field -->
            <div class="mb-6">
                <label for="isi" class="block text-sm font-medium text-gray-700 mb-2">
                    Isi Konten <span class="text-red-500">*</span>
                </label>
                <textarea
                    id="isi"
                    name="isi"
                    rows="10"
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('isi') border-red-300 @enderror"
                    placeholder="Masukkan isi berita atau artikel...">{{ old('isi', $berita->isi) }}</textarea>
                @error('isi')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Current Photo Display -->
            @if($berita->foto)
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Foto Saat Ini</label>
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('storage/' . $berita->foto) }}"
                            alt="Current photo"
                            class="h-32 w-32 object-cover rounded-lg border border-gray-300">
                    </div>
                    <div class="flex-grow">
                        <p class="text-sm text-gray-600">{{ $berita->foto }}</p>
                        <p class="text-xs text-gray-500 mt-1">Pilih foto baru di bawah jika ingin mengubah gambar</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Photo Upload -->
            <div class="mb-6">
                <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ $berita->foto ? 'Ganti Foto' : 'Foto' }}
                </label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-gray-400 transition-colors">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="foto" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                <span>Upload a file</span>
                                <input
                                    id="foto"
                                    name="foto"
                                    type="file"
                                    accept="image/*"
                                    class="sr-only">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                        <p class="text-xs text-gray-500">{{ $berita->foto ? 'Kosongkan jika tidak ingin mengubah foto' : 'Opsional' }}</p>
                    </div>
                </div>
                @error('foto')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Timestamps Display (Optional) -->
            <div class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Dibuat</label>
                    <input
                        type="text"
                        value="{{ $berita->created_at ? $berita->created_at->format('d/m/Y H:i:s') : '-' }}"
                        readonly
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-50 text-gray-500 cursor-not-allowed focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Terakhir Diubah</label>
                    <input
                        type="text"
                        value="{{ $berita->updated_at ? $berita->updated_at->format('d/m/Y H:i:s') : '-' }}"
                        readonly
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-50 text-gray-500 cursor-not-allowed focus:outline-none">
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end space-x-3">
                <a href="{{ route('dashboard.berita-admin') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Batal
                </a>
                <button
                    type="submit"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="mr-1.5 -ml-0.5 w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                    </svg>
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Preview Image Script -->
<script>
    document.getElementById('foto').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Create preview if doesn't exist
                let preview = document.getElementById('image-preview');
                if (!preview) {
                    preview = document.createElement('div');
                    preview.id = 'image-preview';
                    preview.className = 'mt-4';
                    preview.innerHTML = `
                        <div class="flex items-start space-x-4">
                            <img id="preview-img" class="h-32 w-32 object-cover rounded-lg border border-gray-300" src="" alt="Preview">
                            <div>
                                <p class="text-sm text-gray-600 font-medium">Preview foto baru</p>
                                <p class="text-xs text-gray-500 mt-1">Ini adalah foto yang akan menggantikan foto lama</p>
                            </div>
                        </div>
                    `;
                    document.querySelector('input[name="foto"]').closest('.mb-6').appendChild(preview);
                }
                document.getElementById('preview-img').src = e.target.result;
            };
            reader.readAsDataURL(file);
        } else {
            // Remove preview if no file selected
            const preview = document.getElementById('image-preview');
            if (preview) {
                preview.remove();
            }
        }
    });
</script>

@endsection