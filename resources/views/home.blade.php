@extends('layouts.app')

@section('title', 'Beranda - Dinas Sosial Kabupaten Majalengka')

@section('header')
@include('layouts.components.header', ['page' => 'home'])
@endsection

@section('main-class', 'bg-gray-50')

@section('content')
<!-- Rumah Singgah -->
<section class="py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Rumah Singgah Kabupaten Majalengka</h2>
            <div class="w-20 h-1 bg-cyan-400 mx-auto"></div>
        </div>

        <a href="{{ route('rumah-singgah') }}" class="block hover:shadow-xl transition-all duration-300 cursor-pointer">
            <div class="py-16 bg-white px-4 md:px-6 lg:px-8 rounded-lg">
                <div class="flex flex-col md:flex-row items-center gap-8">
                    <!-- Gambar - tampil pertama di mobile, kedua di desktop -->
                    <div class="w-full md:w-1/2 md:order-2">
                        @if($rumahSinggah && $rumahSinggah->gambar)
                        <img src="{{ asset('storage/' . $rumahSinggah->gambar) }}"
                            alt="Rumah Singgah HEGAR"
                            class="w-full h-64 object-cover rounded-lg">
                        @else
                        <div class="w-full h-64 bg-gray-200 flex items-center justify-center rounded-lg">
                            <span class="text-gray-500">Foto akan ditampilkan di sini</span>
                        </div>
                        @endif
                    </div>

                    <!-- Deskripsi - tampil kedua di mobile, pertama di desktop -->
                    <div class="w-full md:w-1/2 text-gray-900 text-justify md:order-1">
                        <p class="break-words overflow-wrap-anywhere word-break-break-word hyphens-auto">
                            @if($rumahSinggah && $rumahSinggah->isi)
                            {{ Str::limit($rumahSinggah->isi, 400) }}
                            @else
                            Informasi Rumah Singgah Akan Segera Tersedia...
                            @endif
                        </p>

                        <div class="mt-4 inline-flex items-center text-cyan-600 hover:text-cyan-800 font-medium">
                            Baca selengkapnya
                            <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</section>

<!-- Layanan Informasi Publik Section dengan Carousel -->
<section class="py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Layanan Informasi Publik</h2>
            <div class="w-20 h-1 bg-cyan-400 mx-auto"></div>
        </div>

        @if(isset($layananTerbaru) && $layananTerbaru->count() > 0)
        <!-- Carousel Container -->
        <div class="relative overflow-hidden">
            <div id="layanan-carousel" class="flex transition-transform duration-500 ease-in-out">
                @php
                $chunks = $layananTerbaru->chunk(3); // Bagi data menjadi grup 3
                @endphp

                @foreach($chunks as $chunkIndex => $chunk)
                <div class="w-full flex-shrink-0">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($chunk as $layanan)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                            <div class="h-48 bg-gradient-to-br from-cyan-400 to-cyan-600 flex items-center justify-center overflow-hidden">
                                @if($layanan->foto)
                                <img src="{{ asset('storage/' . $layanan->foto) }}"
                                    alt="{{ $layanan->nama }}"
                                    class="w-full h-full object-cover">
                                @else
                                <div class="text-center">
                                    <div class="bg-white p-3 rounded-lg inline-block mb-4">
                                        <svg class="w-8 h-8 text-cyan-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold text-white mb-2">{{ $layanan->nama }}</h3>
                                    <p class="text-cyan-100 text-sm">{{ strtoupper($layanan->bidang) }}</p>
                                </div>
                                @endif
                            </div>
                            <div class="p-6">
                                <div class="text-sm font-semibold text-cyan-600 mb-2">{{ strtoupper($layanan->bidang) }}</div>
                                <h4 class="text-xl font-semibold text-gray-900 mb-4">{{ $layanan->nama }}</h4>
                                <a href="{{ route('layanan') }}" class="text-blue-600 hover:text-blue-800 font-medium">Lihat Detail</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Navigation Dots (jika ada lebih dari 1 slide) -->
            @if($chunks->count() > 1)
            <div class="flex justify-center mt-8 space-x-2">
                @foreach($chunks as $index => $chunk)
                <button onclick="goToSlide({ $index })" class="w-3 h-3 rounded-full transition-colors dot {{ $index === 0 ? 'bg-cyan-600' : 'bg-gray-300' }}"></button>
                @endforeach
            </div>
            @endif
        </div>

        @else
        <!-- Default Card jika tidak ada layanan -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Card -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                <div class="h-64 bg-gray-300 flex items-center justify-center">
                    <div class="text-center text-gray-500">
                        <div class="text-gray-400 text-6xl font-light mb-4">848 x 590</div>
                        <p>Tidak ada gambar</p>
                    </div>
                </div>
                <div class="p-6">
                    <div class="text-black font-bold mb-4 uppercase text-sm">LAYANAN</div>
                    <h4 class="text-xl font-bold text-black mb-4">Tidak Ada Layanan yang Tersedia</h4>
                    <p class="text-gray-600">Layanan akan segera tersedia</p>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Artikel dan Berita Section -->
