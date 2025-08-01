@extends('layouts.app')

@section('title', 'Bidang Resos - Dinas Sosial Kota Majalengka')

@section('header')
@include('layouts.components.header', ['page' => 'profil.resos'])
@endsection

@section('content')

<!-- Content Section -->
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <!-- Photo Section -->
                @if($resos && $resos->foto)
                <div class="px-6 py-6">
                    <div class="relative">
                        <img src="{{ asset('storage/' . $resos->foto) }}"
                            alt="Bidang Resos"
                            class="w-full h-64 md:h-80 object-cover rounded-lg shadow-md">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-lg"></div>
                    </div>
                </div>
                @endif

                <!-- Content Section -->
                <div class="px-6 pb-8">
                    @if($resos && $resos->isi)
                    <div class="prose prose-lg max-w-none">
                        <div class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $resos->isi }}</div>
                    </div>
                    @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-24 w-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Informasi Belum Tersedia</h3>
                        <p class="text-gray-500">Informasi tentang Bidang Resos sedang dalam proses penyusunan.</p>
                    </div>
                    @endif
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

                        <div class="flex space-x-3 hover:bg-gray-50 p-2 rounded transition-colors duration-200">
                            <div class="flex-shrink-0">

                                <img src="#"
                                    alt="#"
                                    class="w-16 h-12 object-cover rounded">

                                <div class="w-16 h-12 bg-gradient-to-br from-blue-400 to-blue-600 rounded flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                    </svg>
                                </div>

                            </div>
                            <div class="flex-1 min-w-0">
                                <a href="" class="block">
                                    <h4 class="text-sm font-medium text-gray-900 line-clamp-2 hover:text-blue-600 transition-colors duration-200">

                                    </h4>
                                    <p class="text-xs text-gray-500 mt-1">

                                    </p>
                                </a>
                            </div>
                        </div>

                        <div class="text-gray-500 text-sm">
                            Belum ada berita terbaru
                        </div>

                    </div>
                </div>

                <!-- Artikel Terbaru -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 border-b border-gray-200 pb-2">
                        Artikel Terbaru
                    </h3>
                    <div class="space-y-4">

                        <div class="flex space-x-3 hover:bg-gray-50 p-2 rounded transition-colors duration-200">
                            <div class="flex-shrink-0">

                                <img src="#"
                                    alt="#"
                                    class="w-16 h-12 object-cover rounded">

                                <div class="w-16 h-12 bg-gradient-to-br from-green-400 to-green-600 rounded flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>

                            </div>
                            <div class="flex-1 min-w-0">
                                <a href="#" class="block">
                                    <h4 class="text-sm font-medium text-gray-900 line-clamp-2 hover:text-green-600 transition-colors duration-200">

                                    </h4>
                                    <p class="text-xs text-gray-500 mt-1">

                                    </p>
                                </a>
                            </div>
                        </div>

                        <div class="text-gray-500 text-sm">
                            Belum ada artikel terbaru
                        </div>

                    </div>
                </div>

                <!-- Layanan -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 border-b border-gray-200 pb-2">
                        Layanan
                    </h3>
                    <div class="space-y-3">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection