@extends('dashboard.layouts-admin.admin')

@section('title', 'Tambah Pegawai - Dinas Sosial Kabupaten Majalengka')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-4 md:mb-6">
        <div class="flex flex-col space-y-3 md:flex-row md:justify-between md:items-center md:space-y-0">
            <div>
                <h1 class="text-xl md:text-2xl font-bold text-gray-900">
                    Tambah Pegawai
                </h1>
                <p class="text-sm md:text-base text-gray-600">
                    Tambah data pegawai baru Dinas Sosial Kabupaten Majalengka
                </p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('dashboard.profil.pegawai-admin') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="mr-1.5 -ml-0.5 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Alert Error -->
    @if($errors->any())
    <div id="error-alert" class="mb-6 bg-red-50 border border-red-200 rounded-md p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan pada form:</h3>
                <div class="mt-2 text-sm text-red-700">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button type="button" onclick="closeAlert('error-alert')" class="inline-flex bg-red-50 rounded-md p-1.5 text-red-500 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-red-50 focus:ring-red-600">
                        <span class="sr-only">Dismiss</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Form Container -->
    <div class="max-w-2xl mx-auto">
        <div class="bg-white shadow-sm border border-gray-200 rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Informasi Pegawai</h3>
                <p class="mt-1 text-sm text-gray-600">
                    Masukkan informasi dasar pegawai
                </p>
            </div>

            <form action="{{ route('dashboard.profil.pegawai.store') }}"
                method="POST"
                enctype="multipart/form-data"
                class="p-6">
                @csrf

                <!-- Foto Upload Section -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto Pegawai</label>

                    <!-- Preview Container -->
                    <div class="flex flex-col items-center">
                        <div class="relative mb-4">
                            <div id="photo-preview" class="w-32 h-32 rounded-full border-4 border-gray-200 overflow-hidden bg-gray-100">
                                <div id="default-avatar" class="w-full h-full flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            </div>

                            <!-- Change Photo Button -->
                            <label for="foto" class="absolute bottom-0 right-0 bg-indigo-600 hover:bg-indigo-700 text-white rounded-full p-2 shadow-lg cursor-pointer transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </label>
                        </div>

                        <input type="file" id="foto" name="foto" accept="image/*" class="hidden" onchange="previewImage(this)">

                        <p class="text-xs text-gray-500 text-center">
                            Klik ikon kamera untuk mengubah foto<br>
                            Format: JPG, JPEG, PNG (Max: 2MB)
                        </p>

                        @error('foto')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Nama Field -->
                <div class="mb-6">
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                        id="nama"
                        name="nama"
                        value="{{ old('nama') }}"
                        required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('nama') border-red-300 @enderror"
                        placeholder="Masukkan nama lengkap pegawai">
                    @error('nama')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jabatan Field -->
                <div class="mb-6">
                    <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-2">
                        Jabatan <span class="text-red-500">*</span>
                    </label>
                    <select id="jabatan"
                        name="jabatan"
                        required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('jabatan') border-red-300 @enderror">
                        <option value="">Pilih Jabatan</option>
                        <option value="Kepala Dinas" {{ old('jabatan') == 'Kepala Dinas' ? 'selected' : '' }}>Kepala Dinas</option>
                        <option value="Sekretaris" {{ old('jabatan') == 'Sekretaris' ? 'selected' : '' }}>Sekretaris</option>
                        <option value="Kabid" {{ old('jabatan') == 'Kabid' ? 'selected' : '' }}>Kabid</option>
                        <option value="Kasubag" {{ old('jabatan') == 'Kasubag' ? 'selected' : '' }}>Kasubag</option>
                        <option value="Kasi" {{ old('jabatan') == 'Kasi' ? 'selected' : '' }}>Kasi</option>
                        <option value="Staff" {{ old('jabatan') == 'Staff' ? 'selected' : '' }}>Staff</option>
                    </select>
                    @error('jabatan')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('dashboard.profil.pegawai-admin') }}"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="mr-1.5 -ml-0.5 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Tambah Pegawai
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
    // Function to close alert
    function closeAlert(alertId) {
        const alertElement = document.getElementById(alertId);
        if (alertElement) {
            alertElement.style.transition = 'opacity 0.3s ease-out';
            alertElement.style.opacity = '0';
            setTimeout(() => {
                alertElement.remove();
            }, 300);
        }
    }

    // Image preview function
    function previewImage(input) {
        const preview = document.getElementById('preview-img');
        const defaultAvatar = document.getElementById('default-avatar');
        const photoPreview = document.getElementById('photo-preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                // Hide default avatar if exists
                if (defaultAvatar) {
                    defaultAvatar.style.display = 'none';
                }

                // Show or create preview image
                if (preview) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                } else {
                    const img = document.createElement('img');
                    img.id = 'preview-img';
                    img.src = e.target.result;
                    img.className = 'w-full h-full object-cover';
                    img.alt = 'Preview Foto';
                    photoPreview.appendChild(img);
                }
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    // Auto-close alert after 8 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const errorAlert = document.getElementById('error-alert');
        if (errorAlert) {
            setTimeout(() => {
                closeAlert('error-alert');
            }, 8000);
        }
    });

    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        const nama = document.getElementById('nama').value.trim();
        const jabatan = document.getElementById('jabatan').value;

        if (!nama) {
            e.preventDefault();
            alert('Nama lengkap harus diisi!');
            document.getElementById('nama').focus();
            return;
        }

        if (!jabatan) {
            e.preventDefault();
            alert('Jabatan harus dipilih!');
            document.getElementById('jabatan').focus();
            return;
        }
    });
</script>

@endsection