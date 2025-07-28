@extends('layouts.app')

@section('title', 'Sambutan Kepala Dinas - Dinas Sosial Kota Majalengka')

@section('content')
<!-- Hero Section with Background Image -->
<div class="relative h-96 bg-cover bg-center bg-no-repeat" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://i.ytimg.com/vi/aKeSm4BUFCk/maxresdefault.jpg');">
    <div class="absolute inset-0 flex items-center justify-center">
        <div class="text-center text-white">
            <h1 class="text-5xl font-bold mb-4">Sambutan Kepala Dinas</h1>
        </div>
    </div>
</div>

<!-- Content Section -->
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content - Sambutan -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-lg p-8">
                @if($sambutan)
                <!-- Foto Kepala Dinas -->
                @if($sambutan->foto)
                <div class="mb-6 text-center">
                    <img src="{{ asset('storage/' . $sambutan->foto) }}"
                        alt="{{ $sambutan->nama_kepala_dinas }}"
                        class="w-full max-w-md mx-auto rounded-lg shadow-md">
                </div>
                @endif

                <!-- Nama dan Jabatan -->
                @if($sambutan->nama_kepala_dinas || $sambutan->jabatan)
                <div class="mb-8 text-center">
                    @if($sambutan->nama_kepala_dinas)
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">
                        {{ $sambutan->nama_kepala_dinas }}
                    </h3>
                    @endif
                    @if($sambutan->jabatan)
                    <p class="text-blue-600 font-medium text-lg">
                        {{ $sambutan->jabatan }}
                    </p>
                    @endif
                </div>
                @endif

                <!-- Isi Sambutan -->
                <div class="prose prose-lg max-w-none text-justify leading-relaxed">
                    {!! nl2br(e($sambutan->isi_sambutan)) !!}
                </div>
                @else
                <!-- Jika belum ada data sambutan -->
                <div class="text-center py-12">
                    <div class="mb-6">
                        <svg class="mx-auto h-24 w-24 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-medium text-gray-600 mb-2">Sambutan Kepala Dinas</h3>
                    <p class="text-gray-500">Informasi sambutan akan segera tersedia.</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="sticky top-6 space-y-6">
                <!-- Berita Terkini -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 border-b border-gray-200 pb-2">
                        Berita Terkini
                    </h3>
                    <div class="space-y-4">
                        <!-- Placeholder untuk berita terkini -->
                        <div class="text-gray-500 text-sm">
                            Berita terkini akan ditampilkan di sini
                        </div>
                    </div>
                </div>

                <!-- Artikel Terbaru -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 border-b border-gray-200 pb-2">
                        Artikel Terbaru
                    </h3>
                    <div class="space-y-4">
                        <!-- Placeholder untuk artikel terbaru -->
                        <div class="text-gray-500 text-sm">
                            Artikel terbaru akan ditampilkan di sini
                        </div>
                    </div>
                </div>

                <!-- Profil Menu -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 border-b border-gray-200 pb-2">
                        Menu Profil
                    </h3>
                    <div class="space-y-3">
                        <a href="{{ route('profil.sambutan') }}" class="flex items-center text-blue-600 hover:text-blue-800 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                            Sambutan Kepala Dinas
                        </a>
                        <a href="{{ route('profil.struktur') }}" class="flex items-center text-blue-600 hover:text-blue-800 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                            Struktur Organisasi
                        </a>
                        <a href="{{ route('profil.pegawai') }}" class="flex items-center text-blue-600 hover:text-blue-800 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                            Daftar Pegawai
                        </a>
                        <a href="{{ route('profil.visi-misi') }}" class="flex items-center text-blue-600 hover:text-blue-800 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                            Visi & Misi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection