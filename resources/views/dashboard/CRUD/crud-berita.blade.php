@extends('dashboard.layouts-admin.admin')

@section('title', 'Tambah Berita dan Artikel - Dinas Sosial Kabupaten Majalengka')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Tambah Berita dan Artikel Baru</h1>
        <p class="text-gray-600">Silakan isi form di bawah ini untuk menambahkan berita atau artikel baru</p>
    </div>

    <!-- Form -->
    <div class="bg-white shadow-sm rounded-lg border border-gray-200">
        <form action="{{ route('dashboard.crud-berita.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf

            <!-- ID Field (Auto Increment - Read Only) -->
            <div class="mb-6">
                <label for="id" class="block text-sm font-medium text-gray-700 mb-2">ID</label>
                <input
                    type="text"
                    id="id"
                    name="id"
                    value="Auto Generated"
                    readonly
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-50 text-gray-500 cursor-not-allowed focus:outline-none">
                <p class="mt-1 text-sm text-gray-500">ID akan otomatis dibuat oleh sistem</p>
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
                    value="{{ old('judul') }}">
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
                    <option value="berita" {{ old('kategori') == 'berita' ? 'selected' : '' }}>Berita</option>
                    <option value="artikel" {{ old('kategori') == 'artikel' ? 'selected' : '' }}>Artikel</option>
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
                    placeholder="Masukkan isi berita atau artikel...">{{ old('isi') }}</textarea>
                @error('isi')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Photo Upload with Improved Drag and Drop -->
            <div class="mb-6">
                <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">
                    Foto
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
                    </div>
                </div>
                <input id="foto" name="foto" type="file" class="hidden" accept="image/*">

                <!-- Preview Image -->
                <div id="imagePreview" class="mt-4 hidden">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Preview Foto:</label>
                    <div class="relative inline-block">
                        <img id="preview" src="" alt="Preview" class="h-32 w-32 object-cover rounded-lg border border-gray-300 shadow-md">
                        <button type="button" id="removePreview" class="absolute -top-2 -right-2 bg-red-500 hover:bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs transition-colors duration-200">
                            ×
                        </button>
                    </div>
                    <p class="text-sm text-gray-500 mt-2">Preview foto yang akan diupload</p>
                </div>

                @error('foto')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
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
                    Simpan
                </button>
            </div>
        </form>
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
        removeBtn.addEventListener('click', removePreview);

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
            }
            reader.readAsDataURL(file);
        }

        function removePreview() {
            fileInput.value = '';
            preview.src = '';
            previewContainer.classList.add('hidden');
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
</style>

@endsection