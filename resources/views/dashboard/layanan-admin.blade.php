@extends('dashboard.layouts-admin.admin')

@section('title', 'Daftar Layanan - Dinas Sosial Kabupaten Majalengka')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-4 md:mb-6">
        <div class="flex flex-col space-y-3 md:flex-row md:justify-between md:items-center md:space-y-0">
            <div>
                <h1 class="text-xl md:text-2xl font-bold text-gray-900">Daftar Layanan Dinsos</h1>
                <p class="text-sm md:text-base text-gray-600">Daftar Layanan Dinas Sosial Kabupaten Majalengka</p>
            </div>
            <div class="flex flex-col space-y-2 md:flex-row md:items-center md:space-y-0 md:space-x-3">
                <!-- Search Box -->
                <div class="relative">
                    <input type="text" id="search-input" placeholder="Cari Layanan..." class="w-full md:w-auto pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                    <svg class="w-4 h-4 md:w-5 md:h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>

                <!-- Tambah Baru -->
                <a href="{{ route('dashboard.layanan.create') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="mr-1.5 -ml-0.5 w-4 h-4 md:w-5 md:h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    <span class="hidden sm:inline">Tambah Layanan</span>
                    <span class="sm:hidden">Tambah</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
    <div id="success-alert" class="mb-6 bg-green-50 border border-green-200 rounded-md p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
            </div>
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button type="button" onclick="closeAlert('success-alert')" class="inline-flex bg-green-50 rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-50 focus:ring-green-600">
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

    <!-- Alert Error -->
    @if(session('error'))
    <div id="error-alert" class="mb-6 bg-red-50 border border-red-200 rounded-md p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
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

    <!-- Header Info -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-medium text-gray-900">Daftar Layanan</h2>
                <p class="text-sm text-gray-500">{{ $layanan->count() }} layanan terdaftar</p>
            </div>

            <!-- Filter Options -->
            <div class="flex items-center space-x-3">
                <select id="filter-bidang" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Bidang</option>
                    <option value="Linjamsos">Linjamsos</option>
                    <option value="Dayasos">Dayasos</option>
                    <option value="Resos">Resos</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Layanan Grid Content -->
    @if($layanan->count() > 0)
    <div id="layanan-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        @foreach($layanan as $item)
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow layanan-card">
            <!-- Photo -->
            <div class="h-40 bg-gray-200 overflow-hidden">
                @if($item->foto)
                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}" class="w-full h-full object-cover">
                @else
                <div class="w-full h-full flex items-center justify-center bg-gray-100">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                @endif
            </div>

            <!-- Content -->
            <div class="p-4">
                <!-- Name -->
                <h3 class="text-sm font-bold text-gray-900 mb-2 line-clamp-2 layanan-nama" title="{{ $item->nama }}">
                    {{ $item->nama }}
                </h3>

                <!-- Bidang -->
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mb-2 layanan-bidang">
                    {{ $item->bidang }}
                </span>

                <!-- Actions -->
                <div class="flex space-x-2 justify-center">
                    <a href="{{ route('dashboard.layanan.edit', $item->id) }}"
                        class="inline-flex items-center justify-center px-3 py-2 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit
                    </a>
                    <button onclick="confirmDelete('{{ $item->id }}', '{{ $item->nama }}')"
                        class="inline-flex items-center justify-center px-3 py-2 border border-red-300 shadow-sm text-xs font-medium rounded text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Hapus
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-12">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
        </svg>
        <h3 class="mt-4 text-sm font-medium text-gray-900">Belum ada layanan</h3>
        <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan layanan pertama Anda.</p>
        <div class="mt-6">
            <a href="{{ route('dashboard.layanan.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="mr-1.5 -ml-0.5 w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah Layanan
            </a>
        </div>
    </div>
    @endif
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.864-.833-2.634 0L3.228 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mt-5" id="modal-title">Hapus Data Layanan</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500" id="modal-message">
                    Apakah Anda yakin ingin menghapus data layanan ini? Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>
            <div class="items-center px-4 py-3">
                <button id="deleteConfirm" class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300 mr-2">
                    Hapus
                </button>
                <button id="deleteCancel" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Form untuk Delete -->
<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

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

    // Modal confirmation function
    function confirmDelete(id, nama) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        const confirmBtn = document.getElementById('deleteConfirm');
        const cancelBtn = document.getElementById('deleteCancel');
        const modalMessage = document.getElementById('modal-message');

        // Update modal message with service name
        modalMessage.innerHTML = `Apakah Anda yakin ingin menghapus layanan <strong>${nama}</strong>? Tindakan ini tidak dapat dibatalkan.`;

        // Set form action
        form.action = `{{ route('dashboard.layanan-admin') }}/${id}`;

        // Show modal
        modal.classList.remove('hidden');

        // Handle confirm
        confirmBtn.onclick = function() {
            form.submit();
        };

        // Handle cancel
        cancelBtn.onclick = function() {
            modal.classList.add('hidden');
        };

        // Close modal when clicking outside
        modal.onclick = function(event) {
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        };

        // Handle ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                modal.classList.add('hidden');
            }
        });
    }

    // Search functionality
    document.getElementById('search-input').addEventListener('keyup', function() {
        const query = this.value.toLowerCase();
        const cards = document.querySelectorAll('.layanan-card');

        cards.forEach(card => {
            const nama = card.querySelector('.layanan-nama').textContent.toLowerCase();
            const bidang = card.querySelector('.layanan-bidang').textContent.toLowerCase();

            if (nama.includes(query) || bidang.includes(query)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });

    // Filter functionality
    document.getElementById('filter-bidang').addEventListener('change', function() {
        filterLayanan();
    });

    function filterLayanan() {
        const bidangFilter = document.getElementById('filter-bidang').value.toLowerCase();
        const cards = document.querySelectorAll('.layanan-card');

        cards.forEach(card => {
            const bidang = card.querySelector('.layanan-bidang').textContent.toLowerCase();

            let showCard = true;

            if (bidangFilter && !bidang.includes(bidangFilter)) {
                showCard = false;
            }

            card.style.display = showCard ? 'block' : 'none';
        });
    }

    // Auto-close alert after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const successAlert = document.getElementById('success-alert');
        const errorAlert = document.getElementById('error-alert');

        if (successAlert) {
            setTimeout(() => {
                closeAlert('success-alert');
            }, 5000);
        }

        if (errorAlert) {
            setTimeout(() => {
                closeAlert('error-alert');
            }, 8000);
        }
    });
</script>

<!-- Additional CSS for line clamp -->
<style>
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

@endsection