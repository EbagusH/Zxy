@extends('layouts.app')

@section('title', 'Sambutan Kepala Dinas - Dinas Sosial Kabupaten Majalengka')

@section('header')
@include('layouts.components.header', ['page' => 'profil.sambutan'])
@endsection

@section('content')

<!-- Content Section -->
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content - Sambutan -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-lg p-8">
                @if($sambutan)
                <!-- Foto Kepala Dinas -->
                @if($sambutan->foto)
                <div class="mb-6 text-center">
                    <img src="{{ asset('storage/' . $sambutan->foto) }}"
                        alt="{{ $sambutan->nama_kepala_dinas }}"
                        class="w-full max-w-md mx-auto rounded-lg shadow-md">
                </div>
                @endif

                <!-- Nama dan Jabatan -->
                @if($sambutan->nama_kepala_dinas || $sambutan->jabatan)
                <div class="mb-8 text-center">
                    @if($sambutan->nama_kepala_dinas)
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">
                        {{ $sambutan->nama_kepala_dinas }}
                    </h3>
                    @endif
                    @if($sambutan->jabatan)
                    <p class="text-blue-600 font-medium text-lg">
                        {{ $sambutan->jabatan }}
                    </p>
                    @endif
                </div>
                @endif

                <!-- Isi Sambutan -->
                <div class="prose prose-lg max-w-none text-justify leading-relaxed">
                    {!! nl2br(e($sambutan->isi_sambutan)) !!}
                </div>
                @else
                <!-- Jika belum ada data sambutan -->
                <div class="text-center py-12">
                    <div class="mb-6">
                        <svg class="mx-auto h-24 w-24 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-medium text-gray-600 mb-2">Sambutan Kepala Dinas</h3>
                    <p class="text-gray-500">Informasi sambutan akan segera tersedia.</p>
                </div>
                @endif
            </div>
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