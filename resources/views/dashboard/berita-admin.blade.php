@extends('dashboard.layouts-admin.admin')

@section('title', 'Kelola Berita dan Artikel - Dinas Sosial Kabupaten Majalengka')

@section('content')
<div class="p-3 md:p-6">
    <!-- Header -->
    <div class="mb-4 md:mb-6">
        <div class="flex flex-col space-y-3 md:flex-row md:justify-between md:items-center md:space-y-0">
            <div>
                <h1 class="text-xl md:text-2xl font-bold text-gray-900">Kelola Berita dan Artikel</h1>
                <p class="text-sm md:text-base text-gray-600">Kelola semua berita dan artikel yang telah dipublikasikan</p>
            </div>
            <div class="flex flex-col space-y-2 md:flex-row md:items-center md:space-y-0 md:space-x-3">
                <!-- Search Box -->
                <div class="relative">
                    <input type="text" id="search-input" placeholder="Cari berita/artikel..." class="w-full md:w-auto pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                    <svg class="w-4 h-4 md:w-5 md:h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>

                <!-- Tambah Baru -->
                <a href="{{ route('dashboard.crud-berita') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="mr-1.5 -ml-0.5 w-4 h-4 md:w-5 md:h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    <span class="hidden sm:inline">Tambah Baru</span>
                    <span class="sm:hidden">Tambah</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
    <div id="success-alert" class="mb-4 md:mb-6 bg-green-50 border border-green-200 rounded-md p-4">
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

    <!-- Tabs -->
    <div class="mb-4 md:mb-6">
        <nav class="flex space-x-4 md:space-x-8 overflow-x-auto" aria-label="Tabs">
            <button onclick="showTab('berita')" id="tab-berita" class="tab-button active whitespace-nowrap border-b-2 border-indigo-500 py-2 px-1 text-sm font-medium text-indigo-600 flex-shrink-0">
                Berita ({{ $berita->count() }})
            </button>
            <button onclick="showTab('artikel')" id="tab-artikel" class="tab-button whitespace-nowrap border-b-2 border-transparent py-2 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 flex-shrink-0">
                Artikel ({{ $artikel->count() }})
            </button>
        </nav>
    </div>

    <!-- Berita Tab Content -->
    <div id="content-berita" class="tab-content">
        <div class="mb-4">
            <h2 class="text-lg font-medium text-gray-900">Daftar Berita</h2>
            <p class="text-sm text-gray-500">{{ $berita->count() }} berita tersedia</p>
        </div>

        @if($berita->count() > 0)
        <div id="berita-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
            @foreach($berita as $item)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
                <!-- Image -->
                <div class="h-40 md:h-48 bg-gray-200 overflow-hidden">
                    @if($item->foto)
                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full flex items-center justify-center bg-gray-100">
                        <svg class="w-8 h-8 md:w-12 md:h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    @endif
                </div>

                <!-- Content -->
                <div class="p-3 md:p-4">
                    <!-- Badge -->
                    <div class="mb-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            Berita
                        </span>
                    </div>

                    <!-- Title -->
                    <h3 class="text-base md:text-lg font-medium text-gray-900 mb-2 line-clamp-2">{{ $item->judul }}</h3>

                    <!-- Meta Info -->
                    <div class="flex items-center justify-between text-xs text-gray-500 mb-3 md:mb-4">
                        <span>ID: {{ $item->id }}</span>
                        <span>{{ $item->created_at->format('d M Y') }}</span>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col space-y-2 md:flex-row md:space-y-0 md:space-x-2">
                        <a href="{{ route('dashboard.berita-admin.show', $item->id) }}" class="flex-1 inline-flex items-center justify-center px-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Lihat
                        </a>
                        <div class="flex space-x-2 md:flex-1">
                            <a href="{{ route('dashboard.berita-admin.edit', $item->id) }}" class="flex-1 inline-flex items-center justify-center px-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit
                            </a>
                            <button onclick="confirmDelete('{{ $item->id }}', 'artikel')" class="inline-flex items-center justify-center px-3 py-2 border border-red-300 shadow-sm text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-8 md:py-12">
            <svg class="mx-auto h-8 w-8 md:h-12 md:w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
            </svg>
            <h3 class="mt-4 text-sm font-medium text-gray-900">Belum ada berita</h3>
            <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan berita pertama Anda.</p>
            <div class="mt-6">
                <a href="{{ route('dashboard.crud-berita') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="mr-1.5 -ml-0.5 w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Tambah Berita
                </a>
            </div>
        </div>
        @endif
    </div>

    <!-- Artikel Tab Content -->
    <div id="content-artikel" class="tab-content hidden">
        <div class="mb-4">
            <h2 class="text-lg font-medium text-gray-900">Daftar Artikel</h2>
            <p class="text-sm text-gray-500">{{ $artikel->count() }} artikel tersedia</p>
        </div>

        @if($artikel->count() > 0)
        <div id="artikel-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
            @foreach($artikel as $item)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
                <!-- Image -->
                <div class="h-40 md:h-48 bg-gray-200 overflow-hidden">
                    @if($item->foto)
                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full flex items-center justify-center bg-gray-100">
                        <svg class="w-8 h-8 md:w-12 md:h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    @endif
                </div>

                <!-- Content -->
                <div class="p-3 md:p-4">
                    <!-- Badge -->
                    <div class="mb-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Artikel
                        </span>
                    </div>

                    <!-- Title -->
                    <h3 class="text-base md:text-lg font-medium text-gray-900 mb-2 line-clamp-2">{{ $item->judul }}</h3>

                    <!-- Meta Info -->
                    <div class="flex items-center justify-between text-xs text-gray-500 mb-3 md:mb-4">
                        <span>ID: {{ $item->id }}</span>
                        <span>{{ $item->created_at->format('d M Y') }}</span>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col space-y-2 md:flex-row md:space-y-0 md:space-x-2">
                        <a href="{{ route('dashboard.berita-admin.show', $item->id) }}" class="flex-1 inline-flex items-center justify-center px-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Lihat
                        </a>
                        <div class="flex space-x-2 md:flex-1">
                            <a href="{{ route('dashboard.berita-admin.edit', $item->id) }}" class="flex-1 inline-flex items-center justify-center px-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit
                            </a>
                            <button onclick="confirmDelete('{{ $item->id }}', 'artikel')" class="inline-flex items-center justify-center px-3 py-2 border border-red-300 shadow-sm text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-8 md:py-12">
            <svg class="mx-auto h-8 w-8 md:h-12 md:w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <h3 class="mt-4 text-sm font-medium text-gray-900">Belum ada artikel</h3>
            <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan artikel pertama Anda.</p>
            <div class="mt-6">
                <a href="{{ route('dashboard.crud-berita') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="mr-1.5 -ml-0.5 w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Tambah Artikel
                </a>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 max-w-md shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.864-.833-2.634 0L3.228 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mt-5" id="modal-title">Hapus Data</h3>
            <div class="mt-2 px-4 md:px-7 py-3">
                <p class="text-sm text-gray-500" id="modal-message">
                    Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>
            <div class="items-center px-4 py-3 flex flex-col space-y-2 md:flex-row md:space-y-0 md:space-x-2 md:justify-center">
                <button id="deleteConfirm" class="w-full md:w-auto px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                    Hapus
                </button>
                <button id="deleteCancel" class="w-full md:w-auto px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300">
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

