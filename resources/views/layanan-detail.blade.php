@extends('layouts.app')

@section('title', 'Detail Layanan - Dinas Sosial Kabupaten Majalengka')

@section('header')
@include('layouts.components.header', ['page' => 'layanan.show'])
@endsection

@section('content')

<!-- Content Section -->
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-lg p-8">

                <!-- Gambar Layanan -->
                <div class="mb-6 text-center">
                    @if($layanan->foto)
                    <img src="{{ asset('storage/' . $layanan->foto) }}"
                        alt="{{ $layanan->nama }}"
                        class="w-full mx-auto rounded-lg shadow-md border border-gray-200">
                    @else
                    <div class="w-full h-64 bg-gray-200 rounded-lg shadow-md border border-gray-200 flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    @endif
                </div>

                <!-- Detail Layanan -->
                <div class="space-y-4">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600">Nama Layanan:</p>
                                <p class="font-medium text-gray-800">{{ $layanan->nama }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Bidang:</p>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($layanan->bidang == 'Linjamsos') bg-blue-100 text-blue-800
                                    @elseif($layanan->bidang == 'Dayasos') bg-green-100 text-green-800
                                    @else bg-purple-100 text-purple-800 @endif">
                                    {{ $layanan->bidang }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

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

                <!-- Layanan Terbaru -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 border-b border-gray-200 pb-2">
                        Layanan Terbaru
                    </h3>
                    <div class="space-y-3">
                        @forelse($layananTerbaru as $item)
                        <a href="{{ route('layanan.show', $item->id) }}"
                            class="flex items-center p-2 hover:bg-gray-50 rounded transition-colors duration-200 
                                      {{ $item->id == $layanan->id ? 'bg-blue-50 border-l-4 border-blue-500' : '' }}">
                            <div class="flex-shrink-0 mr-3">
                                <div class="w-2 h-2 rounded-full 
                                        @if($item->bidang == 'Linjamsos') bg-blue-500
                                        @elseif($item->bidang == 'Dayasos') bg-green-500
                                        @else bg-purple-500 @endif">
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-medium text-gray-900 line-clamp-2 
                                              {{ $item->id == $layanan->id ? 'text-blue-700' : 'hover:text-blue-600' }} 
                                              transition-colors duration-200">
                                    {{ $item->nama }}
                                </h4>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $item->bidang }} • {{ $item->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <div class="flex-shrink-0">
                                <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </a>
                        @empty
                        <div class="text-gray-500 text-sm text-center py-4">
                            Belum ada layanan tersedia
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection