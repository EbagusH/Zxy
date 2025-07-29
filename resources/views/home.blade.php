@extends('layouts.app')

@section('title', 'Beranda - Dinas Sosial Kota Majalengka')

@section('header')
@include('layouts.components.header', ['page' => 'home'])
@endsection

@section('main-class', 'bg-gray-50')

@section('content')
<!-- Deskripsi -->
<section class="py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Rumah Singgah Kota Majalengka</h2>
            <div class="w-20 h-1 bg-cyan-400 mx-auto"></div>
        </div>

        <a href="{{ route('rumah-singgah') }}" class="block hover:shadow-xl transition-all duration-300 cursor-pointer">
            <div class="py-16 bg-white px-4 md:px-6 lg:px-8 rounded-lg">
                <div class="flex flex-col md:flex-row items-center gap-8">
                    <!-- Kolom Kiri: Deskripsi -->
                    <div class="md:w-1/2 text-gray-900 text-justify">
                        <p>
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
                    <!-- Kolom Kanan: Foto -->
                    <div class="md:w-1/2">
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
                </div>
            </div>
        </a>
    </div>
</section>

<!-- Layanan Informasi Publik Section -->
<section class="py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Layanan Informasi Publik</h2>
            <div class="w-20 h-1 bg-cyan-400 mx-auto"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Card 1 - LAPOR! -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                <div class="h-48 bg-gradient-to-br from-cyan-400 to-cyan-600 flex items-center justify-center">
                    <div class="text-center">
                        <div class="bg-white p-3 rounded-lg inline-block mb-4">
                            <svg class="w-8 h-8 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-2">LAPOR!</h3>
                        <p class="text-cyan-100 text-sm">LAYANAN ASPIRASI DAN PENGADUAN ONLINE RAKYAT</p>
                    </div>
                </div>
                <div class="p-6">
                    <h4 class="text-xl font-semibold text-gray-900 mb-2">Layanan Aspirasi dan Pengaduan Online Rakyat</h4>
                    <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Lihat Disini</a>
                </div>
            </div>

            {{-- Uncomment ketika data layanan sudah siap --}}
            {{-- @if(isset($layananTerbaru) && $layananTerbaru->count() > 0)
                @foreach($layananTerbaru as $layanan)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="h-48 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                        <div class="text-center">
                            <h3 class="text-2xl font-bold text-white mb-2">{{ $layanan->nama }}</h3>
            <p class="text-blue-100 text-sm">{{ $layanan->deskripsi_singkat }}</p>
        </div>
    </div>
    <div class="p-6">
        <h4 class="text-xl font-semibold text-gray-900 mb-2">{{ $layanan->judul }}</h4>
        <a href="{{ route('layanan.show', $layanan->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">Lihat Disini</a>
    </div>
    </div>
    @endforeach
    @endif --}}
    </div>
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
@endsection