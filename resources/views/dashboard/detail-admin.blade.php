@extends('dashboard.layouts-admin.admin')

@section('title', 'Profil Admin - Dinas Sosial Kabupaten Majalengka')

@section('content')
<div class="p-6 bg-white shadow rounded max-w-xl mx-auto">

    {{-- Alert sukses --}}
    @if (session('success'))
    <div id="alertSuccess" class="mb-4 px-4 py-3 rounded relative bg-green-100 border border-green-400 text-green-800" role="alert">
        <strong class="font-bold">Berhasil!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
        <button onclick="document.getElementById('alertSuccess').remove();" class="absolute top-0 bottom-0 right-0 px-4 py-3 text-green-700">
            <svg class="fill-current h-6 w-6" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title>Tutup</title>
                <path d="M14.348 5.652a1 1 0 10-1.414-1.414L10 7.586 7.066 4.652a1 1 0 10-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 12.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934z" />
            </svg>
        </button>
    </div>
    @endif

    <h1 class="text-2xl font-bold mb-6 text-center">Profil {{ Auth::user()->name }}</h1>

    <div class="flex flex-col items-center space-y-4 mb-6">
        <!-- Foto Profil dengan Icon Kamera -->
        <div class="relative w-28 h-28">
            @if ($admin->profile_foto)
            <!-- Jika ada foto -->
            <img
                src="{{ asset('storage/foto/' . $admin->profile_foto) }}"
                alt="Foto Profil"
                class="w-28 h-28 rounded-full object-cover ring-2 ring-blue-500" />
            @else
            <!-- Jika tidak ada foto -->
            <div class="w-28 h-28 rounded-full bg-gray-600 flex items-center justify-center ring-2 ring-blue-500">
                <svg class="h-12 w-12 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            @endif

            <!-- Tombol Kamera -->
            <label for="foto" class="absolute bottom-0 right-0 bg-white rounded-full p-1 shadow cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 5c1.7 0 3.3.7 4.5 1.9l1.4-1.4C16.6 3.3 14.4 2.5 12 2.5S7.4 3.3 6.1 5.5l1.4 1.4C8.7 5.7 10.3 5 12 5zm7 2h-1.3l-.9-1.3C16.5 5.3 14.3 4.5 12 4.5S7.5 5.3 6.2 5.7L5.3 7H4c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2zm0 12H4V9h16v10zm-8-9c-2.2 0-4 1.8-4 4s1.8 4 4 4 4-1.8 4-4-1.8-4-4-4zm0 6.5c-1.4 0-2.5-1.1-2.5-2.5S9.6 11.5 11 11.5s2.5 1.1 2.5 2.5S12.4 17.5 11 17.5z" />
                </svg>
            </label>

            <!-- Form Upload Foto -->
            <form id="uploadForm" method="POST" action="{{ route('admin.updateFoto') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input
                    type="file"
                    name="foto"
                    id="foto"
                    accept="image/*"
                    class="hidden"
                    onchange="document.getElementById('uploadForm').submit();" />
            </form>
        </div>

        <!-- Nama dan Email -->
        <div class="text-center space-y-1">
            <p class="text-lg font-semibold">{{ $admin->name }}</p>
            <p class="text-gray-600">{{ $admin->email }}</p>
        </div>
    </div>

    <!-- Reset Password Section -->
    <div x-data="{ openReset: false }" class="mt-6">
        <button
            @click="openReset = !openReset"
            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">
            Reset Password
        </button>

        <form
            x-show="openReset"
            x-transition
            method="POST"
            action="{{ route('admin.updatePassword') }}"
            class="mt-4 space-y-3">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700">Password Baru</label>
                <input
                    type="password"
                    name="password"
                    required
                    class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input
                    type="password"
                    name="password_confirmation"
                    required
                    class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring focus:ring-blue-300">
            </div>

            <button
                type="submit"
                class="w-full py-2 px-4 bg-green-600 text-white rounded hover:bg-green-700 transition">
                Simpan Password Baru
            </button>
        </form>
    </div>
</div>
@endsection

<script>
    setTimeout(() => {
        const alert = document.getElementById('alertSuccess');
        if (alert) {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }
    }, 3000);
</script>