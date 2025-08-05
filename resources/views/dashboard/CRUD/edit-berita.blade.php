@extends('dashboard.layouts-admin.admin')

@section('title', 'Edit Berita dan Artikel - Dinas Sosial Kabupaten Majalengka')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Edit Berita dan Artikel</h1>
                    <p class="text-gray-600 mt-2">Silakan ubah informasi di bawah ini untuk mengedit berita atau artikel</p>
                </div>
                <div class="flex items-center space-x-2">
                    <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white shadow-md rounded-lg">
            <form action="{{ route('dashboard.berita-admin.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Left Column - Form Fields -->
                        <div class="space-y-6">
                            <h2 class="text-xl font-semibold text-gray-800 border-b border-gray-200 pb-2">
                                Informasi Berita/Artikel
                            </h2>

                            <!-- ID Field (Read Only) -->
                            <div>
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
                            <div>
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
                            <div>
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

                            <!-- Photo Upload with Drag & Drop -->
                            <div>
                                <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ $berita->foto ? 'Ganti Foto' : 'Foto' }}
                                </label>
                                <div id="dropZone" class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-gray-400 transition-colors duration-200 cursor-pointer">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <span class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500">
                                                Upload foto
                                            </span>
                                            <p class="pl-1">atau drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                                        <p class="text-xs text-gray-500">{{ $berita->foto ? 'Kosongkan jika tidak ingin mengubah foto' : 'Opsional' }}</p>
                                    </div>
                                </div>
                                <input id="foto" name="foto" type="file" class="hidden" accept="image/*">
                                @error('foto')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Preview New Image -->
                            <div id="imagePreview" class="hidden">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Preview Foto Baru:</label>
                                <div class="relative">
                                    <img id="preview" src="" alt="Preview" class="max-w-full h-48 object-cover rounded-lg shadow-md">
                                    <button type="button" id="removePreview" class="absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white rounded-full p-1 text-xs transition-colors duration-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                                <p class="text-sm text-gray-500 mt-2">Foto ini akan menggantikan foto lama</p>
                            </div>

                            <!-- Content Field -->
                            <div>
                                <label for="isi" class="block text-sm font-medium text-gray-700 mb-2">
                                    Isi Konten <span class="text-red-500">*</span>
                                </label>
                                <textarea
                                    id="isi"
                                    name="isi"
                                    rows="12"
                                    required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 resize-vertical @error('isi') border-red-300 @enderror"
                                    placeholder="Masukkan isi berita atau artikel...">{{ old('isi', $berita->isi) }}</textarea>
                                @error('isi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Right Column - Current Data -->
                        <div class="space-y-6">
                            <h2 class="text-xl font-semibold text-gray-800 border-b border-gray-200 pb-2">
                                Data Saat Ini
                            </h2>

                            <!-- Current Photo -->
                            @if($berita->foto)
                            <div id="currentPhotoSection">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Foto Saat Ini:</label>
                                <img src="{{ asset('storage/' . $berita->foto) }}"
                                    alt="Foto Berita/Artikel"
                                    class="max-w-full h-48 object-cover rounded-lg shadow-md">
                                <p class="text-sm text-gray-500 mt-2">{{ $berita->foto }}</p>
                            </div>
                            @else
                            <div class="text-center py-8">
                                <svg class="mx-auto h-24 w-24 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <p class="text-gray-500 text-sm mt-2">Belum ada foto</p>
                            </div>
                            @endif

                            <!-- Current Content Preview -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Konten Saat Ini:</label>
                                <div class="bg-gray-50 p-4 rounded-lg border max-h-64 overflow-y-auto">
                                    <p class="text-gray-700 whitespace-pre-line text-sm">{{ $berita->isi }}</p>
                                </div>
                            </div>

                            <!-- Timestamps -->
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Dibuat:</label>
                                    <input
                                        type="text"
                                        value="{{ $berita->created_at ? $berita->created_at->format('d F Y, H:i') . ' WIB' : '-' }}"
                                        readonly
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-50 text-gray-500 cursor-not-allowed focus:outline-none">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Terakhir Diubah:</label>
                                    <input
                                        type="text"
                                        value="{{ $berita->updated_at ? $berita->updated_at->format('d F Y, H:i') . ' WIB' : '-' }}"
                                        readonly
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-50 text-gray-500 cursor-not-allowed focus:outline-none">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 rounded-b-lg">
                    <div class="flex justify-between items-center">
                        <div class="text-sm text-gray-500">
                            <span class="font-medium">ID:</span> {{ $berita->id }} |
                            <span class="font-medium">Kategori:</span> {{ ucfirst($berita->kategori) }}
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('dashboard.berita-admin') }}"
                                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Kembali
                            </a>
                            <button type="submit"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md text-sm font-medium transition-colors duration-200 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Update Berita
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // File upload functionality
        const dropZone = document.getElementById('dropZone');
        const fileInput = document.getElementById('foto');
        const preview = document.getElementById('preview');
        const previewContainer = document.getElementById('imagePreview');
        const removeBtn = document.getElementById('removePreview');
        const currentPhotoSection = document.getElementById('currentPhotoSection');

        // Click to upload
        dropZone.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            fileInput.click();
        });

        // Drag and drop functionality
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
            document.body.addEventListener(eventName, preventDefaults, false);
        });

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, unhighlight, false);
        });

        dropZone.addEventListener('drop', handleDrop, false);
        fileInput.addEventListener('change', handleFileSelect);
        if (removeBtn) {
            removeBtn.addEventListener('click', removePreview);
        }

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        function highlight(e) {
            dropZone.classList.add('border-indigo-500', 'bg-indigo-50');
            dropZone.classList.remove('border-gray-300');
        }

        function unhighlight(e) {
            dropZone.classList.remove('border-indigo-500', 'bg-indigo-50');
            dropZone.classList.add('border-gray-300');
        }

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;

            if (files.length > 0) {
                const file = files[0];
                if (file.type.startsWith('image/')) {
                    // Use DataTransfer to properly assign files
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    fileInput.files = dataTransfer.files;
                    previewImage(file);
                } else {
                    alert('Hanya file gambar yang diperbolehkan!');
                }
            }
        }

        function handleFileSelect(e) {
            const file = e.target.files[0];
            if (file) {
                previewImage(file);
            }
        }

        function previewImage(file) {
            // Validate file size (2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file terlalu besar! Maksimal 2MB.');
                fileInput.value = '';
                return;
            }

            // Validate file type
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            if (!allowedTypes.includes(file.type)) {
                alert('Format file tidak didukung! Gunakan JPEG, PNG, atau GIF.');
                fileInput.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                previewContainer.classList.remove('hidden');

                // Dim current photo section to show it will be replaced
                if (currentPhotoSection) {
                    currentPhotoSection.style.opacity = '0.5';
                }
            }
            reader.readAsDataURL(file);
        }

        function removePreview() {
            fileInput.value = '';
            preview.src = '';
            previewContainer.classList.add('hidden');

            // Restore current photo section opacity
            if (currentPhotoSection) {
                currentPhotoSection.style.opacity = '1';
            }
        }

        // Handle paste event for images
        document.addEventListener('paste', function(e) {
            const items = e.clipboardData.items;
            for (let i = 0; i < items.length; i++) {
                if (items[i].type.indexOf('image') !== -1) {
                    const file = items[i].getAsFile();
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    fileInput.files = dataTransfer.files;
                    previewImage(file);
                    break;
                }
            }
        });

        // Form submission validation
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                console.log('Form submitting with files:', fileInput.files.length);
            });
        }
    });
</script>

<style>
    /* Enhanced styles for better drag and drop experience */
    #dropZone {
        transition: all 0.2s ease;
    }

    #dropZone:hover {
        transform: scale(1.01);
    }

    #imagePreview img {
        transition: transform 0.2s ease;
    }

    #imagePreview img:hover {
        transform: scale(1.05);
    }

    #removePreview {
        transition: all 0.2s ease;
    }

    #removePreview:hover {
        transform: scale(1.1);
    }

    #currentPhotoSection {
        transition: opacity 0.3s ease;
    }
</style>

@endsection