<!-- Tab and Alert JavaScript -->
<script>
    // Global variables
    let originalBeritaData = [];
    let originalArtikelData = [];
    let currentQuery = '';

    // Function untuk confirm delete
    function confirmDelete(id, type) {
        console.log('Delete confirmation for:', id, type); // Debug log

        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        const confirmBtn = document.getElementById('deleteConfirm');
        const cancelBtn = document.getElementById('deleteCancel');

        // Set form action dengan route yang benar
        form.action = `/dashboard/berita-admin/${id}`;

        console.log('Form action set to:', form.action); // Debug log

        // Update modal message
        const modalMessage = document.getElementById('modal-message');
        const typeText = type === 'berita' ? 'berita' : 'artikel';
        modalMessage.textContent = `Apakah Anda yakin ingin menghapus ${typeText} ini? Tindakan ini tidak dapat dibatalkan.`;

        // Show modal
        modal.classList.remove('hidden');

        // Remove previous event listeners to prevent multiple attachments
        const newConfirmBtn = confirmBtn.cloneNode(true);
        const newCancelBtn = cancelBtn.cloneNode(true);
        confirmBtn.parentNode.replaceChild(newConfirmBtn, confirmBtn);
        cancelBtn.parentNode.replaceChild(newCancelBtn, cancelBtn);

        // Handle confirm
        newConfirmBtn.addEventListener('click', function() {
            console.log('Delete confirmed, submitting form'); // Debug log
            form.submit();
        });

        // Handle cancel
        newCancelBtn.addEventListener('click', function() {
            console.log('Delete cancelled'); // Debug log
            modal.classList.add('hidden');
        });

        // Handle click outside modal
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.add('hidden');
            }
        });
    }

    // Function untuk membuat card HTML
    function createCard(item, type) {
        const badgeClass = type === 'berita' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800';
        const badgeText = type === 'berita' ? 'Berita' : 'Artikel';

        // Define URLs (sesuaikan dengan route Laravel Anda)
        const showUrl = '/dashboard/berita-admin/';
        const editUrl = '/dashboard/berita-admin/';

        // Format tanggal
        const date = new Date(item.created_at);
        const formattedDate = date.toLocaleDateString('id-ID', {
            day: 'numeric',
            month: 'short',
            year: 'numeric'
        });

        return `
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
        <!-- Image -->
        <div class="h-40 md:h-48 bg-gray-200 overflow-hidden">
            ${item.foto ? 
                `<img src="/storage/${item.foto}" alt="${item.judul}" class="w-full h-full object-cover">` :
                `<div class="w-full h-full flex items-center justify-center bg-gray-100">
                    <svg class="w-8 h-8 md:w-12 md:h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>`
            }
        </div>

        <!-- Content -->
        <div class="p-3 md:p-4">
            <!-- Badge -->
            <div class="mb-2">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${badgeClass}">
                    ${badgeText}
                </span>
            </div>

            <!-- Title -->
            <h3 class="text-base md:text-lg font-medium text-gray-900 mb-2 line-clamp-2">${item.judul}</h3>

            <!-- Meta Info -->
            <div class="flex items-center justify-between text-xs text-gray-500 mb-3 md:mb-4">
                <span>ID: ${item.id}</span>
                <span>${formattedDate}</span>
            </div>

            <!-- Actions -->
            <div class="flex flex-col space-y-2 md:flex-row md:space-y-0 md:space-x-2">
                <a href="${showUrl}${item.id}" class="flex-1 inline-flex items-center justify-center px-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    Lihat
                 </a>
                <div class="flex space-x-2 md:flex-1">
                    <a href="${editUrl}${item.id}/edit" class="flex-1 inline-flex items-center justify-center px-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit
                    </a>
                    <button onclick="confirmDelete('${item.id}', '${type}')" class="inline-flex items-center justify-center px-3 py-2 border border-red-300 shadow-sm text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
