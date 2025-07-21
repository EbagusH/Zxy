<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>@yield('title', 'Dinas Sosial Kota Majalengka')</title>
    <style>
        @keyframes scrollUp {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-100%);
            }

            100% {
                transform: translateY(0);
            }
        }

        .animate-scrollUp {
            animation: scrollUp 6s infinite;
        }
    </style>
</head>

<body class="h-full">
    <div class="min-h-full">
        <!-- Include Navbar -->
        @include('layouts.components.navbar')

        <!-- Include Header (jika ada) -->
        @hasSection('header')
        @include('layouts.components.header')
        @endif

        <!-- Main Content -->
        <main class="@yield('main-class', 'bg-gray-50')">
            @yield('content')
        </main>

        <!-- Include Footer -->
        @include('layouts.components.footer')
    </div>
</body>

</html>