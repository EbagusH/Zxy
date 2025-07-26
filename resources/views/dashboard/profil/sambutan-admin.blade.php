@extends('dashboard.layouts-admin.admin')

@section('title', 'Sambutan - Dinas Sosial Kota Majalengka')

@section('content')
<div class="p-6 flex justify-center">
    <!-- Card Form -->
    <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-3xl">
        <!-- Header -->
        <div class="mb-6 text-center">
            <h1 class="text-2xl font-bold text-gray-900">Sambutan Kepala Dinas Sosial</h1>
        </div>

        <!-- Form Edit -->
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Foto Kepala Dinas -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Foto Kepala Dinas</label>
                <img src="" alt="Foto Kepala Dinas" class="w-32 h-32 object-cover rounded mb-2">
                <input type="file" name="foto" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
            </div>

            <!-- Nama Kepala Dinas -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Nama Kepala Dinas</label>
                <input type="text" name="nama_kepala_dinas" value="" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-500">
            </div>

            <!-- Jabatan -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Jabatan</label>
                <input type="text" name="jabatan" value="" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-500">
            </div>

            <!-- Isi Sambutan -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Isi Sambutan</label>
                <textarea name="isi_sambutan" rows="6" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-500"></textarea>
            </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection