@extends('layouts.app')
@section('title', 'Berita - Dinas Sosial Kota Majalengka')
@section('content')
<!-- Hero Section with Background Image -->
<div class="relative h-96 bg-cover bg-center bg-no-repeat" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://i.ytimg.com/vi/aKeSm4BUFCk/maxresdefault.jpg');">
    <div class="absolute inset-0 flex items-center justify-center">
        <div class="text-center text-white">
            <h1 class="text-5xl font-bold mb-4">Berita dan Artikel Terbaru</h1>
        </div>
    </div>
</div>

<!-- Berita Section -->
<section class="py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Berita</h2>
            <div class="w-20 h-1 bg-cyan-400 mx-auto"></div>
        </div>

        @if($berita->count() > 0)
        <!-- Berita Grid -->
        <div id="berita-container">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="berita-grid">
                @foreach($berita as $item)
                <div class="berita-item bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    <!-- Image -->
                    <div class="h-48 bg-gray-200 overflow-hidden">
                        @if($item->foto)
                        <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover">
                        @else
                        <div class="h-48 bg-gradient-to-br from-cyan-400 to-cyan-600 flex items-center justify-center">
                            <div class="text-center">
                                <svg class="w-12 h-12 text-white mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                </svg>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <h4 class="text-xl font-semibold text-gray-900 mb-3 line-clamp-2">{{ $item->judul }}</h4>

                        <!-- Date and Time -->
                        <div class="flex items-center text-sm text-gray-500 mb-4 space-x-4">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ $item->created_at->format('d M Y') }}
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $item->created_at->format('H:i') }} WIB
                            </div>
                        </div>

                        <a href="{{ route('berita.show', $item->id) }}" class="inline-flex items-center text-green-600 hover:text-green-800 font-medium transition-colors">
                            Baca Selengkapnya
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Berita Pagination -->
        <div id="berita-pagination" class="mt-8 flex justify-center items-center space-x-2" style="display: none;">
            <button id="berita-prev" class="px-4 py-2 bg-gray-200 text-gray-600 rounded-lg hover:bg-gray-300 transition-colors disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Prev
            </button>

            <div id="berita-page-numbers" class="flex space-x-1"></div>

            <button id="berita-next" class="px-4 py-2 bg-cyan-500 text-white rounded-lg hover:bg-cyan-600 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                Next
                <svg class="w-4 h-4 inline ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>
        @else
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada berita</h3>
            <p class="mt-1 text-sm text-gray-500">Berita akan segera hadir.</p>
        </div>
        @endif
    </div>
</section>

<!-- Artikel Section -->
<section class="py-16 bg-gray-50">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Artikel</h2>
            <div class="w-20 h-1 bg-cyan-400 mx-auto"></div>
        </div>

        @if($artikel->count() > 0)
        <!-- Artikel Grid -->
        <div id="artikel-container">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="artikel-grid">
                @foreach($artikel as $item)
                <div class="artikel-item bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    <!-- Image -->
                    <div class="h-48 bg-gray-200 overflow-hidden">
                        @if($item->foto)
                        <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover">
                        @else
                        <div class="h-48 bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center">
                            <div class="text-center">
                                <svg class="w-12 h-12 text-white mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <h4 class="text-xl font-semibold text-gray-900 mb-3 line-clamp-2">{{ $item->judul }}</h4>

                        <!-- Date and Time -->
                        <div class="flex items-center text-sm text-gray-500 mb-4 space-x-4">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ $item->created_at->format('d M Y') }}
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $item->created_at->format('H:i') }} WIB
                            </div>
                        </div>

                        <a href="{{ route('berita.show', $item->id) }}" class="inline-flex items-center text-green-600 hover:text-green-800 font-medium transition-colors">
                            Baca Selengkapnya
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Artikel Pagination -->
        <div id="artikel-pagination" class="mt-8 flex justify-center items-center space-x-2" style="display: none;">
            <button id="artikel-prev" class="px-4 py-2 bg-gray-200 text-gray-600 rounded-lg hover:bg-gray-300 transition-colors disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Prev
            </button>

            <div id="artikel-page-numbers" class="flex space-x-1"></div>

            <button id="artikel-next" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                Next
                <svg class="w-4 h-4 inline ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>
        @else
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada artikel</h3>
            <p class="mt-1 text-sm text-gray-500">Artikel akan segera hadir.</p>
        </div>
        @endif
    </div>
