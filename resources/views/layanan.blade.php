@extends('layouts.app')

@section('title', 'Layanan - Dinas Sosial Kota Majalengka')

@section('header')
@include('layouts.components.header', ['page' => 'layanan'])
@endsection

@section('content')
<!-- Content Section -->
<section class="py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Page Title -->
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Layanan Dinas Sosial</h2>
            <p class="text-lg text-gray-600">Berbagai layanan yang tersedia untuk masyarakat Kota Majalengka</p>
        </div>

        <!-- Search and Filter Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Live Search -->
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text"
                        id="searchInput"
                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Cari layanan...">
                </div>

                <!-- Filter by Bidang -->
                <div>
                    <select id="bidangFilter"
                        class="block w-full px-3 py-2 border border-gray-300 rounded-md leading-5 bg-white focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="">Semua Bidang</option>
                        <option value="Linjamsos">Linjamsos</option>
                        <option value="Dayasos">Dayasos</option>
                        <option value="Resos">Resos</option>
                    </select>
                </div>
            </div>

            <!-- Results Info -->
            <div class="mt-4 text-sm text-gray-600">
                Menampilkan <span id="resultCount">{{ $layanan->count() }}</span> dari {{ $layanan->count() }} layanan
            </div>
        </div>

        <!-- Services Grid -->
        <div id="layananGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @forelse($layanan as $item)
            <div class="layanan-card bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1"
                data-nama="{{ strtolower($item->nama) }}"
                data-bidang="{{ $item->bidang }}">

                <!-- Service Image -->
                <div class="h-48 relative overflow-hidden">
                    @if($item->foto)
                    <img src="{{ asset('storage/' . $item->foto) }}"
                        alt="{{ $item->nama }}"
                        class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full bg-gradient-to-br 
                            @if($item->bidang == 'Linjamsos') from-blue-400 to-blue-600
                            @elseif($item->bidang == 'Dayasos') from-green-400 to-green-600
                            @elseif($item->bidang == 'Resos') from-purple-400 to-purple-600
                            @else from-gray-400 to-gray-600
                            @endif 
                            flex items-center justify-center">
                        <div class="bg-white p-4 rounded-full">
                            @if($item->bidang == 'Linjamsos')
                            <svg class="w-12 h-12 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V7l-4-4zm-5 16c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3zm3-10H5V7h10v2z" />
                            </svg>
                            @elseif($item->bidang == 'Dayasos')
                            <svg class="w-12 h-12 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M16 4c0-1.11.89-2 2-2s2 .89 2 2-.89 2-2 2-2-.89-2-2zM4 18v-6h2.5l6-6v4l6 6H4z" />
                            </svg>
                            @elseif($item->bidang == 'Resos')
                            <svg class="w-12 h-12 text-purple-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z" />
                            </svg>
                            @else
                            <svg class="w-12 h-12 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z" />
                            </svg>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Badge for Bidang -->
                    <div class="absolute top-3 right-3">
                        <span class="px-3 py-1 text-xs font-semibold text-white rounded-full
                            @if($item->bidang == 'Linjamsos') bg-blue-500
                            @elseif($item->bidang == 'Dayasos') bg-green-500
                            @elseif($item->bidang == 'Resos') bg-purple-500
                            @else bg-gray-500
                            @endif">
                            {{ $item->bidang }}
                        </span>
                    </div>
                </div>

                <!-- Service Content -->
                <div class="p-6">
                    <h4 class="text-xl font-semibold text-gray-900 mb-3 line-clamp-2">{{ $item->nama }}</h4>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <span class="text-sm font-medium 
                                @if($item->bidang == 'Linjamsos') text-blue-600 bg-blue-50
                                @elseif($item->bidang == 'Dayasos') text-green-600 bg-green-50
                                @elseif($item->bidang == 'Resos') text-purple-600 bg-purple-50
                                @else text-gray-600 bg-gray-50
                                @endif 
                                px-3 py-1 rounded-full">
                                Bidang {{ $item->bidang }}
                            </span>
                        </div>
                        <button class="text-blue-600 hover:text-blue-800 font-medium transition-colors flex items-center space-x-1">
                            <span>Detail</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <!-- Empty State -->
            <div id="emptyState" class="col-span-full text-center py-12">
                <div class="bg-gray-50 rounded-lg p-8">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada layanan tersedia</h3>
                    <p class="text-gray-500">Layanan akan segera ditambahkan. Silakan kembali lagi nanti.</p>
                </div>
            </div>
            @endforelse
        </div>

        <!-- No Results State (Hidden by default) -->
        <div id="noResultsState" class="hidden text-center py-12">
            <div class="bg-gray-50 rounded-lg p-8">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada layanan ditemukan</h3>
                <p class="text-gray-500">Coba ubah kata kunci pencarian atau filter bidang Anda.</p>
            </div>
        </div>
    </div>
</section>

<!-- JavaScript for Live Search and Filter -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const bidangFilter = document.getElementById('bidangFilter');
        const layananCards = document.querySelectorAll('.layanan-card');
        const resultCount = document.getElementById('resultCount');
        const layananGrid = document.getElementById('layananGrid');
        const noResultsState = document.getElementById('noResultsState');
        const emptyState = document.getElementById('emptyState');

        function filterLayanan() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            const selectedBidang = bidangFilter.value;
            let visibleCount = 0;

            layananCards.forEach(card => {
                const nama = card.getAttribute('data-nama');
                const bidang = card.getAttribute('data-bidang');

                const matchesSearch = nama.includes(searchTerm);
                const matchesBidang = selectedBidang === '' || bidang === selectedBidang;

                if (matchesSearch && matchesBidang) {
                    card.style.display = 'block';
                    card.classList.add('animate-fadeIn');
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                    card.classList.remove('animate-fadeIn');
                }
            });

            // Update result count
            resultCount.textContent = visibleCount;

            // Show/hide no results state
            if (visibleCount === 0 && layananCards.length > 0) {
                noResultsState.classList.remove('hidden');
                if (emptyState) emptyState.style.display = 'none';
            } else {
                noResultsState.classList.add('hidden');
                if (emptyState && layananCards.length === 0) emptyState.style.display = 'block';
            }
        }

        // Event listeners
        searchInput.addEventListener('input', filterLayanan);
        bidangFilter.addEventListener('change', filterLayanan);

        // Clear filters function
        window.clearFilters = function() {
            searchInput.value = '';
            bidangFilter.value = '';
            filterLayanan();
        }
    });
</script>

<!-- Custom CSS for animations -->
<style>
    .animate-fadeIn {
        animation: fadeIn 0.3s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Hover effects */
    .layanan-card:hover {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    /* Focus styles for accessibility */
    #searchInput:focus,
    #bidangFilter:focus {
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
</style>
@endsection