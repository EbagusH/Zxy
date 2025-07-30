<!-- Mobile Header (only visible on mobile) -->
<div class="lg:hidden bg-white shadow-lg p-4 flex items-center justify-between fixed top-0 left-0 right-0 z-50">
    <h1 class="text-xl font-bold text-gray-800">Logo</h1>
    <button id="mobileMenuBtn" class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-none">
        <span class="absolute -inset-0.5"></span>
        <span class="sr-only">Open main menu</span>
        <!-- Menu closed: "block", Menu open: "hidden" -->
        <svg id="hamburgerIcon" class="block w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
        <!-- Menu open: "block", Menu closed: "hidden" -->
        <svg id="closeIcon" class="hidden w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg>
    </button>
</div>

<!-- Mobile Overlay -->
<div id="mobileOverlay" class="lg:hidden fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>

<!-- Sidebar -->
<div id="sidebar" class="fixed lg:relative inset-y-0 left-0 z-50 w-64 bg-white shadow-lg h-screen transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out lg:flex lg:flex-col">
    <!-- Desktop Logo (hidden on mobile) -->
    <div class="hidden lg:block p-6">
        <h1 class="text-2xl font-bold text-gray-800">Logo</h1>
    </div>

    <!-- Mobile Logo (visible on mobile) -->
    <div class="lg:hidden p-4 border-b border-gray-200">
        <h1 class="text-xl font-bold text-gray-800">Logo</h1>
    </div>

    <nav class="flex-1 mt-2 lg:mt-6 overflow-y-auto pb-4">
        <!-- Dashboard -->
        <div class="px-6 py-3 {{ request()->routeIs('dashboard.index-admin') ? 'bg-blue-50 border-r-4 border-blue-500' : 'hover:bg-gray-50' }} transition-colors">
            <a href="{{ route('dashboard.index-admin') }}" class="flex items-center {{ request()->routeIs('dashboard.index-admin') ? 'text-blue-600 font-medium' : 'text-gray-600 hover:text-gray-800' }}" onclick="closeMobileMenu()">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v0a2 2 0 01-2 2H10a2 2 0 01-2-2v0zM12 12h.01M16 12h.01M8 12h.01M12 16h.01M16 16h.01M8 16h.01"></path>
                </svg>
                Dashboard
            </a>
        </div>

        <!-- Profil with Dropdown -->
        <div class="relative">
            <div class="px-6 py-3 {{ request()->routeIs(['dashboard.profil.sambutan', 'dashboard.profil.struktur', 'dashboard.profil.pegawai-admin', 'dashboard.profil.visimisi']) ? 'bg-blue-50 border-r-4 border-blue-500' : 'hover:bg-gray-50' }} transition-colors cursor-pointer" onclick="toggleDropdown('profileDropdown')">
                <div class="flex items-center justify-between {{ request()->routeIs(['dashboard.profil.sambutan', 'dashboard.profil.struktur', 'dashboard.profil.pegawai-admin', 'dashboard.profil.visimisi']) ? 'text-blue-600 font-medium' : 'text-gray-600 hover:text-gray-800' }}">
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
                <a href="{{ route('dashboard.profil.sambutan') }}" class="block px-12 py-2 text-sm {{ request()->routeIs('dashboard.profil.sambutan') ? 'bg-gray-100 text-gray-900 font-medium' : 'text-gray-600 hover:text-gray-800 hover:bg-gray-100' }} transition-colors" onclick="closeMobileMenu()">
                    Sambutan Kepala Dinas
                </a>
                <a href="{{ route('dashboard.profil.struktur') }}" class="block px-12 py-2 text-sm {{ request()->routeIs('dashboard.profil.struktur') ? 'bg-gray-100 text-gray-900 font-medium' : 'text-gray-600 hover:text-gray-800 hover:bg-gray-100' }} transition-colors" onclick="closeMobileMenu()">
                    Struktur Organisasi
                </a>
                <a href="{{ route('dashboard.profil.pegawai-admin') }}" class="block px-12 py-2 text-sm {{ request()->routeIs('dashboard.profil.pegawai-admin') ? 'bg-gray-100 text-gray-900 font-medium' : 'text-gray-600 hover:text-gray-800 hover:bg-gray-100' }} transition-colors" onclick="closeMobileMenu()">
                    Daftar Pegawai
                </a>
                <a href="{{ route('dashboard.profil.visimisi') }}" class="block px-12 py-2 text-sm {{ request()->routeIs('dashboard.profil.visimisi') ? 'bg-gray-100 text-gray-900 font-medium' : 'text-gray-600 hover:text-gray-800 hover:bg-gray-100' }} transition-colors" onclick="closeMobileMenu()">
                    Visi dan Misi
                </a>
                <a href="#" class="block px-12 py-2 text-sm ? 'bg-gray-100 text-gray-900 font-medium' : 'text-gray-600 hover:text-gray-800 hover:bg-gray-100' }} transition-colors" onclick="closeMobileMenu()">
                    Bidang Linjamsos
                </a>
                <a href="#" class="block px-12 py-2 text-sm ? 'bg-gray-100 text-gray-900 font-medium' : 'text-gray-600 hover:text-gray-800 hover:bg-gray-100' }} transition-colors" onclick="closeMobileMenu()">
                    Bidang Dayasos
                </a>
                <a href="#" class="block px-12 py-2 text-sm ? 'bg-gray-100 text-gray-900 font-medium' : 'text-gray-600 hover:text-gray-800 hover:bg-gray-100' }} transition-colors" onclick="closeMobileMenu()">
                    Bidang Resos
                </a>
            </div>
        </div>

        <!-- Berita -->
        <div class="px-6 py-3 {{ request()->routeIs('dashboard.berita-admin') ? 'bg-blue-50 border-r-4 border-blue-500' : 'hover:bg-gray-50' }} transition-colors">
            <a href="{{ route('dashboard.berita-admin') }}" class="flex items-center {{ request()->routeIs('dashboard.berita-admin') ? 'text-blue-600 font-medium' : 'text-gray-600 hover:text-gray-800' }}" onclick="closeMobileMenu()">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
                Berita
            </a>
        </div>

        <!-- Layanan -->
        <div class="px-6 py-3 {{ request()->routeIs('dashboard.layanan-admin') ? 'bg-blue-50 border-r-4 border-blue-500' : 'hover:bg-gray-50' }} transition-colors">
            <a href="{{ route('dashboard.layanan-admin') }}" class="flex items-center {{ request()->routeIs('dashboard.layanan-admin') ? 'text-blue-600 font-medium' : 'text-gray-600 hover:text-gray-800' }}" onclick="closeMobileMenu()">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                Layanan
            </a>
        </div>

        <!-- Rumah Singgah -->
        <div class="px-6 py-3 {{ request()->routeIs('dashboard.rumah-singgah-admin') ? 'bg-blue-50 border-r-4 border-blue-500' : 'hover:bg-gray-50' }} transition-colors">
            <a href="{{ route('dashboard.rumah-singgah-admin') }}" class="flex items-center {{ request()->routeIs('dashboard.rumah-singgah-admin') ? 'text-blue-600 font-medium' : 'text-gray-600 hover:text-gray-800' }}" onclick="closeMobileMenu()">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Rumah Singgah
            </a>
        </div>
    </nav>
</div>

<script>
    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const sidebarCloseBtn = document.getElementById('sidebarCloseBtn');
    const sidebar = document.getElementById('sidebar');
    const mobileOverlay = document.getElementById('mobileOverlay');
    const hamburgerIcon = document.getElementById('hamburgerIcon');
    const closeIcon = document.getElementById('closeIcon');

    function toggleMobileMenu() {
        const isOpen = !sidebar.classList.contains('-translate-x-full');

        if (isOpen) {
            closeMobileMenu();
        } else {
            openMobileMenu();
        }
    }

    function openMobileMenu() {
        sidebar.classList.remove('-translate-x-full');
        mobileOverlay.classList.remove('hidden');
        hamburgerIcon.classList.add('hidden');
        hamburgerIcon.classList.remove('block');
        closeIcon.classList.remove('hidden');
        closeIcon.classList.add('block');
        // Prevent body scroll
        document.body.style.overflow = 'hidden';
    }

    function closeMobileMenu() {
        if (window.innerWidth < 1024) { // Only close on mobile
            sidebar.classList.add('-translate-x-full');
            mobileOverlay.classList.add('hidden');
            hamburgerIcon.classList.remove('hidden');
            hamburgerIcon.classList.add('block');
            closeIcon.classList.add('hidden');
            closeIcon.classList.remove('block');
            // Restore body scroll
            document.body.style.overflow = '';
        }
    }

    // Event listeners
    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', toggleMobileMenu);
    }

    if (sidebarCloseBtn) {
        sidebarCloseBtn.addEventListener('click', closeMobileMenu);
    }

    if (mobileOverlay) {
        mobileOverlay.addEventListener('click', closeMobileMenu);
    }

    // Close mobile menu on window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1024) {
            sidebar.classList.remove('-translate-x-full');
            mobileOverlay.classList.add('hidden');
            hamburgerIcon.classList.remove('hidden');
            hamburgerIcon.classList.add('block');
            closeIcon.classList.add('hidden');
            closeIcon.classList.remove('block');
            document.body.style.overflow = '';
        } else if (window.innerWidth < 1024) {
            // Ensure mobile menu is closed on smaller screens
            sidebar.classList.add('-translate-x-full');
            mobileOverlay.classList.add('hidden');
        }
    });

    // Initialize mobile state on page load
    document.addEventListener('DOMContentLoaded', function() {
        if (window.innerWidth < 1024) {
            sidebar.classList.add('-translate-x-full');
            mobileOverlay.classList.add('hidden');
        }
    });

    // Enhanced dropdown function (merging with your existing function)
    function toggleDropdown(dropdownId) {
        const dropdown = document.getElementById(dropdownId);
        const arrow = document.getElementById('profileArrow');

        if (dropdown.classList.contains('hidden')) {
            dropdown.classList.remove('hidden');
            arrow.classList.add('rotate-180');
        } else {
            dropdown.classList.add('hidden');
            arrow.classList.remove('rotate-180');
        }
    }

    // Enhanced click outside handler (merging with your existing function)
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('profileDropdown');
        const profileSection = event.target.closest('.relative');
        const sidebarElement = document.getElementById('sidebar');
        const mobileMenuButton = document.getElementById('mobileMenuBtn');

        // Handle dropdown close
        if (!profileSection && dropdown && !dropdown.classList.contains('hidden')) {
            dropdown.classList.add('hidden');
            const arrow = document.getElementById('profileArrow');
            if (arrow) {
                arrow.classList.remove('rotate-180');
            }
        }

        // Handle mobile menu close when clicking outside
        if (window.innerWidth < 1024) {
            const isClickInsideSidebar = sidebarElement && sidebarElement.contains(event.target);
            const isClickOnMenuButton = mobileMenuButton && mobileMenuButton.contains(event.target);
            const isSidebarOpen = sidebarElement && !sidebarElement.classList.contains('-translate-x-full');

            if (!isClickInsideSidebar && !isClickOnMenuButton && isSidebarOpen) {
                closeMobileMenu();
            }
        }
    });
</script>