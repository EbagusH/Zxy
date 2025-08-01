@extends('dashboard.layouts-admin.admin')

@section('title', 'Bidang Dayasos - Dinas Sosial Kota Majalengka')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Bidang Dayasos</h1>
                    <p class="text-gray-600 mt-2">Kelola informasi Bidang Dayasos</p>
                </div>
                <div class="flex items-center space-x-2">
                    <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
        <div id="success-alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 relative" role="alert">
            <div class="flex items-center justify-between">
                <div class="flex">
                    <div class="py-1">
                        <svg class="fill-current h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold">Berhasil!</p>
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                </div>
                <button type="button" class="text-green-700 hover:text-green-900" onclick="closeAlert('success-alert')">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div id="error-alert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 relative" role="alert">
            <div class="flex items-center justify-between">
                <div class="flex">
                    <div class="py-1">
                        <svg class="fill-current h-6 w-6 text-red-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 5h2v6H9V5zm0 8h2v2H9v-2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold">Error!</p>
                        <p class="text-sm">{{ session('error') }}</p>
                    </div>
                </div>
                <button type="button" class="text-red-700 hover:text-red-900" onclick="closeAlert('error-alert')">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        @endif

        @if($errors->any())
        <div id="validation-alert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 relative" role="alert">
            <div class="flex items-center justify-between">
                <div class="flex">
                    <div class="py-1">
                        <svg class="fill-current h-6 w-6 text-red-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 5h2v6H9V5zm0 8h2v2H9v-2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold">Terjadi kesalahan:</p>
                        <ul class="text-sm list-disc list-inside">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <button type="button" class="text-red-700 hover:text-red-900" onclick="closeAlert('validation-alert')">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        @endif

        <!-- Form Edit -->
        <div class="bg-white rounded-lg shadow-md">
            <form action="{{ route('dashboard.profil.dayasos.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Left Column - Form -->
                        <div class="space-y-6">
                            <h2 class="text-xl font-semibold text-gray-800 border-b border-gray-200 pb-2">
                                Informasi Bidang Dayasos
                            </h2>

                            <!-- Foto Upload with Drag & Drop -->
                            <div>
                                <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">
                                    Foto Bidang Dayasos
                                </label>
                                <div id="dropZone" class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-gray-400 transition-colors duration-200 cursor-pointer">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <span class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">
                                                Upload foto
                                            </span>
                                            <p class="pl-1">atau drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                                    </div>
                                </div>
                                <input id="foto" name="foto" type="file" class="hidden" accept="image/*">
                                @error('foto')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Preview Image -->
                            <div id="imagePreview" class="hidden">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Preview Foto:</label>
                                <div class="relative">
                                    <img id="preview" src="" alt="Preview" class="max-w-full h-48 object-cover rounded-lg shadow-md">
                                    <button type="button" id="removePreview" class="absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white rounded-full p-1 text-xs transition-colors duration-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Isi/Deskripsi -->
                            <div>
                                <label for="isi" class="block text-sm font-medium text-gray-700 mb-2">
                                    Deskripsi Bidang Dayasos
                                </label>
                                <textarea
                                    id="isi"
                                    name="isi"
                                    rows="12"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-vertical"
                                    placeholder="Masukkan deskripsi, tugas pokok, dan fungsi Bidang Linjamsos...">{{ old('isi', $dayasos->isi ?? '') }}</textarea>
                                @error('isi')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                                <p class="text-gray-500 text-xs mt-1">
                                    Anda dapat menambahkan deskripsi, tugas pokok, dan fungsi bidang dalam satu teks.
                                </p>
                            </div>
                        </div>

                        <!-- Right Column - Current Data -->
                        <div class="space-y-6">
                            <h2 class="text-xl font-semibold text-gray-800 border-b border-gray-200 pb-2">
                                Data Saat Ini
                            </h2>

                            <!-- Current Photo -->
                            @if($dayasos && $dayasos->foto)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Foto Saat Ini:</label>
                                <img src="{{ asset('storage/' . $dayasos->foto) }}"
                                    alt="Foto Bidang Dayasos"
                                    class="max-w-full h-48 object-cover rounded-lg shadow-md">
                            </div>
                            @else
                            <div class="text-center py-8">
                                <svg class="mx-auto h-24 w-24 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <p class="text-gray-500 text-sm mt-2">Belum ada foto</p>
                            </div>
                            @endif

                            <!-- Current Description -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Saat Ini:</label>
                                <div class="bg-gray-50 p-4 rounded-lg border min-h-32">
                                    @if($dayasos && $dayasos->isi)
                                    <p class="text-gray-700 whitespace-pre-line">{{ $dayasos->isi }}</p>
                                    @else
                                    <p class="text-gray-500 italic">Belum ada deskripsi</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 rounded-b-lg">
                    <div class="flex justify-between items-center">
                        <div class="text-sm text-gray-500">
                            <span class="font-medium">Terakhir diperbarui:</span>
                            @if($dayasos && $dayasos->updated_at)
                            {{ $dayasos->updated_at->format('d F Y, H:i') }} WIB
                            @else
                            Belum pernah diperbarui
                            @endif
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('profil.dayasos') }}"
                                target="_blank"
                                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                                Lihat Halaman
                            </a>
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md text-sm font-medium transition-colors duration-200 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Auto close alerts and close button functionality
    function closeAlert(alertId) {
        const alert = document.getElementById(alertId);
        if (alert) {
            alert.style.transition = 'opacity 0.3s ease-out';
            alert.style.opacity = '0';
            setTimeout(() => {
                alert.remove();
            }, 300);
        }
    }

    // Auto close alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = ['success-alert', 'error-alert', 'validation-alert'];
        alerts.forEach(alertId => {
            const alert = document.getElementById(alertId);
            if (alert) {
                setTimeout(() => {
                    closeAlert(alertId);
                }, 5000);
            }
        });

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
            dropZone.classList.add('border-blue-500', 'bg-blue-50');
        }

        function unhighlight(e) {
            dropZone.classList.remove('border-blue-500', 'bg-blue-50');
        }

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;

            if (files.length > 0) {
                const file = files[0];
                if (file.type.startsWith('image/')) {
                    fileInput.files = files;
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
    });
</script>
@endsection