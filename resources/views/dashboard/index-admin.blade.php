@extends('dashboard.layouts-admin.admin')

@section('title', 'Dashboard - Dinas Sosial Kota Majalengka')

@section('content')
<!-- Dashboard Content -->
<div class="p-6">
    <!-- Header Selamat Datang -->
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Selamat Datang, Admin!</h1>
        <p class="text-sm text-gray-500">Ringkasan Data Sistem Informasi Dinas Sosial</p>
    </div>

    <!-- Kartu Statistik -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div class="bg-white rounded-lg shadow p-4 text-center">
            <div class="text-red-500 text-2xl mb-2">📌</div>
            <p class="text-xl font-semibold text-gray-800">1</p>
            <p class="text-sm text-gray-500">Sambutan aktif</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4 text-center">
            <div class="text-cyan-600 text-2xl mb-2">🧩</div>
            <p class="text-xl font-semibold text-gray-800">1</p>
            <p class="text-sm text-gray-500">Struktur organisasi tersedia</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4 text-center">
            <div class="text-purple-600 text-2xl mb-2">👥</div>
            <p class="text-xl font-semibold text-gray-800">18</p>
            <p class="text-sm text-gray-500">Pegawai terdaftar</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4 text-center">
            <div class="text-green-600 text-2xl mb-2">🎯</div>
            <p class="text-xl font-semibold text-gray-800">1</p>
            <p class="text-sm text-gray-500">Visi Misi aktif</p>
        </div>
    </div>

    <!-- Grafik (Dummy) -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Grafik Pengajuan Layanan</h2>
        <img src="https://quickchart.io/chart?c={type:'line',data:{labels:['Jul 21','Jul 23','Jul 24','Jul 25','Jul 26','Jul 27'],datasets:[{label:'Pengajuan',data:[2,4,15,6,2,2]}]}}" alt="Grafik Layanan" class="w-full">
    </div>

    <!-- Tabel Ringkasan -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Pengajuan Layanan Terbaru -->
        <div class="bg-white rounded-lg shadow p-4">
            <h2 class="text-lg font-semibold text-gray-800 mb-2">Pengajuan Layanan Terbaru</h2>
            <table class="w-full text-sm text-left text-gray-600">
                <thead>
                    <tr class="text-gray-500 border-b">
                        <th class="py-2">Nama Pemohon</th>
                        <th class="py-2">Jenis Layanan</th>
                        <th class="py-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b">
                        <td class="py-2">Budi</td>
                        <td>Bantuan Sosial</td>
                        <td><span class="text-yellow-600 font-medium">Menunggu</span></td>
                    </tr>
                    <tr>
                        <td class="py-2">Siti</td>
                        <td>Konsultasi</td>
                        <td><span class="text-green-600 font-medium">Diterima</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Berita Terbaru -->
        <div class="bg-white rounded-lg shadow p-4">
            <h2 class="text-lg font-semibold text-gray-800 mb-2">Berita dan Artikel Terbaru</h2>
            <table class="w-full text-sm text-left text-gray-600">
                <thead>
                    <tr class="text-gray-500 border-b">
                        <th class="py-2">Judul</th>
                        <th class="py-2">Kategori</th>
                        <th class="py-2">Tanggal Posting</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b">
                        <td class="py-2">Bakti Sosial 2025</td>
                        <td>Berita</td>
                        <td><span class="text-gray-500 font-medium">20 Juli 2025</span></td>
                    </tr>
                    <tr>
                        <td class="py-2">Layanan Digital</td>
                        <td>Artikel</td>
                        <td><span class="text-gray-500 font-medium">19 Juli 2025</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tombol Aksi -->
    <div class="flex flex-wrap gap-4 pt-2">
        <a href="{{ route('dashboard.crud-berita') }}" class="px-4 py-2 bg-purple-100 text-purple-700 font-medium rounded hover:bg-purple-200">
            ➕ Tambah Berita Baru
        </a>
        <a href="{{ route('dashboard.layanan-admin') }}" class="px-4 py-2 bg-yellow-100 text-yellow-700 font-medium rounded hover:bg-yellow-200">
            📝 Lihat Pengajuan Layanan
        </a>
    </div>
</div>
@endsection