<section class="py-16 bg-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Berita dan Artikel</h2>
            <div class="w-20 h-1 bg-cyan-400 mx-auto"></div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Berita Card -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                @if($beritaTerbaru->count() > 0)
                @php $berita = $beritaTerbaru->first(); @endphp
                <div class="h-64 bg-gray-200 flex items-center justify-center overflow-hidden">
                    @if($berita->foto)
                    <img src="{{ asset('storage/' . $berita->foto) }}"
                        alt="{{ $berita->judul }}"
                        class="w-full h-full object-cover">
                    @else
                    <div class="text-center text-gray-500">
                        <div class="text-gray-400 text-6xl font-light mb-4">848 x 590</div>
                        <p>Tidak ada gambar</p>
                    </div>
                    @endif
                </div>
                @else
                <div class="h-64 bg-gray-300 flex items-center justify-center">
                    <div class="text-center text-gray-500">
                        <div class="text-gray-400 text-6xl font-light mb-4">848 x 590</div>
                        <p>Tidak ada gambar</p>
                    </div>
                </div>
                @endif
                <div class="p-6">
                    @if($beritaTerbaru->count() > 0)
                    <div class="text-black font-bold mb-4 uppercase text-sm">{{ $berita->kategori }}</div>
                    <h4 class="text-xl font-bold text-black mb-4">{{ $berita->judul }}</h4>
                    <a href="{{ route('berita.show', $berita->id) }}" class="inline-flex items-center text-green-600 hover:text-green-800 font-medium transition-colors">
                        Baca Selengkapnya
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                    @else
                    <div class="text-black font-semibold mb-2 uppercase text-sm">BERITA</div>
                    <h4 class="text-xl font-bold text-black mb-4">Tidak Ada Berita yang Tersedia</h4>
                    <p class="text-gray-600">Tidak ada berita yang tersedia saat ini</p>
                    @endif
                </div>
            </div>

            <!-- Artikel Card -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                @if($artikelTerbaru->count() > 0)
                @php $artikel = $artikelTerbaru->first(); @endphp
                <div class="h-64 bg-gray-200 flex items-center justify-center overflow-hidden">
                    @if($artikel->foto)
                    <img src="{{ asset('storage/' . $artikel->foto) }}"
                        alt="{{ $artikel->judul }}"
                        class="w-full h-full object-cover">
                    @else
                    <div class="text-center text-gray-500">
                        <div class="text-gray-400 text-6xl font-light mb-4">848 x 590</div>
                        <p>Tidak ada gambar</p>
                    </div>
                    @endif
                </div>
                @else
                <div class="h-64 bg-gray-300 flex items-center justify-center">
                    <div class="text-center text-gray-500">
                        <div class="text-gray-400 text-6xl font-light mb-4">848 x 590</div>
                        <p>Tidak ada gambar</p>
                    </div>
                </div>
                @endif
                <div class="p-6">
                    @if($artikelTerbaru->count() > 0)
                    <div class="text-black font-bold mb-4 uppercase">{{ $artikel->kategori }}</div>
                    <h4 class="text-xl font-bold text-black mb-4">{{ $artikel->judul }}</h4>
                    <a href="{{ route('berita.show', $artikel->id) }}" class="inline-flex items-center text-green-600 hover:text-green-800 font-medium transition-colors">
                        Baca Selengkapnya
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                    @else
                    <div class="text-black font-semibold mb-2 uppercase text-sm">ARTIKEL</div>
                    <h4 class="text-xl font-bold text-black mb-4">Tidak Ada Artikel yang Tersedia</h4>
                    <p class="text-gray-600">Tidak ada artikel yang tersedia saat ini</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- JavaScript untuk Carousel -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const carousel = document.getElementById('layanan-carousel');
        const dots = document.querySelectorAll('.dot');
        let currentSlide = 0;
        const totalSlides = dots.length;

        // Fungsi untuk pindah ke slide tertentu
        window.goToSlide = function(slideIndex) {
            currentSlide = slideIndex;
            const translateX = -slideIndex * 100;
            carousel.style.transform = `translateX(${translateX}%)`;

            // Update dots
            dots.forEach((dot, index) => {
                if (index === slideIndex) {
                    dot.classList.remove('bg-gray-300');
                    dot.classList.add('bg-cyan-600');
                } else {
                    dot.classList.remove('bg-cyan-600');
                    dot.classList.add('bg-gray-300');
                }
            });
        };

        // Auto-slide functionality
        if (totalSlides > 1) {
            setInterval(() => {
                currentSlide = (currentSlide + 1) % totalSlides;
                goToSlide(currentSlide);
            }, 5000); // Ganti slide setiap 5 detik
        }
    });
</script>
@endsection