@extends('dashboard.layouts-admin.admin')

@section('title', 'Sambutan - Dinas Sosial Kabupaten Majalengka')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold text-gray-900">Sambutan Kepala Dinas Sosial</h1>
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
                    Edit Sambutan
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
            <form action="{{ route('dashboard.profil.sambutan.update') }}" method="POST" enctype="multipart/form-data" id="sambutan-form">
                @csrf
                @method('PUT')

                <!-- Foto Kepala Dinas -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Foto Kepala Dinas</label>
                    <div class="flex items-start space-x-4">
                        <div>
                            @if($sambutan->foto)
                            <img id="current-foto" src="{{ asset('storage/' . $sambutan->foto) }}" alt="Foto Kepala Dinas" class="w-32 h-32 object-cover rounded mb-2">
                            @else
                            <div id="current-foto" class="w-32 h-32 bg-gray-200 rounded mb-2 flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <input type="file" name="foto" id="foto-input" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" accept="image/*" />
                            <small class="text-gray-500">Format: JPG, PNG, GIF. Maksimal 2MB</small>
                        </div>
                    </div>
                </div>

                <!-- Nama Kepala Dinas -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Nama Kepala Dinas</label>
                    <input type="text" name="nama_kepala_dinas" id="nama-input" value="{{ old('nama_kepala_dinas', $sambutan->nama_kepala_dinas) }}" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-500" required>
                </div>

                <!-- Jabatan -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Jabatan</label>
                    <input type="text" name="jabatan" id="jabatan-input" value="{{ old('jabatan', $sambutan->jabatan) }}" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-500" required>
                </div>

                <!-- Isi Sambutan -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">Isi Sambutan</label>
                    <textarea name="isi_sambutan" id="isi-input" rows="6" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-500" required>{{ old('isi_sambutan', $sambutan->isi_sambutan) }}</textarea>
                </div>

                <div class="flex justify-between">
                    <button type="button" onclick="switchTab('preview')" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold px-6 py-2 rounded shadow">
                        Preview
                    </button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Preview Tab Content -->
    <div id="preview-content" class="tab-content hidden">
        <div class="bg-white shadow-md rounded-lg p-8 max-w-4xl mx-auto">
            <div class="space-y-8">

                <!-- Foto Preview -->
                <div class="text-center">
                    <div id="preview-foto" class="w-48 h-48 bg-gray-200 rounded-lg flex items-center justify-center overflow-hidden mx-auto shadow">
                        @if($sambutan->foto)
                        <img src="{{ asset('storage/' . $sambutan->foto) }}" alt="Foto Kepala Dinas" class="w-full h-full object-cover">
                        @else
                        <!-- Icon Default -->
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        @endif
                    </div>

                    <!-- Nama dan Jabatan -->
                    <div class="mt-4">
                        <h3 id="preview-nama" class="text-2xl font-bold text-gray-900">
                            {{ $sambutan->nama_kepala_dinas ?: 'Nama Kepala Dinas' }}
                        </h3>
                        <p id="preview-jabatan" class="text-lg text-blue-600 font-medium">
                            {{ $sambutan->jabatan ?: 'Jabatan' }}
                        </p>
                    </div>
                </div>

                <!-- Isi Sambutan -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        Sambutan Kepala Dinas
                    </h3>
                    <div id="preview-isi" class="text-gray-700 leading-relaxed whitespace-pre-line">
                        {{ $sambutan->isi_sambutan ?: 'Isi sambutan akan ditampilkan di sini...' }}
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="text-center">
                    <button type="button" onclick="switchTab('edit')" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow">
                        Kembali ke Edit
                    </button>
                </div>

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
            }, 8000); // Error alert ditampilkan lebih lama
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
        // Update nama
        const namaInput = document.getElementById('nama-input').value;
        document.getElementById('preview-nama').textContent = namaInput || 'Nama Kepala Dinas';

        // Update jabatan
        const jabatanInput = document.getElementById('jabatan-input').value;
        document.getElementById('preview-jabatan').textContent = jabatanInput || 'Jabatan';

        // Update isi sambutan
        const isiInput = document.getElementById('isi-input').value;
        document.getElementById('preview-isi').textContent = isiInput || 'Isi sambutan akan ditampilkan di sini...';
    }

    // Preview foto saat file dipilih
    document.getElementById('foto-input').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewFoto = document.getElementById('preview-foto');
                const currentFoto = document.getElementById('current-foto');

                // Update current foto di edit tab
                currentFoto.innerHTML = `<img src="${e.target.result}" alt="Foto Kepala Dinas" class="w-32 h-32 object-cover rounded">`;

                // Update preview foto
                previewFoto.innerHTML = `<img src="${e.target.result}" alt="Foto Kepala Dinas" class="w-full h-full object-cover">`;
            };
            reader.readAsDataURL(file);
        }
    });

    // Real-time preview update saat mengetik
    document.getElementById('nama-input').addEventListener('input', updatePreview);
    document.getElementById('jabatan-input').addEventListener('input', updatePreview);
    document.getElementById('isi-input').addEventListener('input', updatePreview);
</script>
@endsection