`;
    }

    // Function untuk membuat empty state saat tidak ada data
    function createEmptyState(type, isSearch = false, query = '') {
        const isBerita = type === 'berita';

        if (isSearch) {
            // Empty state untuk pencarian
            const title = isBerita ? 'Berita tidak ditemukan' : 'Artikel tidak ditemukan';
            return `
            <div class="text-center py-8 md:py-12 col-span-full">
                <svg class="mx-auto h-8 w-8 md:h-12 md:w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <h3 class="mt-4 text-sm font-medium text-gray-900">${title}</h3>
                <p class="mt-1 text-sm text-gray-500">Tidak ditemukan ${type} dengan kata kunci "${query}"</p>
                <div class="mt-6">
                    <button onclick="clearSearch()" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="mr-1.5 -ml-0.5 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Hapus Pencarian
                    </button>
                </div>
            </div>
        `;
        } else {
            // Empty state untuk data kosong (original blade template style)
            const title = isBerita ? 'Belum ada berita' : 'Belum ada artikel';
            const description = isBerita ? 'Mulai menambahkan berita pertama Anda.' : 'Mulai menambahkan artikel pertama Anda.';
            const addUrl = isBerita ? '/dashboard/berita-admin/create' : '/dashboard/artikel-admin/create';

            return `
            <div class="text-center py-8 md:py-12 col-span-full">
                <svg class="mx-auto h-8 w-8 md:h-12 md:w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3v9m0 0h-3m3 0h3"></path>
                </svg>
                <h3 class="mt-4 text-sm font-medium text-gray-900">${title}</h3>
                <p class="mt-1 text-sm text-gray-500">${description}</p>
                <div class="mt-6">
                    <a href="${addUrl}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="mr-1.5 -ml-0.5 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah ${badgeText}
                    </a>
                </div>
            </div>
        `;
        }
    }

    // Function untuk melakukan pencarian
    function performSearch(query, data) {
        if (!query || !query.trim()) return data;

        const searchQuery = query.toLowerCase().trim();
        return data.filter(item => {
            return item.judul.toLowerCase().includes(searchQuery) ||
                item.id.toString().includes(searchQuery);
        });
    }

    // Function untuk update tampilan hasil pencarian
    function updateSearchResults(type, filteredData, query) {
        const container = document.getElementById(`${type}-list`);
        const countElement = document.getElementById(`${type}-count`);
        const totalElement = document.getElementById(`${type}-total`);

        if (!container) return;

        // Cek apakah sedang dalam mode pencarian
        const isSearchMode = query && query.trim();

        if (filteredData.length === 0) {
            if (isSearchMode) {
                // Tampilkan empty state untuk pencarian
                container.innerHTML = createEmptyState(type, true, query);
            } else {
                // Tampilkan empty state untuk data kosong
                container.innerHTML = createEmptyState(type, false);
            }
        } else {
            // Tampilkan data
            container.innerHTML = filteredData.map(item => createCard(item, type)).join('');
        }

        // Update counters
        if (countElement) countElement.textContent = filteredData.length;
        if (totalElement) totalElement.textContent = filteredData.length;
    }

    // Function untuk menjalankan live search
    function runLiveSearch(query) {
        currentQuery = query;

        // Pastikan query adalah string
        const searchQuery = query || '';

        // Filter dan update berita
        const filteredBerita = performSearch(searchQuery, originalBeritaData);
        updateSearchResults('berita', filteredBerita, searchQuery);

        // Filter dan update artikel
        const filteredArtikel = performSearch(searchQuery, originalArtikelData);
        updateSearchResults('artikel', filteredArtikel, searchQuery);
    }

    // Function untuk clear search
    function clearSearch() {
        const searchInput = document.getElementById('search-input');
        if (searchInput) {
            searchInput.value = '';
            // Panggil runLiveSearch dengan string kosong untuk reset tampilan
            runLiveSearch('');
        }
    }

    // Function untuk tab switching
    function showTab(tabName) {
        // Update tab buttons
        document.querySelectorAll('.tab-button').forEach(btn => {
            btn.classList.remove('active', 'border-indigo-500', 'text-indigo-600');
            btn.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
        });

        // Update content visibility
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });

        // Show selected tab
        const activeTab = document.getElementById(`tab-${tabName}`);
        const activeContent = document.getElementById(`content-${tabName}`);

        if (activeTab) {
            activeTab.classList.add('active', 'border-indigo-500', 'text-indigo-600');
            activeTab.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
        }

        if (activeContent) {
            activeContent.classList.remove('hidden');
        }
    }

    // Function untuk close alert
    function closeAlert(alertId) {
        const alert = document.getElementById(alertId);
        if (alert) {
            alert.style.display = 'none';
        }
    }

    // Debounce function untuk optimasi
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Initialize ketika DOM loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil data original dari elemen yang sudah ada
        const beritaElements = document.querySelectorAll('#berita-list > div:not(.text-center)');
        const artikelElements = document.querySelectorAll('#artikel-list > div:not(.text-center)');

        // Extract data berita dari DOM
        originalBeritaData = Array.from(beritaElements).map(el => {
            const titleEl = el.querySelector('h3');
            const idEl = el.querySelector('.text-xs span');
            const dateEl = el.querySelector('.text-xs span:last-child');
            const imgEl = el.querySelector('img');

            return {
                id: idEl ? idEl.textContent.replace('ID: ', '') : '',
                judul: titleEl ? titleEl.textContent : '',
                foto: imgEl ? imgEl.src.replace(window.location.origin + '/storage/', '') : null,
                created_at: dateEl ? new Date(dateEl.textContent).toISOString() : new Date().toISOString()
            };
        });

        // Extract data artikel dari DOM
        originalArtikelData = Array.from(artikelElements).map(el => {
            const titleEl = el.querySelector('h3');
            const idEl = el.querySelector('.text-xs span');
            const dateEl = el.querySelector('.text-xs span:last-child');
            const imgEl = el.querySelector('img');

            return {
                id: idEl ? idEl.textContent.replace('ID: ', '') : '',
                judul: titleEl ? titleEl.textContent : '',
                foto: imgEl ? imgEl.src.replace(window.location.origin + '/storage/', '') : null,
                created_at: dateEl ? new Date(dateEl.textContent).toISOString() : new Date().toISOString()
            };
        });

        // Setup search input dengan debounce
        const searchInput = document.getElementById('search-input');
        if (searchInput) {
            const debouncedSearch = debounce((query) => {
                runLiveSearch(query);
            }, 300);

            // Handle input event
            searchInput.addEventListener('input', function(e) {
                const query = e.target.value;
                debouncedSearch(query);
            });

            // Handle keypress event
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    runLiveSearch(e.target.value);
                }
            });

            // Handle clear event (untuk browser yang support clear button)
            searchInput.addEventListener('search', function(e) {
                if (e.target.value === '') {
                    runLiveSearch('');
                }
            });
        }

        // Auto-close success alert
        const successAlert = document.getElementById('success-alert');
        if (successAlert) {
            setTimeout(() => {
                successAlert.style.display = 'none';
            }, 5000);
        }

        // Handle ESC key untuk modal
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const modal = document.getElementById('deleteModal');
                if (modal && !modal.classList.contains('hidden')) {
                    modal.classList.add('hidden');
                }
            }
        });
    });
</script>

<!-- Additional CSS for line clamp -->
<style>
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