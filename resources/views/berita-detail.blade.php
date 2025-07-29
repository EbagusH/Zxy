@extends('layouts.app')

@section('title', $berita->judul . ' - Dinas Sosial Kota Majalengka')

@section('header')
@include('layouts.components.header', ['page' => 'berita.show'])
@endsection

@section('content')
<!-- Hero Section with Background Image -->
<!-- <div class="relative h-96 bg-cover bg-center bg-no-repeat" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://i.ytimg.com/vi/aKeSm4BUFCk/maxresdefault.jpg');">
    <div class="absolute inset-0 flex items-center justify-center">
        <div class="text-center text-white">
            <h1 class="text-5xl font-bold mb-4">Detail Berita dan Artikel</h1> -->
<!-- Breadcrumb -->
<!-- <div>
                <a href="{{ route('home') }}" class="hover:underline text-white">Beranda</a>
                <span class="text-white">|</span>
                <a href="{{ route('berita') }}" class="hover:underline text-white">Berita</a>
                <span class="text-white">|</span>
                <span class="text-orange-400 font-medium">{{ $berita->judul }}</span>
            </div>
        </div>
    </div>
</div> -->

<div class="py-16 bg-gray-50">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Main Content Area -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">

                    <!-- Featured Image -->
                    @if($berita->foto)
                    <div class="relative h-64 sm:h-80 md:h-96">
                        <img src="{{ asset('storage/' . $berita->foto) }}"
                            alt="{{ $berita->judul }}"
                            class="w-full h-full object-cover"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                        <!-- Fallback jika gambar tidak ditemukan -->
                        <div class="absolute inset-0 bg-gray-200 flex items-center justify-center" style="display: none;">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    @else
                    <!-- Placeholder jika tidak ada gambar -->
                    <div class="relative h-64 sm:h-80 md:h-96 bg-gray-200 flex items-center justify-center">
                        <div class="text-center">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-gray-500 text-sm">Tidak ada gambar</p>
                        </div>
                    </div>
                    @endif

                    <!-- Article Content -->
                    <div class="p-8">
                        <!-- Category Badge -->
                        <div class="mb-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $berita->kategori === 'berita' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                {{ ucfirst($berita->kategori) }}
                            </span>
                        </div>

                        <!-- Title -->
                        <h1 class="text-3xl font-bold text-gray-900 mb-4 leading-tight">{{ $berita->judul }}</h1>

                        <!-- Date and Time -->
                        <div class="flex items-center text-sm text-gray-500 mb-6 pb-4 border-b border-gray-200">
                            <div class="flex items-center mr-6">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>{{ $berita->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>{{ $berita->created_at->format('H:i') }} WIB</span>
                            </div>
                        </div>

                        <!-- Article Content -->
                        <div class="text-gray-700 leading-relaxed text-base">
                            <div class="break-words">
                                {!! nl2br(e($berita->isi)) !!}
                            </div>
                        </div>

                        <!-- Share Buttons -->
                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <span class="text-sm font-medium text-gray-600">Bagikan:</span>

                                    <!-- Twitter Share -->
                                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($berita->judul) }}&url={{ urlencode(request()->url()) }}"
                                        target="_blank"
                                        class="text-blue-600 hover:text-blue-800 transition-colors duration-200"
                                        title="Bagikan ke Twitter">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                                        </svg>
                                    </a>

                                    <!-- Facebook Share -->
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                                        target="_blank"
                                        class="text-blue-800 hover:text-blue-900 transition-colors duration-200"
                                        title="Bagikan ke Facebook">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                        </svg>
                                    </a>

                                    <!-- WhatsApp Share -->
                                    <a href="#" onclick="shareToWhatsapp()" class="text-green-600 hover:text-green-800" title="Bagikan ke WhatsApp">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488" />
                                        </svg>
                                    </a>

                                    <!-- <button onclick="window.print()" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                        Cetak / Simpan PDF
                                    </button> -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sticky Sidebar -->
            <div class="lg:col-span-1">
                <div class="sticky top-6 space-y-6">
                    @php
                    // Tentukan kategori saat ini
                    $currentCategory = $berita->kategori;
                    $isBerita = $currentCategory === 'berita';

                    // Ambil konten terbaru dari kategori yang sama, kecuali yang sedang dibaca
                    $latestContent = \App\Models\Berita::where('id', '!=', $berita->id)
                    ->where('kategori', $currentCategory)
                    ->latest()
                    ->take(5)
                    ->get();
                    @endphp

                    <!-- Latest Content by Category -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="px-6 py-4 {{ $isBerita ? 'bg-blue-600' : 'bg-green-600' }}">
                            <h3 class="text-lg font-semibold text-white">
                                {{ $isBerita ? 'Berita Terbaru' : 'Artikel Terbaru' }}
                            </h3>
                        </div>

                        <div class="divide-y divide-gray-200">
                            @if($latestContent->count() > 0)
                            @foreach($latestContent as $item)
                            <div class="p-4 hover:bg-gray-50 transition-colors duration-200">
                                <div class="flex space-x-3">
                                    <div class="flex-shrink-0">
                                        @if($item->foto)
                                        <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}" class="w-16 h-12 object-cover rounded">
                                        @else
                                        <div class="w-16 h-12 {{ $isBerita ? 'bg-gradient-to-br from-blue-400 to-blue-600' : 'bg-gradient-to-br from-green-400 to-green-600' }} rounded flex items-center justify-center">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                @if($isBerita)
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                                @else
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                @endif
                                            </svg>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <a href="{{ route('berita.show', $item->id) }}" class="block">
                                            <h4 class="text-sm font-medium text-gray-900 line-clamp-2 hover:{{ $isBerita ? 'text-blue-600' : 'text-green-600' }} transition-colors duration-200">
                                                {{ $item->judul }}
                                            </h4>
                                            <p class="text-xs text-gray-500 mt-1">
                                                {{ $item->created_at->diffForHumans() }}
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div class="p-4 text-center text-gray-500">
                                <p class="text-sm">Tidak ada {{ $isBerita ? 'berita' : 'artikel' }} lainnya</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Layanan Sidebar -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="px-6 py-4 {{ $isBerita ? 'bg-blue-600' : 'bg-green-600' }}">
                            <h3 class="text-lg font-semibold text-white">
                                Layanan
                            </h3>
                        </div>

                        <!-- <div class="divide-y divide-gray-200">
                            @if($latestContent->count() > 0)
                            @foreach($latestContent as $item)
                            <div class="p-4 hover:bg-gray-50 transition-colors duration-200">
                                <div class="flex space-x-3">
                                    <div class="flex-shrink-0">
                                        @if($item->foto)
                                        <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}" class="w-16 h-12 object-cover rounded">
                                        @else
                                        <div class="w-16 h-12 {{ $isBerita ? 'bg-gradient-to-br from-blue-400 to-blue-600' : 'bg-gradient-to-br from-green-400 to-green-600' }} rounded flex items-center justify-center">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                @if($isBerita)
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                                @else
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                @endif
                                            </svg>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <a href="{{ route('berita.show', $item->id) }}" class="block">
                                            <h4 class="text-sm font-medium text-gray-900 line-clamp-2 hover:{{ $isBerita ? 'text-blue-600' : 'text-green-600' }} transition-colors duration-200">
                                                {{ $item->judul }}
                                            </h4>
                                            <p class="text-xs text-gray-500 mt-1">
                                                {{ $item->created_at->diffForHumans() }}
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div class="p-4 text-center text-gray-500">
                                <p class="text-sm">Tidak ada {{ $isBerita ? 'berita' : 'artikel' }} lainnya</p>
                            </div>
                            @endif
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function shareToWhatsapp() {
        const text = encodeURIComponent("{{ $berita->judul }} - {{ request()->url() }}");

        // Deteksi apakah perangkat adalah mobile
        const isMobile = /Android|iPhone|iPad|iPod|Windows Phone/i.test(navigator.userAgent);

        // Link WhatsApp sesuai perangkat
        const link = isMobile ?
            `https://api.whatsapp.com/send?text=${text}` :
            `https://web.whatsapp.com/send?text=${text}`;

        // Buka link di tab baru
        window.open(link, '_blank');
    }
</script>

@endsection