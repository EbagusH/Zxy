@extends('dashboard.layouts-admin.admin')

@section('title', 'Struktur Organisasi - Dinas Sosial Kota Majalengka')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">Struktur Organisasi Dinas Sosial</h1>
            <a href=""
                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition">
                Edit
            </a>
        </div>
    </div>

    <!-- Struktur Organisasi Image -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-center">
            <img src="{{ asset('storage/struktur-organisasi.jpg') }}" alt="Struktur Organisasi" class="max-w-full h-auto rounded-md shadow">
        </div>
    </div>
</div>
@endsection