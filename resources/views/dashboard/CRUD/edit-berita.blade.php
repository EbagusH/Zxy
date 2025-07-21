@extends('dashboard.layouts-admin.admin')

@section('title', 'Edit Berita dan Artikel - Dinas Sosial Kota Majalengka')

@section('content')
<div class="p-6">
    <!-- Tombol Kembali -->
    <div class="flex items-center space-x-3">
        <!-- Tambah Baru -->
        <a href="{{ route('dashboard.berita-admin') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali
        </a>
    </div>
</div>
@endsection