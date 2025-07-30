@extends('layouts.app')

@section('title', 'Rumah Singgah - Dinas Sosial Kota Majalengka')

@section('header')
@include('layouts.components.header', ['page' => 'rumah-singgah'])
@endsection

@section('content')

<!-- Hero Section -->
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <!-- Left Side - Text Content -->
        <div>
            <h1 class="text-4xl font-bold text-gray-900 mb-6">Rumah Singgah Hegar Majalengka</h1>
            <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Earum quaerat accusantium, assumenda blanditiis quo maxime incidunt repudiandae, distinctio dolorem nostrum quidem unde velit illum vel nesciunt eius libero fugit eos.
            </p>
        </div>

        <!-- Right Side - Building Image -->
        <div>
            <img src="/images/rumah-singgah-building.jpg" alt="Rumah Singgah Hegar Majalengka"
                class="w-full h-96 object-cover rounded-lg shadow-lg">
        </div>
    </div>
</div>

<!-- Image Gallery Section -->
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
    <h2 class="text-3xl font-bold text-center text-gray-900 mb-8">Rumah Singgah Hegar Majalengka</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="text-center">
            <img src="/images/ruang-makan.jpg" alt="" class="w-full h-64 object-cover rounded-lg shadow-md mb-4">
        </div>
    </div>
</div>

<!-- Facilities Section -->
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16">
    <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Fasilitas</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <div class="text-center">
            <div class="bg-orange-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="text-orange-500 text-2xl">🏠</span>
            </div>
            <ul class="text-gray-700 space-y-1">
                <li>Front Desk 24 Jam</li>
                <li>Lounge</li>
                <li>Ruang Kamar</li>
                <li>Tempat Tidur</li>
                <li>Breakfast</li>
                <li>AC</li>
            </ul>
        </div>

        <div class="text-center">
            <div class="bg-orange-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="text-orange-500 text-2xl">💧</span>
            </div>
            <ul class="text-gray-700 space-y-1">
                <li>Water Heater</li>
                <li>Wifi</li>
                <li>Smart TV</li>
                <li>Kitchen Pantry</li>
                <li>Ruang Klinik</li>
            </ul>
        </div>

        <div class="text-center">
            <div class="bg-orange-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="text-orange-500 text-2xl">🚗</span>
            </div>
            <ul class="text-gray-700 space-y-1">
                <li>Parkir</li>
                <li>Mushola</li>
                <li>Security 24 Jam</li>
                <li>Jasa Kebersihan</li>
                <li>Ambulance</li>
            </ul>
        </div>

        <div class="text-center">
            <div class="bg-orange-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="text-orange-500 text-2xl">🚌</span>
            </div>
            <ul class="text-gray-700 space-y-1">
                <li>Antar Jemput (Rumah Singgah ke Rumah Sakit)</li>
            </ul>
        </div>
    </div>
</div>

<!-- Kriteria Tamu Section -->
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16 bg-gray-50">
    <div class="bg-white rounded-lg shadow-md p-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">Kriteria Tamu</h2>

        <ul class="space-y-4 text-gray-700">
            <li class="flex items-start">
                <span class="text-green-500 mr-3 mt-1">•</span>
                <span>Contoh</span>
            </li>
            <li class="flex items-start">
                <span class="text-green-500 mr-3 mt-1">•</span>
                <span>Contoh</span>
            </li>
            <li class="flex items-start">
                <span class="text-green-500 mr-3 mt-1">•</span>
                <span>Contoh</span>
            </li>
            <li class="flex items-start">
                <span class="text-green-500 mr-3 mt-1">•</span>
                <span>Contoh</span>
            </li>
            <li class="flex items-start">
                <span class="text-green-500 mr-3 mt-1">•</span>
                <span>Contoh</span>
            </li>
            <li class="flex items-start">
                <span class="text-green-500 mr-3 mt-1">•</span>
                <span>Contoh</span>
            </li>
            <li class="flex items-start">
                <span class="text-green-500 mr-3 mt-1">•</span>
                <span>Contoh</span>
            </li>
            <li class="flex items-start">
                <span class="text-green-500 mr-3 mt-1">•</span>
                <span>Contoh</span>
            </li>
            <li class="flex items-start">
                <span class="text-green-500 mr-3 mt-1">•</span>
                <span>Contoh</span>
            </li>
            <li class="flex items-start">
                <span class="text-green-500 mr-3 mt-1">•</span>
                <span>Contoh</span>
            </li>
            <li class="flex items-start">
                <span class="text-green-500 mr-3 mt-1">•</span>
                <span>Contoh</span>
            </li>
        </ul>
    </div>
</div>

<!-- Video Section -->
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Video Rumah Singgah Hegar</h2>
        <p class="text-gray-600">Display video fasilitas pada Rumah Singgah Hegar Majalengka</p>
    </div>

    <div class="bg-gray-200 rounded-lg overflow-hidden shadow-lg">
        <div class="aspect-video bg-gray-300 flex items-center justify-center">
            <div class="text-center">
                <div class="bg-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <span class="text-gray-600 text-2xl">▶</span>
                </div>
                <p class="text-gray-600">Video Player</p>
            </div>
        </div>
    </div>
</div>

<!-- Alur Pelayanan Section -->
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16 bg-pink-50">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Alur Pelayanan</h2>
        <p class="text-gray-600">Berikut Bagan Alur Pelayanan pada Rumah Singgah Hegar Majalengka</p>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-8">
        <!-- ISI -->
    </div>
</div>

<!-- Contact & Address Section -->
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16">
    <div class="bg-white rounded-lg shadow-md p-8">
        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-start gap-12">
            <!-- Alamat -->
            <div class="lg:w-1/2">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">📍 Alamat Rumah Singgah Hegar</h3>
                <h4 class="font-semibold text-gray-800 mb-2">Rumah Singgah Hegar Majalengka</h4>
                <p class="text-gray-600">test</p>
            </div>

            <!-- Kontak -->
            <div class="lg:w-1/2 space-y-4">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">📞 Informasi Kontak</h3>

                <div class="flex items-center">
                    <span class="text-green-500 mr-3">📱</span>
                    <div>
                        <p class="font-semibold text-gray-800">WhatsApp</p>
                        <p class="text-gray-600">+62 812-3456-7890</p>
                    </div>
                </div>

                <div class="flex items-center">
                    <span class="text-blue-500 mr-3">☎️</span>
                    <div>
                        <p class="font-semibold text-gray-800">Telepon</p>
                        <p class="text-gray-600">(0778) 123-4567</p>
                    </div>
                </div>

                <div class="flex items-center">
                    <span class="text-red-500 mr-3">✉️</span>
                    <div>
                        <p class="font-semibold text-gray-800">Email</p>
                        <p class="text-gray-600">rumahsinggah@majalengkakab.go.id</p>
                    </div>
                </div>

                <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                    <p class="text-sm text-blue-800">
                        <strong>Jam Operasional:</strong><br>
                        Senin - Jumat: 08:00 - 17:00 WIB<br>
                        Sabtu: 08:00 - 12:00 WIB<br>
                        Emergency 24 Jam
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection