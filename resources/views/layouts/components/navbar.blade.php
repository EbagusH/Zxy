<nav class="fixed top-0 left-0 right-0 z-20 transition-all duration-300"
    x-data="{
        isOpen: false,
        profilOpen: false,
        mobileProfilOpen: false,
        scrolled: false
    }"
    x-init="
        window.addEventListener('scroll', () => {
            scrolled = window.scrollY > 50
        })
     "
    :class="scrolled ? 'bg-white shadow-lg' : 'bg-transparent'">

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between">
            <!-- Logo dan Nama Dinas -->
            <div class="flex items-center">
                <div class="shrink-0 flex items-center">
                    <img src="{{ asset('images/logo-kota.png') }}" alt="Logo Dinas Sosial Kota Majalengka" class="h-48 w-48 mr-3">

                </div>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:block">
                <div class="flex items-center space-x-2">
                    <!-- Beranda -->
                    <a href="/"
                        class="rounded-md px-4 py-3 text-sm font-medium transition-all duration-200 backdrop-blur-sm"
                        :class="scrolled ? 
                            '{{ request()->routeIs('home') || request()->is('/') ? 'bg-blue-500 text-white shadow-lg' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}' : 
                            '{{ request()->routeIs('home') || request()->is('/') ? 'bg-white/20 text-white shadow-lg border border-white/30' : 'text-white/90 hover:bg-white/10 hover:text-white' }}'">
                        Beranda
                    </a>

                    <!-- Profil Dropdown -->
                    <div class="relative"
                        @mouseenter="profilOpen = true"
                        @mouseleave="profilOpen = false">
                        <button class="flex items-center rounded-md px-4 py-3 text-sm font-medium transition-all duration-200 backdrop-blur-sm"
                            :class="scrolled ? 
                                    '{{ request()->routeIs(['profil.sambutan', 'profil.struktur', 'profil.pegawai', 'profil.visi-misi']) ? 'bg-blue-500 text-white shadow-lg' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}' : 
                                    '{{ request()->routeIs(['profil.sambutan', 'profil.struktur', 'profil.pegawai', 'profil.visi-misi']) ? 'bg-white/20 text-white shadow-lg border border-white/30' : 'text-white/90 hover:bg-white/10 hover:text-white' }}'">
                            <span>Profil</span>
                            <svg class="ml-1 h-4 w-4 transition-transform duration-200"
                                :class="{'rotate-180': profilOpen}"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Profil Dropdown Menu -->
                        <div x-show="profilOpen"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="absolute left-0 mt-2 w-64 bg-white/95 backdrop-blur-md rounded-md shadow-lg ring-1 ring-black/10 z-50">
                            <div class="py-2">
                                <a href="{{ route('profil.sambutan') }}"
                                    class="flex items-center px-4 py-3 text-sm transition-colors duration-200
                                           {{ request()->routeIs('profil.sambutan') ? 'bg-blue-50 text-blue-600 border-r-3 border-blue-600 font-medium' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }}">
                                    <i class="fas fa-user-tie mr-3 text-gray-400 w-4"></i>
                                    Sambutan Kepala Dinas
                                </a>
                                <a href="{{ route('profil.struktur') }}"
                                    class="flex items-center px-4 py-3 text-sm transition-colors duration-200
                                           {{ request()->routeIs('profil.struktur') ? 'bg-blue-50 text-blue-600 border-r-3 border-blue-600 font-medium' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }}">
                                    <i class="fas fa-sitemap mr-3 text-gray-400 w-4"></i>
                                    Struktur Organisasi
                                </a>
                                <a href="{{ route('profil.pegawai') }}"
                                    class="flex items-center px-4 py-3 text-sm transition-colors duration-200
                                           {{ request()->routeIs('profil.pegawai') ? 'bg-blue-50 text-blue-600 border-r-3 border-blue-600 font-medium' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }}">
                                    <i class="fas fa-users mr-3 text-gray-400 w-4"></i>
                                    Daftar Pegawai
                                </a>
                                <a href="{{ route('profil.visi-misi') }}"
                                    class="flex items-center px-4 py-3 text-sm transition-colors duration-200
                                           {{ request()->routeIs('profil.visi-misi') ? 'bg-blue-50 text-blue-600 border-r-3 border-blue-600 font-medium' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }}">
                                    <i class="fas fa-bullseye mr-3 text-gray-400 w-4"></i>
                                    Visi dan Misi
                                </a>
                                <a href="#"
                                    class="flex items-center px-4 py-3 text-sm transition-colors duration-200">
                                    <i class="fas fa-bullseye mr-3 text-gray-400 w-4"></i>
                                    Bidang Linjamsos
                                </a>
                                <a href="#"
                                    class="flex items-center px-4 py-3 text-sm transition-colors duration-200">
                                    <i class="fas fa-bullseye mr-3 text-gray-400 w-4"></i>
                                    Bidang Dayasos
                                </a>
                                <a href="#"
                                    class="flex items-center px-4 py-3 text-sm transition-colors duration-200">
                                    <i class="fas fa-bullseye mr-3 text-gray-400 w-4"></i>
                                    Bidang Resos
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Berita -->
                    <a href="{{ route('berita') }}"
                        class="rounded-md px-4 py-3 text-sm font-medium transition-all duration-200 backdrop-blur-sm"
                        :class="scrolled ? 
                            '{{ request()->routeIs(['berita', 'berita.detail', 'berita.show']) || request()->is('berita*') ? 'bg-blue-500 text-white shadow-lg' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}' : 
                            '{{ request()->routeIs(['berita', 'berita.detail', 'berita.show']) || request()->is('berita*') ? 'bg-white/20 text-white shadow-lg border border-white/30' : 'text-white/90 hover:bg-white/10 hover:text-white' }}'">
                        Berita
                    </a>

                    <!-- Layanan -->
                    <a href="{{ route('layanan') }}"
                        class="rounded-md px-4 py-3 text-sm font-medium transition-all duration-200 backdrop-blur-sm"
                        :class="scrolled ? 
                            '{{ request()->routeIs('layanan') ? 'bg-blue-500 text-white shadow-lg' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}' : 
                            '{{ request()->routeIs('layanan') ? 'bg-white/20 text-white shadow-lg border border-white/30' : 'text-white/90 hover:bg-white/10 hover:text-white' }}'">
                        Layanan
                    </a>

                    <!-- Rumah Singgah -->
                    <a href="{{ route('rumah-singgah') }}"
                        class="rounded-md px-4 py-3 text-sm font-medium transition-all duration-200 backdrop-blur-sm"
                        :class="scrolled ? 
                            '{{ request()->routeIs('rumah-singgah') ? 'bg-blue-500 text-white shadow-lg' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}' : 
                            '{{ request()->routeIs('rumah-singgah') ? 'bg-white/20 text-white shadow-lg border border-white/30' : 'text-white/90 hover:bg-white/10 hover:text-white' }}'">
                        Rumah Singgah
                    </a>
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="flex md:hidden">
                <button type="button" @click="isOpen = !isOpen"
                    class="inline-flex items-center justify-center rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-offset-2 backdrop-blur-sm transition-all duration-200"
                    :class="scrolled ? 'text-gray-700 hover:bg-gray-100 focus:ring-gray-500' : 'text-white/90 hover:bg-white/10 hover:text-white focus:ring-white/50'">
                    <span class="sr-only">Open main menu</span>
                    <svg :class="{'hidden': isOpen, 'block': !isOpen }" class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg :class="{'block': isOpen, 'hidden': !isOpen }" class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div class="md:hidden" x-show="isOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform -translate-y-1"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform -translate-y-1">
        <div class="space-y-1 px-2 pb-3 pt-2 shadow-lg border-t transition-all duration-300"
            :class="scrolled ? 'bg-white border-gray-200' : 'bg-black/50 backdrop-blur-md border-white/20'">
            <!-- Mobile Beranda -->
            <a href="/"
                class="block rounded-md px-3 py-2 text-base font-medium transition-all duration-200"
                :class="scrolled ? 
                    '{{ request()->routeIs('home') || request()->is('/') ? 'bg-blue-500 text-white' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}' : 
                    '{{ request()->routeIs('home') || request()->is('/') ? 'bg-white/20 text-white border border-white/30' : 'text-white/90 hover:bg-white/10 hover:text-white' }}'">
                Beranda
            </a>

            <!-- Mobile Profil Dropdown -->
            <div class="relative">
                <button @click="mobileProfilOpen = !mobileProfilOpen"
                    class="flex items-center justify-between w-full rounded-md px-3 py-2 text-base font-medium transition-all duration-200"
                    :class="scrolled ? 
                        '{{ request()->routeIs(['profil.sambutan', 'profil.struktur', 'profil.pegawai', 'profil.visi-misi']) ? 'bg-blue-500 text-white' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}' : 
                        '{{ request()->routeIs(['profil.sambutan', 'profil.struktur', 'profil.pegawai', 'profil.visi-misi']) ? 'bg-white/20 text-white border border-white/30' : 'text-white/90 hover:bg-white/10 hover:text-white' }}'">
                    <span>Profil</span>
                    <svg class="h-4 w-4 transition-transform duration-200"
                        :class="{'rotate-180': mobileProfilOpen}"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="mobileProfilOpen"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform -translate-y-1"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-1"
                    class="mt-1 space-y-1 pl-4">
                    <a href="{{ route('profil.sambutan') }}"
                        class="block px-3 py-2 text-sm rounded-md transition-all duration-200"
                        :class="scrolled ? 
                            '{{ request()->routeIs('profil.sambutan') ? 'bg-blue-400 text-white' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}' : 
                            '{{ request()->routeIs('profil.sambutan') ? 'bg-white/20 text-white border border-white/30' : 'text-white/80 hover:bg-white/10 hover:text-white' }}'">
                        <i class="fas fa-user-tie mr-2" :class="scrolled ? 'text-gray-400' : 'text-white/60'"></i>
                        Sambutan Kepala Dinas
                    </a>
                    <a href="{{ route('profil.struktur') }}"
                        class="block px-3 py-2 text-sm rounded-md transition-all duration-200"
                        :class="scrolled ? 
                            '{{ request()->routeIs('profil.struktur') ? 'bg-blue-400 text-white' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}' : 
                            '{{ request()->routeIs('profil.struktur') ? 'bg-white/20 text-white border border-white/30' : 'text-white/80 hover:bg-white/10 hover:text-white' }}'">
                        <i class="fas fa-sitemap mr-2" :class="scrolled ? 'text-gray-400' : 'text-white/60'"></i>
                        Struktur Organisasi
                    </a>
                    <a href="{{ route('profil.pegawai') }}"
                        class="block px-3 py-2 text-sm rounded-md transition-all duration-200"
                        :class="scrolled ? 
                            '{{ request()->routeIs('profil.pegawai') ? 'bg-blue-400 text-white' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}' : 
                            '{{ request()->routeIs('profil.pegawai') ? 'bg-white/20 text-white border border-white/30' : 'text-white/80 hover:bg-white/10 hover:text-white' }}'">
                        <i class="fas fa-users mr-2" :class="scrolled ? 'text-gray-400' : 'text-white/60'"></i>
                        Daftar Pegawai
                    </a>
                    <a href="{{ route('profil.visi-misi') }}"
                        class="block px-3 py-2 text-sm rounded-md transition-all duration-200"
                        :class="scrolled ? 
                            '{{ request()->routeIs('profil.visi-misi') ? 'bg-blue-400 text-white' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}' : 
                            '{{ request()->routeIs('profil.visi-misi') ? 'bg-white/20 text-white border border-white/30' : 'text-white/80 hover:bg-white/10 hover:text-white' }}'">
                        <i class="fas fa-bullseye mr-2" :class="scrolled ? 'text-gray-400' : 'text-white/60'"></i>
                        Visi dan Misi
                    </a>
                    <a href="#"
                        class="block px-3 py-2 text-sm rounded-md transition-all duration-200">
                        <i class="fas fa-bullseye mr-2" :class="scrolled ? 'text-gray-400' : 'text-white/60'"></i>
                        Bidang Linjamsos
                    </a>
                    <a href="#"
                        class="block px-3 py-2 text-sm rounded-md transition-all duration-200">
                        <i class="fas fa-bullseye mr-2" :class="scrolled ? 'text-gray-400' : 'text-white/60'"></i>
                        Bidang Dayasos
                    </a>
                    <a href="#"
                        class="block px-3 py-2 text-sm rounded-md transition-all duration-200">
                        <i class="fas fa-bullseye mr-2" :class="scrolled ? 'text-gray-400' : 'text-white/60'"></i>
                        Bidang Resos
                    </a>
                </div>
            </div>

            <!-- Mobile Berita -->
            <a href="{{ route('berita') }}"
                class="block rounded-md px-3 py-2 text-base font-medium transition-all duration-200"
                :class="scrolled ? 
                    '{{ request()->routeIs(['berita', 'berita.detail', 'berita.show']) || request()->is('berita*') ? 'bg-blue-500 text-white' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}' : 
                    '{{ request()->routeIs(['berita', 'berita.detail', 'berita.show']) || request()->is('berita*') ? 'bg-white/20 text-white border border-white/30' : 'text-white/90 hover:bg-white/10 hover:text-white' }}'">
                Berita
            </a>

            <!-- Mobile Layanan -->
            <a href="{{ route('layanan') }}"
                class="block rounded-md px-3 py-2 text-base font-medium transition-all duration-200"
                :class="scrolled ? 
                    '{{ request()->routeIs('layanan') ? 'bg-blue-500 text-white' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}' : 
                    '{{ request()->routeIs('layanan') ? 'bg-white/20 text-white border border-white/30' : 'text-white/90 hover:bg-white/10 hover:text-white' }}'">
                Layanan
            </a>

            <!-- Mobile Rumah Singgah -->
            <a href="{{ route('rumah-singgah') }}"
                class="block rounded-md px-3 py-2 text-base font-medium transition-all duration-200"
                :class="scrolled ? 
                    '{{ request()->routeIs('rumah-singgah') ? 'bg-blue-500 text-white' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}' : 
                    '{{ request()->routeIs('rumah-singgah') ? 'bg-white/20 text-white border border-white/30' : 'text-white/90 hover:bg-white/10 hover:text-white' }}'">
                Rumah Singgah
            </a>
        </div>
    </div>
</nav>