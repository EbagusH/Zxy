@extends('dashboard.layouts-admin.admin')

@section('title', '' . $berita->judul . ' - Dinas Sosial Kota Majalengka')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header dengan Breadcrumb -->
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="flex items-center justify-between h-16">
            <div class="p-6">
                <!-- Tombol Kembali -->
                <div class="flex items-center space-x-3">
                    <a href="{{ route('dashboard.berita-admin') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Article -->
            <div class="lg:col-span-2">
                <article class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <!-- Featured Image -->
                    @if($berita->foto)
                    <div class="relative h-64 sm:h-80 md:h-96">
                        <img src="{{ asset('storage/berita/' . $berita->foto) }}"
                            alt="{{ $berita->judul }}"
                            class="w-full h-full object-cover"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                        <!-- Fallback jika gambar tidak ditemukan -->
                        <div class="absolute inset-0 bg-gray-200 flex items-center justify-center" style="display: none;">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    @else
                    <!-- Placeholder jika tidak ada gambar -->
                    <div class="relative h-64 sm:h-80 md:h-96 bg-gray-200 flex items-center justify-center">
                        <div class="text-center">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-gray-500 text-sm">Tidak ada gambar</p>
                        </div>
                    </div>
                    @endif

                    <!-- Article Content -->
                    <div class="p-6 sm:p-8">
                        <!-- Title -->
                        <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-4 leading-tight">
                            {{ $berita->judul }}
                        </h1>

                        <!-- Meta Information -->
                        <div class="flex flex-wrap items-center text-sm text-gray-500 mb-6 space-y-2 sm:space-y-0">
                            <div class="flex items-center mr-6">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>{{ $berita->author ?? 'Admin' }}</span>
                            </div>
                            <div class="flex items-center mr-6">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>{{ $berita->created_at->format('d F Y') }}</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>{{ $berita->updated_at->format('d F Y H:i') }}</span>
                            </div>
                        </div>

                        <!-- Category -->
                        @if($berita->kategori)
                        <div class="mb-6">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                {{ $berita->kategori }}
                            </span>
                        </div>
                        @endif

                        <!-- Excerpt -->
                        @if($berita->excerpt)
                        <div class="mb-6 p-4 bg-gray-50 rounded-lg border-l-4 border-indigo-500">
                            <p class="text-lg text-gray-700 italic leading-relaxed">
                                {{ $berita->excerpt }}
                            </p>
                        </div>
                        @endif

                        <hr>

                        <!-- Content -->
                        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                            @if($berita->isi)
                            {!! nl2br(e($berita->isi)) !!}
                            @else
                            <div class="text-center py-8">
                                <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-gray-500">Konten berita tidak tersedia</p>
                            </div>
                            @endif
                        </div>

                        <!-- Tags -->
                        @if($berita->tags)
                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <h3 class="text-sm font-medium text-gray-900 mb-3">Tags:</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach(explode(',', $berita->tags) as $tag)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    #{{ trim($tag) }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </article>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="sticky top-6 space-y-6">
                    <!-- Article Info Card -->
                    <div class="bg-white shadow-lg rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Artikel</h3>
                        <dl class="space-y-3">
                            <!-- Gambar Preview dalam Sidebar -->
                            @if($berita->gambar)
                            <div class="mb-4">
                                <dt class="text-sm font-medium text-gray-500 mb-2">Preview Gambar</dt>
                                <dd class="text-sm text-gray-900">
                                    <img src="{{ asset('storage/berita/' . $berita->gambar) }}"
                                        alt="{{ $berita->judul }}"
                                        class="w-full h-32 object-cover rounded-lg border border-gray-200"
                                        onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                    <div class="w-full h-32 bg-gray-200 rounded-lg border border-gray-200 flex items-center justify-center" style="display: none;">
                                        <span class="text-gray-500 text-xs">Gambar tidak ditemukan</span>
                                    </div>
                                </dd>
                            </div>
                            @endif
                            <div>
                                <dt class="text-sm font-medium text-gray-500">ID Artikel</dt>
                                <dd class="text-sm text-gray-900">#{{ $berita->id }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Dibuat</dt>
                                <dd class="text-sm text-gray-900">{{ $berita->created_at->format('d F Y, H:i') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Terakhir Diperbarui</dt>
                                <dd class="text-sm text-gray-900">{{ $berita->updated_at->format('d F Y, H:i') }}</dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white shadow-lg rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h3>
                        <div class="space-y-3">
                            <a href="{{ route('dashboard.berita-admin.edit', $berita->id) }}"
                                class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit Artikel
                            </a>
                            @if($berita->status === 'published')
                            <a href="{{ route('berita.show', $berita->slug) }}"
                                target="_blank"
                                class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2M7 7l10 10M17 7l-10 10"></path>
                                </svg>
                                Lihat di Website
                            </a>
                            @endif
                            <button type="button"
                                onclick="confirmDelete('{{ $berita->id }}')"
                                class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Hapus Artikel
                            </button>
                        </div>
                    </div>

                    <!-- SEO Info (jika ada) -->
                    @if($berita->meta_description || $berita->meta_keywords)
                    <div class="bg-white shadow-lg rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">SEO Information</h3>
                        @if($berita->meta_description)
                        <div class="mb-4">
                            <dt class="text-sm font-medium text-gray-500 mb-1">Meta Description</dt>
                            <dd class="text-sm text-gray-900">{{ $berita->meta_description }}</dd>
                        </div>
                        @endif
                        @if($berita->meta_keywords)
                        <div>
                            <dt class="text-sm font-medium text-gray-500 mb-1">Meta Keywords</dt>
                            <dd class="text-sm text-gray-900">{{ $berita->meta_keywords }}</dd>
                        </div>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.864-.833-2.634 0L3.228 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mt-5">Hapus Artikel</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">
                    Apakah Anda yakin ingin menghapus artikel ini? Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>
            <div class="items-center px-4 py-3">
                <button id="deleteConfirm" class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300 mr-2">
                    Hapus
                </button>
                <button id="deleteCancel" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Form untuk Delete -->
<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
    function confirmDelete(id) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        const confirmBtn = document.getElementById('deleteConfirm');
        const cancelBtn = document.getElementById('deleteCancel');

        // Set form action
        form.action = `/dashboard/berita-admin/${id}`;

        // Show modal
        modal.classList.remove('hidden');

        // Handle confirm
        confirmBtn.onclick = function() {
            form.submit();
        };

        // Handle cancel
        cancelBtn.onclick = function() {
            modal.classList.add('hidden');
        };

        // Close modal when clicking outside
        modal.onclick = function(event) {
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        };
    }
</script>
@endsection