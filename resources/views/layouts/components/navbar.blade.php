<nav class="bg-white shadow-lg" x-data="{
        isOpen: false,
        profilOpen: false,
        ppidOpen: false,
        mobileProfilOpen: false,
        mobilePpidOpen: false
    }">

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <!-- <div class="shrink-0">
                    <img class="size-8" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company" />
                </div> -->
            </div>

            <div class="hidden md:block">
                <div class="flex items-baseline space-x-4">
                    <!-- Beranda - Active when on home page -->
                    <a href="/" class="rounded-md px-3 py-2 text-sm font-medium {{ request()->routeIs('home') || request()->is('/') ? 'bg-gray-900 text-white' : 'text-gray-900 hover:bg-gray-900 hover:text-white' }}"
                        {{ request()->routeIs('home') || request()->is('/') ? 'aria-current=page' : '' }}>
                        Beranda
                    </a>

                    <!-- Profil Dropdown - Always stays as dropdown, no active state -->
                    <div class="relative"
                        @mouseenter="profilOpen = true"
                        @mouseleave="profilOpen = false"
                        @click="profilOpen = !profilOpen">
                        <button class="flex items-center rounded-md px-3 py-2 text-sm font-medium transition-colors duration-200 
        {{ request()->routeIs(['profil.sambutan', 'profil.struktur', 'profil.pegawai', 'profil.visi-misi']) ? 'bg-gray-900 text-white' : 'text-gray-900 hover:bg-gray-900 hover:text-white' }}"
                            {{ request()->routeIs(['profil.sambutan', 'profil.struktur', 'profil.pegawai', 'profil.visi-misi']) ? 'aria-current=page' : '' }}>
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
                            class="absolute left-0 mt-2 w-56 bg-white rounded-md shadow-lg ring-1 ring-black/5 z-50">
                            <div class="py-1">
                                <a href="{{ route('profil.sambutan') }}"
                                    class="block px-4 py-2 text-sm transition-colors duration-200
                    {{ request()->routeIs('profil.sambutan') ? 'bg-gray-100 text-gray-900 font-medium' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
                                    <i class="fas fa-user-tie mr-2 text-gray-400"></i>
                                    Sambutan Kepala Dinas
                                </a>
                                <a href="{{ route('profil.struktur') }}"
                                    class="block px-4 py-2 text-sm transition-colors duration-200
                    {{ request()->routeIs('profil.struktur') ? 'bg-gray-100 text-gray-900 font-medium' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
                                    <i class="fas fa-sitemap mr-2 text-gray-400"></i>
                                    Struktur Organisasi
                                </a>
                                <a href="{{ route('profil.pegawai') }}"
                                    class="block px-4 py-2 text-sm transition-colors duration-200
                    {{ request()->routeIs('profil.pegawai') ? 'bg-gray-100 text-gray-900 font-medium' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
                                    <i class="fas fa-users mr-2 text-gray-400"></i>
                                    Daftar Pegawai
                                </a>
                                <a href="{{ route('profil.visi-misi') }}"
                                    class="block px-4 py-2 text-sm transition-colors duration-200
                    {{ request()->routeIs('profil.visi-misi') ? 'bg-gray-100 text-gray-900 font-medium' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
                                    <i class="fas fa-bullseye mr-2 text-gray-400"></i>
                                    Visi dan Misi
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Berita - Active when on berita page -->
                    <a href="{{ route('berita') }}" class="rounded-md px-3 py-2 text-sm font-medium {{ request()->routeIs('berita') ? 'bg-gray-900 text-white' : 'text-gray-900 hover:bg-gray-900 hover:text-white' }}"
                        {{ request()->routeIs('berita') ? 'aria-current=page' : '' }}>
                        Berita
                    </a>

                    <!-- Layanan - Active when on layanan page -->
                    <a href="{{ route('layanan') }}" class="rounded-md px-3 py-2 text-sm font-medium {{ request()->routeIs('layanan') ? 'bg-gray-900 text-white' : 'text-gray-900 hover:bg-gray-900 hover:text-white' }}"
                        {{ request()->routeIs('layanan') ? 'aria-current=page' : '' }}>
                        Layanan
                    </a>

                    <!-- Rumah singgah - Active when on rumah-singgah page -->
                    <a href="{{ route('rumah-singgah') }}" class="rounded-md px-3 py-2 text-sm font-medium {{ request()->routeIs('rumah-singgah') ? 'bg-gray-900 text-white' : 'text-gray-900 hover:bg-gray-900 hover:text-white' }}"
                        {{ request()->routeIs('rumah-singgah') ? 'aria-current=page' : '' }}>
                        Rumah Singgah
                    </a>
                </div>
            </div>

            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">
                    <!-- Profile dropdown -->
                    <div class="relative ml-3">
                        <div x-show="isOpen"
                            x-transition:enter="transition ease-out duration-100 transform"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75 transform"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5 focus:outline-hidden" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                        </div>
                    </div>
                </div>
            </div>

            <div class="-mr-2 flex md:hidden">
                <!-- Mobile menu button -->
                <button type="button" @click="isOpen = !isOpen" class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <!-- Menu open: "hidden", Menu closed: "block" -->
                    <svg :class="{'hidden': isOpen, 'block': !isOpen }" class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <!-- Menu open: "block", Menu closed: "hidden" -->
                    <svg :class="{'block': isOpen, 'hidden': !isOpen }" class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="relative">
        <div x-show="isOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform -translate-y-1"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-1"
            class="absolute top-0 left-0 right-0 bg-white shadow-lg z-50 md:hidden" id="mobile-menu">
            <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
                <!-- Mobile Beranda - Active when on home page -->
                <a href="/" class="block rounded-md px-3 py-2 text-base font-medium {{ request()->routeIs('home') || request()->is('/') ? 'bg-gray-900 text-white' : 'text-gray-900 hover:bg-gray-900 hover:text-white' }}"
                    {{ request()->routeIs('home') || request()->is('/') ? 'aria-current=page' : '' }}>
                    Beranda
                </a>

                <!-- Mobile Profil Dropdown - Always stays as dropdown -->
                <div class="relative">
                    <button @click="mobileProfilOpen = !mobileProfilOpen"
                        class="flex items-center justify-between w-full rounded-md px-3 py-2 text-base font-medium text-gray-900 hover:bg-gray-900 hover:text-white transition-colors duration-200
                        {{ request()->routeIs(['profil.sambutan', 'profil.struktur', 'profil.pegawai', 'profil.visi-misi']) ? 'bg-gray-900 text-white' : 'text-gray-900 hover:bg-gray-900 hover:text-white' }}"
                        {{ request()->routeIs(['profil.sambutan', 'profil.struktur', 'profil.pegawai', 'profil.visi-misi']) ? 'aria-current=page' : '' }}>
                        <span>Profil</span>
                        <svg class="h-4 w-4 transition-transform duration-200"
                            :class="{'rotate-180': mobileProfilOpen}"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Mobile Profil Dropdown Menu - Positioned absolutely -->
                    <div x-show="mobileProfilOpen"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform -translate-y-1"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform -translate-y-1"
                        class="absolute left-0 right-0 mt-1 bg-white border border-gray-200 rounded-md shadow-lg z-10">
                        <div class="py-1">
                            <a href="{{ route('profil.sambutan') }}" class="block px-4 py-2 text-sm transition-colors duration-200
                    {{ request()->routeIs('profil.sambutan') ? 'bg-gray-100 text-gray-900 font-medium' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
                                <i class="fas fa-user-tie mr-2 text-gray-400"></i>
                                Sambutan Kepala Dinas
                            </a>
                            <a href="{{ route('profil.struktur') }}" class="block px-4 py-2 text-sm transition-colors duration-200
                    {{ request()->routeIs('profil.struktur') ? 'bg-gray-100 text-gray-900 font-medium' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
                                <i class="fas fa-sitemap mr-2 text-gray-400"></i>
                                Struktur Organisasi
                            </a>
                            <a href="{{ route('profil.pegawai') }}" class="block px-4 py-2 text-sm transition-colors duration-200
                    {{ request()->routeIs('profil.pegawai') ? 'bg-gray-100 text-gray-900 font-medium' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
                                <i class="fas fa-users mr-2 text-gray-400"></i>
                                Daftar Pegawai
                            </a>
                            <a href="{{ route('profil.visi-misi') }}" class="block px-4 py-2 text-sm transition-colors duration-200
                    {{ request()->routeIs('profil.visi-misi') ? 'bg-gray-100 text-gray-900 font-medium' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
                                <i class="fas fa-bullseye mr-2 text-gray-400"></i>
                                Visi dan Misi
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Mobile PPID Dropdown -->
                <!-- <div class="relative">
                    <button @click="mobilePpidOpen = !mobilePpidOpen"
                        class="flex items-center justify-between w-full rounded-md px-3 py-2 text-base font-medium text-gray-900 hover:bg-gray-900 hover:text-white transition-colors duration-200">
                        <span>PPID</span>
                        <svg class="h-4 w-4 transition-transform duration-200"
                            :class="{'rotate-180': mobilePpidOpen}"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button> -->

                <!-- Mobile PPID Dropdown Menu - Positioned absolutely -->
                <!-- <div x-show="mobilePpidOpen"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform -translate-y-1"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform -translate-y-1"
                        class="absolute left-0 right-0 mt-1 bg-white border border-gray-200 rounded-md shadow-lg z-10">
                        <div class="py-1">
                            <a href="#" class="flex items-center px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                                <i class="fas fa-info-circle mr-2 text-gray-400"></i>
                                Profil PPID
                            </a>
                            <a href="#" class="flex items-center px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                                <i class="fas fa-gavel mr-2 text-gray-400"></i>
                                Dasar Hukum PPID
                            </a>
                            <a href="#" class="flex items-center px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                                <i class="fas fa-file-alt mr-2 text-gray-400"></i>
                                Informasi Publik
                            </a>
                            <a href="#" class="flex items-center px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                                <i class="fas fa-download mr-2 text-gray-400"></i>
                                Permohonan Informasi
                            </a>
                            <a href="#" class="flex items-center px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                                <i class="fas fa-exclamation-triangle mr-2 text-gray-400"></i>
                                Keberatan Informasi
                            </a>
                            <a href="#" class="flex items-center px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                                <i class="fas fa-chart-bar mr-2 text-gray-400"></i>
                                Laporan Layanan PPID
                            </a>
                        </div>
                    </div>
                </div> -->

                <!-- Mobile Berita - Active when on berita page -->
                <a href="{{ route('berita') }}" class="block rounded-md px-3 py-2 text-base font-medium {{ request()->routeIs('berita') ? 'bg-gray-900 text-white' : 'text-gray-900 hover:bg-gray-900 hover:text-white' }}"
                    {{ request()->routeIs('berita') ? 'aria-current=page' : '' }}>
                    Berita
                </a>

                <!-- Mobile Layanan - Active when on layanan page -->
                <a href="{{ route('layanan') }}" class="block rounded-md px-3 py-2 text-base font-medium {{ request()->routeIs('layanan') ? 'bg-gray-900 text-white' : 'text-gray-900 hover:bg-gray-900 hover:text-white' }}"
                    {{ request()->routeIs('layanan') ? 'aria-current=page' : '' }}>
                    Layanan
                </a>

                <!-- Mobile Rumah Singgah - Active when on rumah-singgah page -->
                <a href="{{ route('rumah-singgah') }}" class="block rounded-md px-3 py-2 text-base font-medium {{ request()->routeIs('rumah-singgah') ? 'bg-gray-900 text-white' : 'text-gray-900 hover:bg-gray-900 hover:text-white' }}"
                    {{ request()->routeIs('rumah-singgah') ? 'aria-current=page' : '' }}>
                    Rumah Singgah
                </a>
            </div>
        </div>
    </div>
</nav>