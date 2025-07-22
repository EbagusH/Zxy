<!-- Sidebar -->
<div class="w-64 bg-white shadow-lg h-screen">
    <div class="p-6">
        <h1 class="text-2xl font-bold text-gray-800">Logo</h1>
    </div>
    <nav class="mt-6">
        <!-- Dashboard -->
        <div class="px-6 py-3 {{ request()->routeIs('dashboard.index-admin') ? 'bg-blue-50 border-r-4 border-blue-500' : 'hover:bg-gray-50' }} transition-colors">
            <a href="{{ route('dashboard.index-admin') }}" class="flex items-center {{ request()->routeIs('dashboard.index-admin') ? 'text-blue-600 font-medium' : 'text-gray-600 hover:text-gray-800' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v0a2 2 0 01-2 2H10a2 2 0 01-2-2v0zM12 12h.01M16 12h.01M8 12h.01M12 16h.01M16 16h.01M8 16h.01"></path>
                </svg>
                Dashboard
            </a>
        </div>

        <!-- Profil with Dropdown -->
        <div class="relative">
            <div class="px-6 py-3 {{ request()->routeIs(['dashboard.profil.sambutan', 'dashboard.profil.struktur', 'dashboard.profil.pegawai', 'dashboard.profil.visimisi']) ? 'bg-blue-50 border-r-4 border-blue-500' : 'hover:bg-gray-50' }} transition-colors cursor-pointer" onclick="toggleDropdown('profileDropdown')">
                <div class="flex items-center justify-between {{ request()->routeIs(['dashboard.profil.sambutan', 'dashboard.profil.struktur', 'dashboard.profil.pegawai', 'dashboard.profil.visimisi']) ? 'text-blue-600 font-medium' : 'text-gray-600 hover:text-gray-800' }}">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Profil
                    </div>
                    <svg id="profileArrow" class="w-4 h-4 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
            </div>

            <!-- Dropdown Menu -->
            <div id="profileDropdown" class="hidden bg-gray-50 border-l-4 border-gray-300">
                <a href="{{ route('dashboard.profil.sambutan') }}" class="block px-12 py-2 text-sm {{ request()->routeIs('dashboard.profil.sambutan') ? 'bg-gray-100 text-gray-900 font-medium' : 'text-gray-600 hover:text-gray-800 hover:bg-gray-100' }} transition-colors">
                    Sambutan Kepala Dinas
                </a>
                <a href="{{ route('dashboard.profil.struktur') }}" class="block px-12 py-2 text-sm {{ request()->routeIs('dashboard.profil.struktur') ? 'bg-gray-100 text-gray-900 font-medium' : 'text-gray-600 hover:text-gray-800 hover:bg-gray-100' }} transition-colors">
                    Struktur Organisasi
                </a>
                <a href="{{ route('dashboard.profil.pegawai') }}" class="block px-12 py-2 text-sm {{ request()->routeIs('dashboard.profil.pegawai') ? 'bg-gray-100 text-gray-900 font-medium' : 'text-gray-600 hover:text-gray-800 hover:bg-gray-100' }} transition-colors">
                    Daftar Pegawai
                </a>
                <a href="{{ route('dashboard.profil.visimisi') }}" class="block px-12 py-2 text-sm {{ request()->routeIs('dashboard.profil.visimisi') ? 'bg-gray-100 text-gray-900 font-medium' : 'text-gray-600 hover:text-gray-800 hover:bg-gray-100' }} transition-colors">
                    Visi dan Misi
                </a>
            </div>
        </div>

        <!-- Berita -->
        <div class="px-6 py-3 {{ request()->routeIs('dashboard.berita-admin') ? 'bg-blue-50 border-r-4 border-blue-500' : 'hover:bg-gray-50' }} transition-colors">
            <a href="{{ route('dashboard.berita-admin') }}" class="flex items-center {{ request()->routeIs('dashboard.berita-admin') ? 'text-blue-600 font-medium' : 'text-gray-600 hover:text-gray-800' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
                Berita
            </a>
        </div>

        <!-- Layanan -->
        <div class="px-6 py-3 {{ request()->routeIs('dashboard.layanan-admin') ? 'bg-blue-50 border-r-4 border-blue-500' : 'hover:bg-gray-50' }} transition-colors">
            <a href="{{ route('dashboard.layanan-admin') }}" class="flex items-center {{ request()->routeIs('dashboard.layanan-admin') ? 'text-blue-600 font-medium' : 'text-gray-600 hover:text-gray-800' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                Layanan
            </a>
        </div>

        <!-- Rumah Singgah -->
        <div class="px-6 py-3 {{ request()->routeIs('dashboard.rumah-singgah-admin') ? 'bg-blue-50 border-r-4 border-blue-500' : 'hover:bg-gray-50' }} transition-colors">
            <a href="{{ route('dashboard.rumah-singgah-admin') }}" class="flex items-center {{ request()->routeIs('dashboard.rumah-singgah-admin') ? 'text-blue-600 font-medium' : 'text-gray-600 hover:text-gray-800' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Rumah Singgah
            </a>
        </div>
    </nav>
</div>