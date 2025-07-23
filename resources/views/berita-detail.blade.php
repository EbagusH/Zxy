@extends('layouts.app')
@section('title', $berita->judul . ' - Dinas Sosial Kota Majalengka')
@section('content')
<!-- Hero Section with Background Image -->
<div class="relative h-96 bg-cover bg-center bg-no-repeat" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://i.ytimg.com/vi/aKeSm4BUFCk/maxresdefault.jpg');">
    <div class="absolute inset-0 flex items-center justify-center">
        <div class="text-center text-white">
            <h1 class="text-5xl font-bold mb-4">Detail Berita dan Artikel</h1>
        </div>
    </div>
</div>

<div class="py-16">
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <!-- <nav class="mb-8">
            <ol class="flex items-center space-x-2 text-sm text-gray-500">
                <li><a href="{{ route('home') }}" class="hover:text-gray-700">Beranda</a></li>
                <li>/</li>
                <li><a href="{{ route('berita') }}" class="hover:text-gray-700">Berita</a></li>
                <li>/</li>
                <li class="text-gray-900">{{ Str::limit($berita->judul, 50) }}</li>
            </ol>
        </nav> -->

        <!-- Featured Image -->
        @if($berita->foto)
        <div class="mb-8">
            <img src="{{ asset('storage/' . $berita->foto) }}" alt="{{ $berita->judul }}" class="w-full h-96 object-cover rounded-lg shadow-lg">
        </div>
        @endif

        <!-- Article Header -->
        <div class="mb-8">
            <!-- Category Badge -->
            <div class="mb-4">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $berita->kategori === 'berita' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                    {{ ucfirst($berita->kategori) }}
                </span>
            </div>

            <!-- Title -->
            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $berita->judul }}</h1>

            <!-- Meta Info -->
            <div class="flex items-center text-sm text-gray-500 mb-6">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Dipublikasikan pada {{ $berita->created_at->format('d F Y') }}
            </div>
        </div>

        <!-- Article Content -->
        <div class="prose prose-lg max-w-none mb-12">
            {!! nl2br(e($berita->isi)) !!}
        </div>

        <!-- Back Button -->
        <div class="border-t pt-8">
            <a href="{{ route('berita') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar Berita
            </a>
        </div>
    </div>
</div>

@endsection