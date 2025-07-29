@extends('dashboard.layouts-admin.admin')

@section('title', 'Visi dan Misi - Dinas Sosial Kota Majalengka')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold text-gray-900">Visi dan Misi Dinas Sosial</h1>
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
                    Edit Visi & Misi
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
            <form action="{{ route('dashboard.profil.visi-misi.update') }}" method="POST" enctype="multipart/form-data" id="visimisi-form">
                @csrf
                @method('PUT')

                <!-- Gambar/Logo -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">Gambar</label>
                    <div class="flex items-start space-x-4">
                        <div>
                            @if($visiMisi->gambar)
                            <img id="current-gambar" src="{{ asset('storage/' . $visiMisi->gambar) }}" alt="Gambar Visi Misi" class="w-32 h-32 object-cover rounded mb-2">
                            @else
                            <div id="current-gambar" class="w-32 h-32 bg-gray-200 rounded mb-2 flex items-center justify-center">
                                <!-- Icon Target/Tujuan Default -->
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
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

                <!-- Sejarah -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">Sejarah Dinas Sosial Majalengka</label>
                    <textarea name="sejarah" id="sejarah-input" rows="6" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-500" required placeholder="Masukkan sejarah singkat dinas...">{{ old('sejarah', $visiMisi->sejarah) }}</textarea>
                </div>

                <!-- Visi -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">Visi Dinas Sosial Majalengka</label>
                    <textarea name="visi" id="visi-input" rows="4" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-500" required placeholder="Masukkan visi dinas...">{{ old('visi', $visiMisi->visi) }}</textarea>
                </div>

                <!-- Misi -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">Misi Dinas Sosial Majalengka</label>
                    <textarea name="misi" id="misi-input" rows="8" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-500" required placeholder="Masukkan misi dinas... (gunakan bullet point atau numbering untuk setiap poin misi)">{{ old('misi', $visiMisi->misi) }}</textarea>
                    <small class="text-gray-500">Tip: Gunakan format seperti "1. Poin misi pertama" untuk setiap poin misi</small>
                </div>

                <div class="flex justify-between">
                    <button type="button" onclick="switchTab('preview')" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold px-6 py-2 rounded shadow">
                        Preview
                    </button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow">
                        Simpan Visi & Misi
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
                @if($visiMisi->gambar)
                <div id="preview-gambar-section" class="text-center">
                    <div id="preview-gambar" class="inline-block">
                        <img src="{{ asset('storage/' . $visiMisi->gambar) }}" alt="Gambar Visi Misi" class="max-w-xs h-auto rounded-lg shadow-md mx-auto">
                    </div>
                </div>
                @else
                <div id="preview-gambar-section" class="text-center" style="display: none;">
                    <div id="preview-gambar" class="inline-block">
                        <!-- Gambar akan muncul di sini saat di-upload -->
                    </div>
                </div>
                @endif

                <!-- Sejarah Preview -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        Sejarah
                    </h3>
                    <div id="preview-sejarah" class="text-gray-700 leading-relaxed whitespace-pre-line">
                        {{ $visiMisi->sejarah ?: 'Sejarah singkat akan ditampilkan di sini...' }}
                    </div>
                </div>

                <!-- Visi Preview -->
                <div class="bg-blue-50 rounded-lg p-6">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        Visi
                    </h3>
                    <div id="preview-visi" class="text-gray-700 leading-relaxed whitespace-pre-line text-lg italic">
                        {{ $visiMisi->visi ?: 'Visi akan ditampilkan di sini...' }}
                    </div>
                </div>

                <!-- Misi Preview -->
                <div class="bg-green-50 rounded-lg p-6">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                        Misi
                    </h3>
                    <div id="preview-misi" class="text-gray-700 leading-relaxed whitespace-pre-line">
                        {{ $visiMisi->misi ?: 'Misi akan ditampilkan di sini...' }}
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
        // Update sejarah
        const sejarahInput = document.getElementById('sejarah-input').value;
        document.getElementById('preview-sejarah').textContent = sejarahInput || 'Sejarah singkat akan ditampilkan di sini...';

        // Update visi
        const visiInput = document.getElementById('visi-input').value;
        document.getElementById('preview-visi').textContent = visiInput || 'Visi akan ditampilkan di sini...';

        // Update misi
        const misiInput = document.getElementById('misi-input').value;
        document.getElementById('preview-misi').textContent = misiInput || 'Misi akan ditampilkan di sini...';
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
                currentGambar.innerHTML = `<img src="${e.target.result}" alt="Gambar Visi Misi" class="w-32 h-32 object-cover rounded">`;

                // Update preview gambar
                previewGambar.innerHTML = `<img src="${e.target.result}" alt="Gambar Visi Misi" class="max-w-xs h-auto rounded-lg shadow-md mx-auto">`;
                previewGambarSection.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });

    // Real-time preview update saat mengetik
    document.getElementById('sejarah-input').addEventListener('input', updatePreview);
    document.getElementById('visi-input').addEventListener('input', updatePreview);
    document.getElementById('misi-input').addEventListener('input', updatePreview);
</script>
@endsection