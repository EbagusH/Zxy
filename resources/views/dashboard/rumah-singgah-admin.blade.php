@extends('dashboard.layouts-admin.admin')
@section('title', 'Rumah Singgah - Dinas Sosial Kota Majalengka')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold text-gray-900">Rumah Singgah Dinas Sosial</h1>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
    <div id="success-alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 relative">
        <span class="block sm:inline">{{ session('success') }}</span>
        <button onclick="closeAlert('success-alert')" class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title>Close</title>
                <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
            </svg>
        </button>
    </div>
    @endif

    <!-- Alert Errors -->
    @if($errors->any())
    <div id="error-alert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 relative">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button onclick="closeAlert('error-alert')" class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title>Close</title>
                <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
            </svg>
        </button>
    </div>
    @endif

    <!-- Tab Navigation -->
    <div class="mb-6">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8">
                <button
                    id="edit-tab"
                    class="tab-button border-b-2 border-blue-500 py-2 px-1 text-sm font-medium text-blue-600"
                    onclick="switchTab('edit')">
                    Edit Rumah Singgah
                </button>
                <button
                    id="preview-tab"
                    class="tab-button border-b-2 border-transparent py-2 px-1 text-sm font-medium text-gray-500 hover:text-gray-700"
                    onclick="switchTab('preview')">
                    Preview
                </button>
            </nav>
        </div>
    </div>

    <!-- Edit Tab Content -->
    <div id="edit-content" class="tab-content">
        <div class="bg-white shadow-md rounded-lg p-6 max-w-6xl mx-auto">
            <form action="{{ route('rumah-singgah.update') }}" method="POST" enctype="multipart/form-data" id="rumah-singgah-form">
                @csrf
                @method('PUT')

                <!-- Gambar/Logo -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">Gambar Rumah Singgah</label>
                    <div class="flex items-start space-x-4">
                        <div>
                            @if($rumahSinggah->gambar)
                            <img id="current-gambar" src="{{ asset('storage/' . $rumahSinggah->gambar) }}" alt="Gambar Rumah Singgah" class="w-32 h-32 object-cover rounded mb-2">
                            @else
                            <div id="current-gambar" class="w-32 h-32 bg-gray-200 rounded mb-2 flex items-center justify-center">
                                <!-- Icon Rumah Default -->
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                            </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <input type="file" name="gambar" id="gambar-input" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" accept="image/*" />
                            <small class="text-gray-500">Format: JPG, PNG, GIF. Maksimal 2MB</small>
                        </div>
                    </div>
                </div>

                <!-- Isi/Deskripsi -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">Deskripsi Rumah Singgah</label>
                    <textarea name="isi" id="isi-input" rows="8" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-500" required placeholder="Masukkan deskripsi lengkap tentang rumah singgah...">{{ old('isi', $rumahSinggah->isi) }}</textarea>
                    <small class="text-gray-500">Jelaskan fasilitas, tujuan, dan layanan yang tersedia di rumah singgah</small>
                </div>

                <!-- Lokasi -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">Lokasi Rumah Singgah</label>
                    <textarea name="lokasi" id="lokasi-input" rows="4" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-500" required placeholder="Masukkan alamat lengkap dan informasi lokasi...">{{ old('lokasi', $rumahSinggah->lokasi) }}</textarea>
                    <small class="text-gray-500">Cantumkan alamat lengkap, cara akses, dan petunjuk arah jika perlu</small>
                </div>

                <div class="flex justify-between">
                    <button type="button" onclick="switchTab('preview')" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold px-6 py-2 rounded shadow">
                        Preview
                    </button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow">
                        Simpan Rumah Singgah
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Preview Tab Content -->
    <div id="preview-content" class="tab-content hidden">
        <div class="bg-white shadow-md rounded-lg p-8 max-w-6xl mx-auto">
            <!-- Preview Content -->
            <div class="space-y-8">
                <!-- Gambar Preview (jika ada) -->
                @if($rumahSinggah->gambar)
                <div id="preview-gambar-section" class="text-center">
                    <div id="preview-gambar" class="inline-block">
                        <img src="{{ asset('storage/' . $rumahSinggah->gambar) }}" alt="Gambar Rumah Singgah" class="max-w-lg h-auto rounded-lg shadow-md mx-auto">
                    </div>
                </div>
                @else
                <div id="preview-gambar-section" class="text-center" style="display: none;">
                    <div id="preview-gambar" class="inline-block">
                        <!-- Gambar akan muncul di sini saat di-upload -->
                    </div>
                </div>
                @endif

                <!-- Header -->
                <div class="text-center">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Rumah Singgah</h1>
                    <p class="text-gray-600">Dinas Sosial Kota Majalengka</p>
                </div>

                <!-- Deskripsi Preview -->
                <div class="bg-blue-50 rounded-lg p-6">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Tentang Rumah Singgah
                    </h3>
                    <div id="preview-isi" class="text-gray-700 leading-relaxed whitespace-pre-line">
                        {{ $rumahSinggah->isi ?: 'Deskripsi rumah singgah akan ditampilkan di sini...' }}
                    </div>
                </div>

                <!-- Lokasi Preview -->
                <div class="bg-green-50 rounded-lg p-6">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Lokasi
                    </h3>
                    <div id="preview-lokasi" class="text-gray-700 leading-relaxed whitespace-pre-line">
                        {{ $rumahSinggah->lokasi ?: 'Informasi lokasi akan ditampilkan di sini...' }}
                    </div>
                </div>
            </div>

            <!-- Preview Actions -->
            <div class="mt-8 text-center">
                <button type="button" onclick="switchTab('edit')" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow">
                    Kembali ke Edit
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Auto hide alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        // Auto hide success alert
        const successAlert = document.getElementById('success-alert');
        if (successAlert) {
            setTimeout(function() {
                successAlert.style.transition = 'opacity 0.5s ease-out';
                successAlert.style.opacity = '0';
                setTimeout(function() {
                    successAlert.remove();
                }, 500);
            }, 5000);
        }

        // Auto hide error alert
        const errorAlert = document.getElementById('error-alert');
        if (errorAlert) {
            setTimeout(function() {
                errorAlert.style.transition = 'opacity 0.5s ease-out';
                errorAlert.style.opacity = '0';
                setTimeout(function() {
                    errorAlert.remove();
                }, 500);
            }, 8000);
        }
    });

    // Function to manually close alerts
    function closeAlert(alertId) {
        const alert = document.getElementById(alertId);
        if (alert) {
            alert.style.transition = 'opacity 0.3s ease-out';
            alert.style.opacity = '0';
            setTimeout(function() {
                alert.remove();
            }, 300);
        }
    }

    // Tab switching function
    function switchTab(tab) {
        const editTab = document.getElementById('edit-tab');
        const previewTab = document.getElementById('preview-tab');
        const editContent = document.getElementById('edit-content');
        const previewContent = document.getElementById('preview-content');

        if (tab === 'edit') {
            // Active edit tab
            editTab.className = 'tab-button border-b-2 border-blue-500 py-2 px-1 text-sm font-medium text-blue-600';
            previewTab.className = 'tab-button border-b-2 border-transparent py-2 px-1 text-sm font-medium text-gray-500 hover:text-gray-700';

            // Show edit content
            editContent.classList.remove('hidden');
            previewContent.classList.add('hidden');
        } else {
            // Active preview tab
            previewTab.className = 'tab-button border-b-2 border-blue-500 py-2 px-1 text-sm font-medium text-blue-600';
            editTab.className = 'tab-button border-b-2 border-transparent py-2 px-1 text-sm font-medium text-gray-500 hover:text-gray-700';

            // Update preview content
            updatePreview();

            // Show preview content
            editContent.classList.add('hidden');
            previewContent.classList.remove('hidden');
        }
    }

    // Update preview content
    function updatePreview() {
        // Update isi
        const isiInput = document.getElementById('isi-input').value;
        document.getElementById('preview-isi').textContent = isiInput || 'Deskripsi rumah singgah akan ditampilkan di sini...';

        // Update lokasi
        const lokasiInput = document.getElementById('lokasi-input').value;
        document.getElementById('preview-lokasi').textContent = lokasiInput || 'Informasi lokasi akan ditampilkan di sini...';
    }

    // Preview gambar saat file dipilih
    document.getElementById('gambar-input').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const previewGambarSection = document.getElementById('preview-gambar-section');
        const previewGambar = document.getElementById('preview-gambar');
        const currentGambar = document.getElementById('current-gambar');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Update current gambar di edit tab
                currentGambar.innerHTML = `<img src="${e.target.result}" alt="Gambar Rumah Singgah" class="w-32 h-32 object-cover rounded">`;

                // Update preview gambar
                previewGambar.innerHTML = `<img src="${e.target.result}" alt="Gambar Rumah Singgah" class="max-w-lg h-auto rounded-lg shadow-md mx-auto">`;
                previewGambarSection.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });

    // Real-time preview update saat mengetik
    document.getElementById('isi-input').addEventListener('input', updatePreview);
    document.getElementById('lokasi-input').addEventListener('input', updatePreview);
</script>
@endsection