</section>

<!-- CSS dan JavaScript -->
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .page-number {
        min-width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }

    .page-number.active {
        background-color: #06b6d4;
        color: white;
    }

    .page-number:not(.active) {
        background-color: #f3f4f6;
        color: #6b7280;
    }

    .page-number:not(.active):hover {
        background-color: #e5e7eb;
        color: #374151;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Pagination untuk Berita
        const beritaItems = document.querySelectorAll('.berita-item');
        const beritaPagination = document.getElementById('berita-pagination');
        const beritaPrev = document.getElementById('berita-prev');
        const beritaNext = document.getElementById('berita-next');
        const beritaPageNumbers = document.getElementById('berita-page-numbers');

        // Pagination untuk Artikel
        const artikelItems = document.querySelectorAll('.artikel-item');
        const artikelPagination = document.getElementById('artikel-pagination');
        const artikelPrev = document.getElementById('artikel-prev');
        const artikelNext = document.getElementById('artikel-next');
        const artikelPageNumbers = document.getElementById('artikel-page-numbers');

        const itemsPerPage = 6;

        function setupPagination(items, paginationElement, prevButton, nextButton, pageNumbersContainer, prefix) {
            if (items.length <= itemsPerPage) {
                return; // Tidak perlu pagination jika item <= 6
            }

            paginationElement.style.display = 'flex';

            const totalPages = Math.ceil(items.length / itemsPerPage);
            let currentPage = 1;

            function showPage(page) {
                items.forEach((item, index) => {
                    const startIndex = (page - 1) * itemsPerPage;
                    const endIndex = startIndex + itemsPerPage;

                    if (index >= startIndex && index < endIndex) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });

                // Update tombol prev/next
                prevButton.disabled = page === 1;
                nextButton.disabled = page === totalPages;

                // Update nomor halaman aktif
                document.querySelectorAll(`.${prefix}-page-number`).forEach((btn, index) => {
                    if (index + 1 === page) {
                        btn.classList.add('active');
                    } else {
                        btn.classList.remove('active');
                    }
                });
            }

            function createPageNumbers() {
                pageNumbersContainer.innerHTML = '';

                for (let i = 1; i <= totalPages; i++) {
                    const pageButton = document.createElement('button');
                    pageButton.textContent = i;
                    pageButton.className = `page-number ${prefix}-page-number`;

                    if (i === 1) {
                        pageButton.classList.add('active');
                    }

                    pageButton.addEventListener('click', () => {
                        currentPage = i;
                        showPage(currentPage);
                    });

                    pageNumbersContainer.appendChild(pageButton);
                }
            }

            // Event listeners untuk tombol prev/next
            prevButton.addEventListener('click', () => {
                if (currentPage > 1) {
                    currentPage--;
                    showPage(currentPage);
                }
            });

            nextButton.addEventListener('click', () => {
                if (currentPage < totalPages) {
                    currentPage++;
                    showPage(currentPage);
                }
            });

            // Inisialisasi
            createPageNumbers();
            showPage(1);
        }

        // Setup pagination untuk berita
        setupPagination(beritaItems, beritaPagination, beritaPrev, beritaNext, beritaPageNumbers, 'berita');

        // Setup pagination untuk artikel
        setupPagination(artikelItems, artikelPagination, artikelPrev, artikelNext, artikelPageNumbers, 'artikel');
    });
</script>

@endsection