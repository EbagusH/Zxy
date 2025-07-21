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

<!-- Content Section -->
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Side - Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Berita Section -->
            <div class="space-y-6">
                <div class="text-center">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Berita</h2>
                    <div class="w-16 h-1 bg-cyan-500 mx-auto"></div>
                </div>
                <div class="bg-white rounded-lg shadow-md p-8">
                    <p class="text-gray-600 mb-6">Berita terbaru akan segera tersedia.</p>
                </div>
            </div>

            <!-- Artikel Section -->
            <div class="space-y-6">
                <div class="text-center">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Artikel</h2>
                    <div class="w-16 h-1 bg-cyan-500 mx-auto"></div>
                </div>
                <div class="bg-white rounded-lg shadow-md p-8">
                    <p class="text-gray-600 mb-6">Artikel terbaru akan segera tersedia.</p>
                </div>
            </div>
        </div>

        <!-- Right Side - Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Services Menu -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-6">Layanan</h3>
                <div class="space-y-3">
                    <a href="#" class="block p-3 bg-gray-50 hover:bg-cyan-50 rounded-lg transition-colors duration-200">
                        <span class="text-gray-700 hover:text-cyan-600">Bantuan Sosial</span>
                    </a>
                    <a href="#" class="block p-3 bg-gray-50 hover:bg-cyan-50 rounded-lg transition-colors duration-200">
                        <span class="text-gray-700 hover:text-cyan-600">Rehabilitasi Sosial</span>
                    </a>
                    <a href="#" class="block p-3 bg-gray-50 hover:bg-cyan-50 rounded-lg transition-colors duration-200">
                        <span class="text-gray-700 hover:text-cyan-600">Pemberdayaan Sosial</span>
                    </a>
                    <a href="#" class="block p-3 bg-gray-50 hover:bg-cyan-50 rounded-lg transition-colors duration-200">
                        <span class="text-gray-700 hover:text-cyan-600">Perlindungan Sosial</span>
                    </a>
                    <a href="#" class="block p-3 bg-gray-50 hover:bg-cyan-50 rounded-lg transition-colors duration-200">
                        <span class="text-gray-700 hover:text-cyan-600">Data Sosial</span>
                    </a>
                </div>
            </div>

            <!-- Information Section -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-6">Informasi</h3>
                <div class="space-y-3">
                    <a href="#" class="block p-3 bg-gray-50 hover:bg-cyan-50 rounded-lg transition-colors duration-200">
                        <span class="text-gray-700 hover:text-cyan-600">Berita</span>
                    </a>
                    <a href="#" class="block p-3 bg-gray-50 hover:bg-cyan-50 rounded-lg transition-colors duration-200">
                        <span class="text-gray-700 hover:text-cyan-600">Rumah Singgah</span>
                    </a>
                    <a href="#" class="block p-3 bg-gray-50 hover:bg-cyan-50 rounded-lg transition-colors duration-200">
                        <span class="text-gray-700 hover:text-cyan-600">Tentang Kami</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection