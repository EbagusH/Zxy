@extends('layouts.app')

@section('title', 'Layanan - Dinas Sosial Kota Majalengka')

@section('content')
<!-- Hero Section with Background Image -->
<div class="relative h-96 bg-cover bg-center bg-no-repeat" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://i.ytimg.com/vi/aKeSm4BUFCk/maxresdefault.jpg');">
    <div class="absolute inset-0 flex items-center justify-center">
        <div class="text-center text-white">
            <h1 class="text-5xl font-bold mb-4">Layanan Kami</h1>
        </div>
    </div>
</div>

<!-- Content Section -->
<section class="py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
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
                    <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Ajukan Layanan</a>
                </div>
            </div>

            <!-- Card 2 - LHKPN -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                <div class="h-48 bg-gradient-to-br from-cyan-400 to-cyan-600 flex items-center justify-center">
                    <div class="text-center">
                        <div class="bg-white p-3 rounded-lg inline-block mb-4">
                            <svg class="w-8 h-8 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
                            </svg>
                        </div>
                        <div class="flex items-center justify-center space-x-2">
                            <span class="text-white font-bold">LHKPN</span>
                        </div>
                        <p class="text-cyan-100 text-sm mt-2">TRANSPARAN ITU MUDAH!</p>
                    </div>
                </div>
                <div class="p-6">
                    <h4 class="text-xl font-semibold text-gray-900 mb-2">Laporan Harta Kekayaan Pejabat</h4>
                    <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Ajukan Layanan</a>
                </div>
            </div>

            <!-- Card 3 - Permohonan Informasi Publik -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                <div class="h-48 bg-gradient-to-br from-cyan-400 to-cyan-600 flex items-center justify-center">
                    <div class="text-center">
                        <div class="bg-white p-3 rounded-lg inline-block mb-4">
                            <svg class="w-8 h-8 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                        </div>
                        <div class="flex items-center justify-center">
                            <div class="text-white px-3 py-2 rounded font-bold text-lg">PERMOHONAN INFORMASI PUBLIK</div>
                        </div>
                        <p class="text-cyan-100 text-sm mt-2">PEMERINTAH KOTA MAJALENGKA</p>
                    </div>
                </div>
                <div class="p-6">
                    <h4 class="text-xl font-semibold text-gray-900 mb-2">Permohonan Informasi Publik Online</h4>
                    <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Ajukan Layanan</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection