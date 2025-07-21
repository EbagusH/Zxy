@extends('layouts.app')

@section('title', 'Beranda - Dinas Sosial Kota Majalengka')

@section('header')
@include('layouts.components.header')
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
        <div class="py-16 bg-white px-4 md:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center gap-8">
                <!-- Kolom Kiri: Deskripsi -->
                <div class="md:w-1/2 text-gray-900 text-justify">
                    <p>
                        Rumah Singgah HEGAR merupakan bentuk komitmen pemerintah daerah untuk menciptakan lingkungan yang lebih humanis,
                        tanggap terhadap kebutuhan sosial, dan berorientasi pada kesejahteraan masyarakat.
                        Dengan hadirnya Rumah Singgah HEGAR, diharapkan bahwa tidak ada lagi individu yang kehilangan arah tanpa dukungan yang memadai.
                        Rumah singgah ini menjadi bukti nyata bahwa Majalengka terus bergerak maju, menghadirkan solusi bagi masyarakat yang membutuhkan,
                        serta membangun sistem perlindungan sosial yang lebih kuat menuju Majalengka Langkung SAE.
                    </p>
                </div>
                <!-- Kolom Kanan: Foto -->
                <div class="md:w-1/2">
                    <div class="w-full h-64 bg-gray-200 flex items-center justify-center rounded-lg">
                        <span class="text-gray-500">Foto akan ditampilkan di sini</span>
                    </div>
                </div>
            </div>
        </div>
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
                    <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Lihat Disini</a>
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
                    <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Lihat Disini</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Artikel dan Berita Section -->
<section class="py-16 bg-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Artikel dan Berita</h2>
            <div class="w-20 h-1 bg-cyan-400 mx-auto"></div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Berita Card -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                <div class="h-64 bg-gray-800 flex items-center justify-center relative">
                    <div class="text-center text-white">
                        <div class="text-gray-600 text-6xl font-light mb-4">848 x 590</div>
                    </div>
                    <div class="absolute bottom-4 left-4 right-4">
                        <h3 class="text-white font-bold text-lg mb-2">Tidak Ada Artikel yang Tersedia</h3>
                        <p class="text-blue-400 text-sm">Tidak ada Berita yang tersedia saat ini</p>
                    </div>
                </div>
                <div class="p-6">
                    <div class="text-blue-600 font-semibold mb-2">Dinas Sosial Kota Majalengka</div>
                    <h4 class="text-2xl font-bold text-blue-600 mb-4">Berita</h4>
                    <p class="text-gray-600">Jelajahi berita terkini dengan mengklik gambar di atas. Kami mengundang Anda</p>
                </div>
            </div>

            <!-- Artikel Card -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                <div class="h-64 bg-gray-300 flex items-center justify-center relative">
                    <div class="text-center text-gray-500">
                        <div class="text-gray-400 text-6xl font-light mb-4">848 x 590</div>
                    </div>
                    <div class="absolute bottom-2 right-2 text-xs text-gray-400">
                        Powered by HTML5.CM
                    </div>
                </div>
                <div class="p-6">
                    <div class="text-blue-600 font-semibold mb-2">Dinas Sosial Kota Majalengka</div>
                    <h4 class="text-2xl font-bold text-blue-600 mb-4">Artikel</h4>
                    <p class="text-gray-600">Temukan artikel terbaru dengan mengklik gambar di atas. Apakah Anda selalu</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection