@extends('layouts.app')

@section('title', 'Rumah Singgah - Dinas Sosial Kabupaten Majalengka')

@section('header')
@include('layouts.components.header', ['page' => 'rumah-singgah'])
@endsection

@section('content')

<!-- Hero Section -->
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16">
    <!-- Container Responsive -->
    <div class="flex flex-col-reverse md:flex-row items-center md:items-start gap-8">

        <!-- Left Side - Text Content -->
        <div class="md:w-1/2 min-w-0">
            <h1 class="text-4xl font-bold text-gray-900 mb-6 break-words">Rumah Singgah Hegar Majalengka</h1>
            <p class="text-black text-lg mb-8 leading-relaxed" style="word-wrap: break-word; overflow-wrap: break-word; word-break: break-all; hyphens: auto; max-width: 100%; overflow: hidden;">
                {{ $rumahSinggah->isi ?? 'Deskripsi Belum Tersedia' }}
            </p>
        </div>

        <!-- Right Side - Building Image -->
        <div class="md:w-1/2 flex-shrink-0">
            @if($rumahSinggah && $rumahSinggah->gambar)
            <img src="{{ asset('storage/' . $rumahSinggah->gambar) }}" alt="Rumah Singgah Hegar Majalengka"
                class="w-full h-96 object-cover rounded-lg shadow-lg">
            @else
            <div class="w-full h-96 bg-gray-200 rounded-lg shadow-lg flex items-center justify-center">
                <span class="text-gray-400">Gambar belum tersedia</span>
            </div>
            @endif
        </div>

    </div>
</div>

<!-- Image Gallery Section with Carousel -->
@if($rumahSinggah && $rumahSinggah->galeri && count($rumahSinggah->galeri) > 0)
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
    <h2 class="text-3xl font-bold text-center text-gray-900 mb-8">Galeri Rumah Singgah Hegar</h2>

    <!-- Mobile Carousel (1 per slide) -->
    <div class="md:hidden relative overflow-hidden">
        <div id="mobile-carousel" class="flex transition-transform duration-500 ease-in-out">
            @foreach($rumahSinggah->galeri as $index => $image)
            <div class="w-full flex-shrink-0">
                <div class="text-center">
                    <img src="{{ asset('storage/' . $image) }}" alt="Galeri Rumah Singgah"
                        class="w-full h-64 object-cover rounded-lg shadow-md mb-4 hover:shadow-lg transition-shadow duration-300">
                </div>
            </div>
            @endforeach
        </div>

        <!-- Indicators -->
        @if(count($rumahSinggah->galeri) > 1)
        <div class="flex justify-center mt-6 space-x-2">
            @foreach($rumahSinggah->galeri as $index => $image)
            <button class="carousel-indicator-mobile w-3 h-3 rounded-full transition-colors duration-300 {{ $index == 0 ? 'bg-orange-500' : 'bg-gray-300' }}"
                data-slide="{{ $index }}"></button>
            @endforeach
        </div>
        @endif
    </div>

    <!-- Desktop Carousel (3 per slide) -->
    <div class="hidden md:block relative overflow-hidden">
        <div id="gallery-carousel" class="flex transition-transform duration-500 ease-in-out">
            @php
            $chunkedGaleri = array_chunk($rumahSinggah->galeri, 3);
            @endphp

            @foreach($chunkedGaleri as $slide)
            <div class="w-full flex-shrink-0">
                <div class="grid grid-cols-3 gap-6">
                    @foreach($slide as $image)
                    <div class="text-center">
                        <img src="{{ asset('storage/' . $image) }}" alt="Galeri Rumah Singgah"
                            class="w-full h-64 object-cover rounded-lg shadow-md mb-4 hover:shadow-lg transition-shadow duration-300">
                    </div>
                    @endforeach

                    @if(count($slide) < 3)
                        @for($i=count($slide); $i < 3; $i++)
                        <div class="text-center">
                        <div class="w-full h-64 bg-gray-100 rounded-lg shadow-md mb-4"></div>
                </div>
                @endfor
                @endif
            </div>
        </div>
        @endforeach
    </div>

    @if(count($chunkedGaleri) > 1)
    <div class="flex justify-center mt-6 space-x-2">
        @foreach($chunkedGaleri as $index => $slide)
        <button class="carousel-indicator w-3 h-3 rounded-full transition-colors duration-300 {{ $index == 0 ? 'bg-orange-500' : 'bg-gray-300' }}"
            data-slide="{{ $index }}"></button>
        @endforeach
    </div>
    @endif
</div>
</div>
@else
<!-- Jika tidak ada galeri -->
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
    <h2 class="text-3xl font-bold text-center text-gray-900 mb-8">Galeri Rumah Singgah Hegar</h2>
    <div class="text-center text-gray-500">
        <p>Galeri belum tersedia</p>
    </div>
</div>
@endif

<!-- Facilities Section -->
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16 bg-gray-50">
    <div class="bg-white rounded-lg shadow-md p-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">Fasilitas</h2>

        @if($rumahSinggah && $rumahSinggah->fasilitas && count($rumahSinggah->fasilitas) > 0)
        <ul class="space-y-4 text-gray-700">
            @foreach($rumahSinggah->fasilitas as $fasilitas)
            <li class="flex items-start text-black">
                <span class="text-black mr-3 mt-0.5 flex-shrink-0">•</span>
                <span style="word-wrap: break-word; overflow-wrap: break-word; word-break: break-word;">
                    {{ $fasilitas }}
                </span>
            </li>
            @endforeach
        </ul>
        @else
        <!-- Default fasilitas jika database kosong -->
        <ul class="space-y-4 text-gray-700">
            <li class="flex items-start">
                <span class="text-black mr-3 mt-1">•</span>
                <span class="text-black">Fasilitas akan segera diperbarui</span>
            </li>
        </ul>
        @endif
    </div>
</div>

<!-- Kriteria Tamu Section -->
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16 bg-gray-50">
    <div class="bg-white rounded-lg shadow-md p-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">Kriteria Tamu</h2>

        @if($rumahSinggah && $rumahSinggah->kriteria_tamu && count($rumahSinggah->kriteria_tamu) > 0)
        <ul class="space-y-4 text-gray-700">
            @foreach($rumahSinggah->kriteria_tamu as $kriteria)
            <li class="flex items-start text-black">
                <span class="text-black mr-3 mt-0.5 flex-shrink-0">•</span>
                <span style="word-wrap: break-word; overflow-wrap: break-word; word-break: break-word;">
                    {{ $kriteria }}
                </span>
            </li>
            @endforeach
        </ul>
        @else
        <!-- Default kriteria jika database kosong -->
        <ul class="space-y-4 text-gray-700">
            <li class="flex items-start">
                <span class="text-black mr-3 mt-1">•</span>
                <span class="text-black">Kriteria tamu akan diperbarui segera</span>
            </li>
        </ul>
        @endif
    </div>
</div>

<!-- Video Section -->
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Video Rumah Singgah Hegar</h2>
        <p class="text-gray-600">Video fasilitas pada Rumah Singgah Hegar Majalengka</p>
    </div>

    @if($rumahSinggah && $rumahSinggah->video)
    <div class="bg-gray-200 rounded-lg overflow-hidden shadow-lg">
        <video controls class="w-full aspect-video">
            <source src="{{ asset('storage/' . $rumahSinggah->video) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
    @else
    <!-- Default video placeholder -->
    <div class="bg-gray-200 rounded-lg overflow-hidden shadow-lg">
        <div class="aspect-video bg-gray-300 flex items-center justify-center">
            <div class="text-center">
                <div class="bg-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <span class="text-gray-600 text-2xl">▶</span>
                </div>
                <p class="text-gray-600">Video belum tersedia</p>
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Alur Pelayanan Section -->
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16 bg-pink-50">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Alur Pelayanan</h2>
        <p class="text-gray-600">Berikut Bagan Alur Pelayanan pada Rumah Singgah Hegar Majalengka</p>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-8">
        @if($rumahSinggah && $rumahSinggah->alur_pelayanan)
        <img src="{{ asset('storage/' . $rumahSinggah->alur_pelayanan) }}" alt="Alur Pelayanan"
            class="w-full max-w-4xl mx-auto rounded-lg shadow-md">
        @else
        <div class="text-center text-gray-500 py-12">
            <p>Bagan alur pelayanan belum tersedia</p>
        </div>
        @endif
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
                <p class="text-black">
                    {{ $rumahSinggah->alamat_lengkap ?? 'Alamat akan diperbarui segera' }}
                </p>
            </div>

            <!-- Kontak -->
            <div class="lg:w-1/2 space-y-4">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">📞 Informasi Kontak</h3>

                <div class="flex items-center">
                    <span class="text-green-500 mr-3">📱</span>
                    <div>
                        <p class="font-semibold text-gray-800">WhatsApp</p>
                        <p class="text-black">{{ $rumahSinggah->whatsapp ?? '+62 812-3456-7890' }}</p>
                    </div>
                </div>

                <div class="flex items-center">
                    <span class="text-blue-500 mr-3">☎️</span>
                    <div>
                        <p class="font-semibold text-gray-800">Telepon</p>
                        <p class="text-black">{{ $rumahSinggah->telepon ?? '(0778) 123-4567' }}</p>
                    </div>
                </div>

                <div class="flex items-center">
                    <span class="text-red-500 mr-3">✉️</span>
                    <div>
                        <p class="font-semibold text-gray-800">Email</p>
                        <p class="text-black">{{ $rumahSinggah->email ?? 'rumahsinggah@majalengkakab.go.id' }}</p>
                    </div>
                </div>

                <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                    <p class="text-sm">
                        <strong class="text-blue-800">Jam Operasional:</strong><br>
                        @if($rumahSinggah && $rumahSinggah->jam_operasional)
                        @if(isset($rumahSinggah->jam_operasional['senin_jumat']))
                        Senin - Jumat: {{ $rumahSinggah->jam_operasional['senin_jumat'] }}<br>
                        @endif
                        @if(isset($rumahSinggah->jam_operasional['sabtu']))
                        Sabtu: {{ $rumahSinggah->jam_operasional['sabtu'] }}<br>
                        @endif
                        @if(isset($rumahSinggah->jam_operasional['emergency']))
                        Emergency: {{ $rumahSinggah->jam_operasional['emergency'] }}
                        @endif
                        @else
                        Senin - Jumat: 08:00 - 17:00 WIB<br>
                        Sabtu: 08:00 - 12:00 WIB<br>
                        Emergency 24 Jam
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Desktop Carousel
        const desktopCarousel = document.getElementById('gallery-carousel');
        const desktopIndicators = document.querySelectorAll('.carousel-indicator');

        // Mobile Carousel
        const mobileCarousel = document.getElementById('mobile-carousel');
        const mobileIndicators = document.querySelectorAll('.carousel-indicator-mobile');

        // Desktop Carousel Functionality
        if (desktopCarousel && desktopIndicators.length > 0) {
            let currentSlide = 0;
            const totalSlides = desktopIndicators.length;
            let autoSlideInterval;

            function updateDesktopCarousel() {
                const translateX = -currentSlide * 100;
                desktopCarousel.style.transform = `translateX(${translateX}%)`;

                desktopIndicators.forEach((indicator, index) => {
                    if (index === currentSlide) {
                        indicator.classList.remove('bg-gray-300');
                        indicator.classList.add('bg-orange-500');
                    } else {
                        indicator.classList.remove('bg-orange-500');
                        indicator.classList.add('bg-gray-300');
                    }
                });
            }

            function nextDesktopSlide() {
                currentSlide = (currentSlide + 1) % totalSlides;
                updateDesktopCarousel();
            }

            function goToDesktopSlide(slideIndex) {
                currentSlide = slideIndex;
                updateDesktopCarousel();
            }

            function startDesktopAutoSlide() {
                autoSlideInterval = setInterval(nextDesktopSlide, 4000);
            }

            function stopDesktopAutoSlide() {
                if (autoSlideInterval) {
                    clearInterval(autoSlideInterval);
                }
            }

            desktopIndicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => {
                    stopDesktopAutoSlide();
                    goToDesktopSlide(index);
                    startDesktopAutoSlide();
                });
            });

            desktopCarousel.addEventListener('mouseenter', stopDesktopAutoSlide);
            desktopCarousel.addEventListener('mouseleave', startDesktopAutoSlide);

            startDesktopAutoSlide();
        }

        // Mobile Carousel Functionality
        if (mobileCarousel && mobileIndicators.length > 0) {
            let currentMobileSlide = 0;
            const totalMobileSlides = mobileIndicators.length;
            let mobileAutoSlideInterval;

            function updateMobileCarousel() {
                const translateX = -currentMobileSlide * 100;
                mobileCarousel.style.transform = `translateX(${translateX}%)`;

                mobileIndicators.forEach((indicator, index) => {
                    if (index === currentMobileSlide) {
                        indicator.classList.remove('bg-gray-300');
                        indicator.classList.add('bg-orange-500');
                    } else {
                        indicator.classList.remove('bg-orange-500');
                        indicator.classList.add('bg-gray-300');
                    }
                });
            }

            function nextMobileSlide() {
                currentMobileSlide = (currentMobileSlide + 1) % totalMobileSlides;
                updateMobileCarousel();
            }

            function goToMobileSlide(slideIndex) {
                currentMobileSlide = slideIndex;
                updateMobileCarousel();
            }

            function startMobileAutoSlide() {
                mobileAutoSlideInterval = setInterval(nextMobileSlide, 4000);
            }

            function stopMobileAutoSlide() {
                if (mobileAutoSlideInterval) {
                    clearInterval(mobileAutoSlideInterval);
                }
            }

            mobileIndicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => {
                    stopMobileAutoSlide();
                    goToMobileSlide(index);
                    startMobileAutoSlide();
                });
            });

            // Touch/swipe functionality for mobile
            let startX = 0;
            let endX = 0;

            mobileCarousel.addEventListener('touchstart', (e) => {
                startX = e.touches[0].clientX;
                stopMobileAutoSlide();
            });

            mobileCarousel.addEventListener('touchmove', (e) => {
                endX = e.touches[0].clientX;
            });

            mobileCarousel.addEventListener('touchend', () => {
                const threshold = 50; // Minimum distance for swipe
                const diff = startX - endX;

                if (Math.abs(diff) > threshold) {
                    if (diff > 0) {
                        // Swipe left - next slide
                        nextMobileSlide();
                    } else {
                        // Swipe right - previous slide
                        currentMobileSlide = currentMobileSlide === 0 ? totalMobileSlides - 1 : currentMobileSlide - 1;
                        updateMobileCarousel();
                    }
                }
                startMobileAutoSlide();
            });

            startMobileAutoSlide();
        }
    });
</script>

@endsection