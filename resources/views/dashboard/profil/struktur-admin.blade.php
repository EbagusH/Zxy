@extends('dashboard.layouts-admin.admin')

@section('title', 'Struktur Organisasi - Dinas Sosial Kota Majalengka')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold text-gray-900">Struktur Organisasi Dinas Sosial</h1>
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
                    Edit Struktur
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
        <div class="bg-white shadow-md rounded-lg p-6 max-w-4xl mx-auto">
            <form action="{{ route('dashboard.profil.struktur.update') }}" method="POST" enctype="multipart/form-data" id="struktur-form">
                @csrf
                @method('PUT')

                <!-- Current Structure Image -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-4">Gambar Struktur Organisasi Saat Ini</label>
                    <div class="flex justify-center mb-4">
                        @if($struktur->gambar_struktur)
                        <div id="current-struktur" class="max-w-full">
                            <img src="{{ asset('storage/' . $struktur->gambar_struktur) }}" alt="Struktur Organisasi" class="max-w-full h-auto rounded-lg shadow-md">
                        </div>
                        @else
                        <div id="current-struktur" class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                            <!-- Icon Diagram Default -->
                            <div class="text-center">
                                <svg class="w-16 h-16 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                                <span class="text-gray-500">Belum ada struktur organisasi</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Upload New Structure -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">Upload Struktur Organisasi Baru</label>
                    <input type="file" name="gambar_struktur" id="struktur-input" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" accept="image/*" required />
                    <small class="text-gray-500">Format: JPG, PNG, GIF. Maksimal 5MB. Disarankan menggunakan gambar dengan resolusi tinggi untuk diagram yang jelas.</small>
                </div>

                <div class="flex justify-between">
                    <button type="button" onclick="switchTab('preview')" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold px-6 py-2 rounded shadow">
                        Preview
                    </button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow">
                        Simpan Struktur
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Preview Tab Content -->
    <div id="preview-content" class="tab-content hidden">
        <div class="bg-white shadow-md rounded-lg p-8 max-w-6xl mx-auto">

            <!-- Preview Content -->
            <div class="flex justify-center">
                <div id="preview-struktur" class="max-w-full">
                    @if($struktur->gambar_struktur)
                    <img src="{{ asset('storage/' . $struktur->gambar_struktur) }}" alt="Struktur Organisasi" class="max-w-full h-auto rounded-lg shadow-md">
                    @else
                    <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                        <div class="text-center">
                            <svg class="w-20 h-20 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            <span class="text-gray-500 text-lg">Struktur organisasi akan ditampilkan di sini</span>
                        </div>
                    </div>
                    @endif
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

            // Show preview content
            editContent.classList.add('hidden');
            previewContent.classList.remove('hidden');
        }
    }

    // Preview gambar saat file dipilih
    document.getElementById('struktur-input').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewStruktur = document.getElementById('preview-struktur');
                const currentStruktur = document.getElementById('current-struktur');

                // Update current struktur di edit tab
                currentStruktur.innerHTML = `<img src="${e.target.result}" alt="Struktur Organisasi" class="max-w-full h-auto rounded-lg shadow-md">`;

                // Update preview struktur
                previewStruktur.innerHTML = `<img src="${e.target.result}" alt="Struktur Organisasi" class="max-w-full h-auto rounded-lg shadow-md">`;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection