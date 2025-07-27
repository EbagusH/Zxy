<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>@yield('title', 'Dinas Sosial Kota Majalengka')</title>
    <style>
        @media (max-width: 1023px) {
            body {
                overflow-x: hidden;
            }
        }
    </style>
</head>

<body class="h-full">
    <div class="flex h-screen bg-gray-50">
        <!-- Sidebar -->
        @include('dashboard.layouts-admin.components-admin.sidebar-admin')

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden lg:ml-0">
            <!-- Header (Desktop only, hidden on mobile) -->
            <div class="hidden lg:block">
                @include('dashboard.layouts-admin.components-admin.header-admin')
            </div>

            <!-- Dashboard Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 pt-16 lg:pt-0">
                <div class="px-4 sm:px-6 lg:px-8 py-6">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script>
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

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('profileDropdown');
            const profileSection = event.target.closest('.relative');

            if (!profileSection && !dropdown.classList.contains('hidden')) {
                dropdown.classList.add('hidden');
                document.getElementById('profileArrow').classList.remove('rotate-180');
            }
        });
    </script>

</body>

</html>