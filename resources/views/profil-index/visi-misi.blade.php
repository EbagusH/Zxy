@extends('layouts.app')

@section('title', 'Visi dan Misi - Dinas Sosial Kabupaten Majalengka')

@section('header')
@include('layouts.components.header', ['page' => 'profil.visi-misi'])
@endsection

@section('content')

<!-- Content Section -->
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            @if($visiMisi)
            <!-- Content -->
            <div class="space-y-8">
                <!-- Gambar (jika ada) -->
                @if($visiMisi->gambar)
                <div class="text-center">
                    <img src="{{ asset('storage/' . $visiMisi->gambar) }}" alt="Gambar Visi Misi" class="max-w-2xl w-full h-auto rounded-lg shadow-lg mx-auto">
                </div>
                @endif

                <!-- Sejarah -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        Sejarah Dinas Sosial Kabupaten Majalengka
                    </h3>
                    <div class="text-gray-700 leading-relaxed whitespace-pre-line">
                        {{ $visiMisi->sejarah ?: 'Sejarah singkat belum tersedia.' }}
                    </div>
                </div>

                <!-- Visi -->
                <div class="bg-blue-50 rounded-lg p-6">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        Visi Dinas Sosial Kabupaten Majalengka
                    </h3>
                    <div class="text-gray-700 leading-relaxed whitespace-pre-line text-lg italic">
                        {{ $visiMisi->visi ?: 'Visi belum tersedia.' }}
                    </div>
                </div>

                <!-- Misi -->
                <div class="bg-green-50 rounded-lg p-6">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                        Misi Dinas Sosial Kabupaten Majalengka
                    </h3>
                    <div class="text-gray-700 leading-relaxed whitespace-pre-line">
                        {{ $visiMisi->misi ?: 'Misi belum tersedia.' }}
                    </div>
                </div>
            </div>
            @else
            <!-- Jika data tidak ada -->
            <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Data Visi dan Misi Belum Tersedia</h3>
                <p class="text-gray-500">Informasi visi dan misi sedang dalam proses pembaruan.</p>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="sticky top-6 space-y-6">
                <!-- Berita Terkini -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 border-b border-gray-200 pb-2">
                        Berita Terkini
                    </h3>
                    <div class="space-y-4">
                        @if($beritaTerbaru->count() > 0)
                        @foreach($beritaTerbaru as $berita)
                        <div class="flex space-x-3 hover:bg-gray-50 p-2 rounded transition-colors duration-200">
                            <div class="flex-shrink-0">
                                @if($berita->foto)
                                <img src="{{ asset('storage/' . $berita->foto) }}"
                                    alt="{{ $berita->judul }}"
                                    class="w-16 h-12 object-cover rounded">
                                @else
                                <div class="w-16 h-12 bg-gradient-to-br from-blue-400 to-blue-600 rounded flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                    </svg>
                                </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <a href="{{ route('berita.show', $berita->id) }}" class="block">
                                    <h4 class="text-sm font-medium text-gray-900 line-clamp-2 hover:text-blue-600 transition-colors duration-200">
                                        {{ $berita->judul }}
                                    </h4>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $berita->created_at->diffForHumans() }}
                                    </p>
                                </a>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="text-gray-500 text-sm">
                            Belum ada berita terbaru
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Artikel Terbaru -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 border-b border-gray-200 pb-2">
                        Artikel Terbaru
                    </h3>
                    <div class="space-y-4">
                        @if($artikelTerbaru->count() > 0)
                        @foreach($artikelTerbaru as $artikel)
                        <div class="flex space-x-3 hover:bg-gray-50 p-2 rounded transition-colors duration-200">
                            <div class="flex-shrink-0">
                                @if($artikel->foto)
                                <img src="{{ asset('storage/' . $artikel->foto) }}"
                                    alt="{{ $artikel->judul }}"
                                    class="w-16 h-12 object-cover rounded">
                                @else
                                <div class="w-16 h-12 bg-gradient-to-br from-green-400 to-green-600 rounded flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <a href="{{ route('berita.show', $artikel->id) }}" class="block">
                                    <h4 class="text-sm font-medium text-gray-900 line-clamp-2 hover:text-green-600 transition-colors duration-200">
                                        {{ $artikel->judul }}
                                    </h4>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $artikel->created_at->diffForHumans() }}
                                    </p>
                                </a>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="text-gray-500 text-sm">
                            Belum ada artikel terbaru
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Layanan -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 border-b border-gray-200 pb-2">
                        Layanan Terbaru
                    </h3>
                    <div class="space-y-3">
                        @foreach ($layananTerbaru as $layanan)
                        <a href="{{ route('layanan.show', $layanan->id) }}" class="flex items-center text-blue-600 hover:text-blue-800 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                            {{ $layanan->nama }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection