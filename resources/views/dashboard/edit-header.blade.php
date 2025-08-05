@extends('dashboard.layouts-admin.admin')

@section('title', 'Edit Header - Dinas Sosial Kabupaten Majalengka')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold text-gray-900">Edit Gambar Header Halaman User</h1>
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

    <!-- Edit Form -->
    <div class="bg-white shadow-md rounded-lg p-6 max-w-4xl mx-auto">
        <form action="{{ route('dashboard.edit-header') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Current Header -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Gambar Header Saat Ini</label>
                @if($header_foto->gambar)
                <div class="relative">
                    <img src="{{ asset('storage/' . $header_foto->gambar) }}" alt="Header Gambar" class="max-w-full h-auto rounded shadow border">
                    <div class="mt-2 text-sm text-gray-600">
                        <strong>File:</strong> {{ basename($header_foto->gambar) }}<br>
                        <strong>Terakhir diperbarui:</strong> {{ $header_foto->updated_at->format('d M Y H:i') }}
                    </div>
                </div>
                @else
                <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500 border-2 border-dashed border-gray-300">
                    <div class="text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <p class="mt-2">Belum ada gambar header</p>
                    </div>
                </div>
                @endif
            </div>

            <!-- Upload New Header - Drag and Drop -->
            <div class="mb-6">
                <label for="gambar_header" class="block text-gray-700 font-semibold mb-2">Upload Gambar Header Baru</label>
                <div id="drop-area" class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors">
                    <input type="file" name="gambar_header" id="gambar_header" accept="image/*" class="hidden" required>
                    <div id="drop-content">
                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <p id="drop-text" class="text-gray-600 font-medium">Seret dan lepas file di sini atau klik untuk memilih</p>
                        <p class="text-gray-400 text-sm mt-2">Pilih gambar untuk header website</p>
                    </div>
                    <div id="file-info" class="hidden">
                        <svg class="mx-auto h-12 w-12 text-green-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p id="file-name" class="text-gray-700 font-medium"></p>
                        <p class="text-gray-500 text-sm">Klik untuk mengganti file</p>
                    </div>
                </div>
                <div class="mt-3 text-sm text-gray-500">
                    <div class="flex items-center space-x-4">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            Format: JPG, PNG, JPEG
                        </span>
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h4a1 1 0 010 2H6.414l2.293 2.293a1 1 0 01-1.414 1.414L5 6.414V8a1 1 0 01-2 0V4zm9 1a1 1 0 010-2h4a1 1 0 011 1v4a1 1 0 01-2 0V6.414l-2.293 2.293a1 1 0 11-1.414-1.414L13.586 5H12zm-9 7a1 1 0 012 0v1.586l2.293-2.293a1 1 0 111.414 1.414L6.414 15H8a1 1 0 010 2H4a1 1 0 01-1-1v-4zm13-1a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 010-2h1.586l-2.293-2.293a1 1 0 111.414-1.414L15.586 13H14a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            Maksimal: 5MB
                        </span>
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                            </svg>
                            Disarankan: 1920px lebar
                        </span>
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('dashboard.index-admin') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-2 rounded shadow transition-colors">
                    Batal
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow transition-colors">
                    <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    Simpan Gambar Header
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Drag and drop functionality
    const dropArea = document.getElementById('drop-area');
    const fileInput = document.getElementById('gambar_header');
    const dropContent = document.getElementById('drop-content');
    const fileInfo = document.getElementById('file-info');
    const fileName = document.getElementById('file-name');

    dropArea.addEventListener('click', () => fileInput.click());

    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, handleDragOver);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, handleDragLeave);
    });

    function handleDragOver(e) {
        e.preventDefault();
        dropArea.classList.add('bg-blue-50', 'border-blue-400', 'border-solid');
        dropArea.classList.remove('border-dashed');
    }

    function handleDragLeave(e) {
        e.preventDefault();
        dropArea.classList.remove('bg-blue-50', 'border-blue-400', 'border-solid');
        dropArea.classList.add('border-dashed');
    }

    dropArea.addEventListener('drop', e => {
        e.preventDefault();
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            displayFileName(files[0]);
        }
    });

    fileInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            displayFileName(file);
        }
    });

    function displayFileName(file) {
        dropContent.classList.add('hidden');
        fileInfo.classList.remove('hidden');
        fileName.textContent = file.name;
    }

    // Alert auto hide
    document.addEventListener('DOMContentLoaded', function() {
        const successAlert = document.getElementById('success-alert');
        const errorAlert = document.getElementById('error-alert');

        if (successAlert) {
            setTimeout(() => {
                successAlert.style.transition = 'opacity 0.5s ease-out';
                successAlert.style.opacity = '0';
                setTimeout(() => successAlert.remove(), 500);
            }, 5000);
        }

        if (errorAlert) {
            setTimeout(() => {
                errorAlert.style.transition = 'opacity 0.5s ease-out';
                errorAlert.style.opacity = '0';
                setTimeout(() => errorAlert.remove(), 500);
            }, 8000);
        }
    });

    function closeAlert(id) {
        const alert = document.getElementById(id);
        if (alert) {
            alert.style.transition = 'opacity 0.3s ease-out';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 300);
        }
    }
</script>
@endsection