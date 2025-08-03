@extends('dashboard.layouts-admin.admin')

@section('title', 'Dashboard - Dinas Sosial Kota Majalengka')

@section('content')
<!-- Dashboard Content -->
<div class="p-6">
    <!-- Header Selamat Datang -->
    @auth
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Selamat Datang, {{ Auth::user()->name }} !</h1>
        <p class="text-sm text-gray-500">Ringkasan Data Sistem Informasi Dinas Sosial</p>
    </div>
    @endauth

    <!-- Kartu Statistik dengan spacing yang lebih baik -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <div class="text-purple-600 text-3xl mb-3">👥</div>
            <p class="text-2xl font-semibold text-gray-800 mb-1">{{ $data['pegawai_terdaftar'] }}</p>
            <p class="text-sm text-gray-500">Pegawai terdaftar</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <div class="text-green-600 text-3xl mb-3">📄</div>
            <p class="text-2xl font-semibold text-gray-800 mb-1">{{ $data['layanan_tersedia'] }}</p>
            <p class="text-sm text-gray-500">Layanan Tersedia</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <div class="text-green-600 text-3xl mb-3">📰</div>
            <p class="text-2xl font-semibold text-gray-800 mb-1">{{ $data['berita_artikel_tersedia'] }}</p>
            <p class="text-sm text-gray-500">Berita dan Artikel Tersedia</p>
        </div>
    </div>

    <!-- Berita dan Artikel Terbaru -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Berita dan Artikel Terbaru</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-600">
                <thead>
                    <tr class="text-gray-500 border-b">
                        <th class="py-3">Judul</th>
                        <th class="py-3">Kategori</th>
                        <th class="py-3">Upload</th>
                        <th class="py-3">Tanggal Posting</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($beritaDanArtikel as $item)
                    <tr class="{{ !$loop->last ? 'border-b' : '' }}">
                        <td class="py-3">{{ $item->judul }}</td>
                        <td class="py-3 capitalize">{{ $item->kategori }}</td>
                        <td class="py-3">
                            <span class="text-gray-500 font-medium">
                                {{ \Carbon\Carbon::parse($item->tanggal_posting)->format('d M Y') }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="py-3 text-center text-gray-500">Belum ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Tombol Aksi -->
<div class="flex flex-wrap gap-4">
    <a href="{{ route('dashboard.crud-berita') }}" class="px-6 py-3 bg-purple-100 text-purple-700 font-medium rounded-lg hover:bg-purple-200 transition-colors duration-200">
        ➕ Tambah Berita Baru
    </a>
    <a href="{{ route('dashboard.layanan.create') }}" class="px-6 py-3 bg-yellow-100 text-yellow-700 font-medium rounded-lg hover:bg-yellow-200 transition-colors duration-200">
        📝 Tambah Layanan Baru
    </a>
    <a href="{{ route('dashboard.edit-header') }}" class="px-6 py-3 bg-blue-100 text-blue-700 font-medium rounded-lg hover:bg-blue-200 transition-colors duration-200">
        🖼️ Edit Gambar Header
    </a>
</div>
</div>
@endsection