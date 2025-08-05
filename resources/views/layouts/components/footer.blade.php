<footer class="bg-slate-800 text-slate-400 pt-8 sm:pt-16">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8 lg:gap-16 mb-8 sm:mb-12">

            <!-- Logo and Animation Section -->
            <div class="col-span-1 sm:col-span-2 lg:col-span-1 flex justify-center lg:justify-start">
                <div class="relative w-full max-w-[200px] sm:max-w-xs h-32 sm:h-48 overflow-hidden">
                    <!-- Logo -->
                    <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center animate-logo">
                        <img src="{{ asset('images/logo-dinsos.png') }}" alt="Logo Dinas Sosial Kota Majalengka" class="h-24 w-24 sm:h-32 sm:w-32 lg:h-48 lg:w-48 object-contain">
                    </div>

                    <!-- Teks -->
                    <div class="absolute top-0 left-0 w-full h-full flex flex-col items-center justify-center animate-text text-center px-2">
                        <p class="text-white text-xs sm:text-sm lg:text-base font-medium mb-1">MELAYANI MASYARAKAT DENGAN SEPENUH HATI</p>
                        <p class="text-white text-xs sm:text-sm lg:text-base font-medium">UNTUK KESEJAHTERAAN SOSIAL YANG LEBIH BAIK</p>
                    </div>
                </div>
            </div>

            <!-- Services Section -->
            <div class="text-center sm:text-left">
                <h3 class="text-white font-semibold text-base sm:text-lg mb-4 sm:mb-6">Dinas Sosial</h3>
                <ul class="space-y-2 sm:space-y-3">
                    <li>
                        <a href="https://maps.app.goo.gl/MHZCqEaLDty9kmxw5" class="text-xs sm:text-sm hover:text-blue-400 transition-colors duration-300 flex items-center justify-center sm:justify-start">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                            </svg>
                            Lokasi
                        </a>
                    </li>
                    <li>
                        <a href="mailto:dinsos@majalengkakab.go.id" class="text-xs sm:text-sm hover:text-blue-400 transition-colors duration-300 flex items-center justify-center sm:justify-start">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                            </svg>
                            Email
                        </a>
                    </li>
                    <li>
                        <a href="tel:0233281122" class="text-xs sm:text-sm hover:text-blue-400 transition-colors duration-300 flex items-center justify-center sm:justify-start">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
                            </svg>
                            Kontak
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Support Section -->
            <div class="text-center sm:text-left">
                <h3 class="text-white font-semibold text-base sm:text-lg mb-4 sm:mb-6">Profil</h3>
                <ul class="space-y-2 sm:space-y-3">
                    <li><a href="{{ route('profil.sambutan') }}" class="text-xs sm:text-sm hover:text-blue-400 transition-colors duration-300">Sambutan Kepala Dinas</a></li>
                    <li><a href="{{ route('profil.struktur') }}" class="text-xs sm:text-sm hover:text-blue-400 transition-colors duration-300">Struktur Organisasi</a></li>
                    <li><a href="{{ route('profil.pegawai') }}" class="text-xs sm:text-sm hover:text-blue-400 transition-colors duration-300">Daftar Pegawai</a></li>
                    <li><a href="{{ route('profil.visi-misi') }}" class="text-xs sm:text-sm hover:text-blue-400 transition-colors duration-300">Visi dan Misi</a></li>
                </ul>
            </div>

            <!-- Company Section -->
            <div class="text-center sm:text-left">
                <h3 class="text-white font-semibold text-base sm:text-lg mb-4 sm:mb-6">Informasi</h3>
                <ul class="space-y-2 sm:space-y-3">
                    <li><a href="{{ route('layanan') }}" class="text-xs sm:text-sm hover:text-blue-400 transition-colors duration-300">Layanan</a></li>
                    <li><a href="{{ route('rumah-singgah') }}" class="text-xs sm:text-sm hover:text-blue-400 transition-colors duration-300">Rumah Singgah</a></li>
                    <li><a href="{{ route('berita') }}" class="text-xs sm:text-sm hover:text-blue-400 transition-colors duration-300">Berita</a></li>
                </ul>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="border-t border-slate-600 pt-4 sm:pt-6 pb-6 sm:pb-8">
            <!-- Social Media Icons -->
            <div class="flex justify-center space-x-4 sm:space-x-6 mb-4 sm:mb-6">
                <a href="https://www.instagram.com/dinsos_majalengka?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="w-8 h-8 sm:w-10 sm:h-10 bg-slate-600 rounded-full flex items-center justify-center text-slate-400 hover:bg-blue-500 hover:text-white transition-all duration-300 hover:-translate-y-1">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                    </svg>
                </a>
                <a href="https://youtube.com/@dinsos_majalengka1883?si=H0_HocCiaNJ95NXN" class="w-8 h-8 sm:w-10 sm:h-10 bg-slate-600 rounded-full flex items-center justify-center text-slate-400 hover:bg-blue-500 hover:text-white transition-all duration-300 hover:-translate-y-1">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                    </svg>
                </a>
            </div>

            <!-- Copyright -->
            <div class="text-center text-xs sm:text-sm text-slate-500">
                © Dinas Sosial Kabupaten Majalengka 2025.
            </div>
        </div>
    </div>

    <style>
        @keyframes slideLogoRightToLeft {
            0% {
                transform: translateX(100%);
            }

            20% {
                transform: translateX(0);
            }

            40% {
                transform: translateX(0);
            }

            50% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        @keyframes slideTextRightToLeft {
            0% {
                transform: translateX(100%);
            }

            50% {
                transform: translateX(100%);
            }

            70% {
                transform: translateX(0);
            }

            90% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        .animate-logo {
            animation: slideLogoRightToLeft 8s linear infinite;
        }

        .animate-text {
            animation: slideTextRightToLeft 8s linear infinite;
        }

        /* Mobile optimization untuk text yang panjang */
        @media (max-width: 640px) {
            .animate-text p {
                font-size: 0.65rem;
                line-height: 1.2;
            }
        }
    </style>

</footer>