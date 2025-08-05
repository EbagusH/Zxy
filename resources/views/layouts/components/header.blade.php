@php
$background_image = app(App\Http\Controllers\HeaderFotoController::class)->index();

// Konfigurasi teks untuk setiap halaman
$headerTexts = [
'home' => [
'title' => 'SELAMAT DATANG',
'subtitle' => 'WEBSITE DINAS SOSIAL KABUPATEN MAJALENGKA',
'description' => 'BERSAMA WUJUDKAN KESEJAHTERAAN SOSIAL DARI, OLEH, DAN UNTUK MASYARAKAT<br>MENUJU MAJALENGKA YANG UNGGUL, NYAMAN, DAN SEJAHTERA'
],
'berita' => [
'title' => 'BERITA DAN ARTIKEL TERBARU',
'subtitle' => 'DINAS SOSIAL KABUPATEN MAJALENGKA',
'description' => 'Informasi dan berita terkini seputar kegiatan dan program Dinas Sosial Kabupaten Majalengka'
],
'berita.show' => [
'title' => 'DETAIL BERITA DAN ARTIKEL',
'subtitle' => 'DINAS SOSIAL KABUPATEN MAJALENGKA',
'description' => 'Baca informasi lengkap mengenai berita dan artikel dari Dinas Sosial Kabupaten Majalengka'
],
'layanan' => [
'title' => 'LAYANAN KAMI',
'subtitle' => 'DINAS SOSIAL KABUPATEN MAJALENGKA',
'description' => 'Berbagai layanan sosial yang tersedia untuk masyarakat Kabupaten Majalengka'
],
'layanan.show' => [
'title' => 'DETAIL LAYANAN KAMI',
'subtitle' => 'DINAS SOSIAL KABUPATEN MAJALENGKA',
'description' => 'Informasi lengkap mengenai berbagai layanan sosial yang disediakan untuk mendukung kesejahteraan masyarakat Kabupaten Majalengka'
],
'rumah-singgah' => [
'title' => 'RUMAH SINGGAH HEGAR MAJALENGKA',
'subtitle' => 'DINAS SOSIAL KABUPATEN MAJALENGKA',
'description' => 'Fasilitas pelayanan sosial untuk memberikan perlindungan dan pendampingan kepada masyarakat'
],
'profil.sambutan' => [
'title' => 'SAMBUTAN KEPALA DINAS',
'subtitle' => 'DINAS SOSIAL KABUPATEN MAJALENGKA',
'description' => 'Kata sambutan dari Kepala Dinas Sosial Kabupaten Majalengka'
],
'profil.struktur' => [
'title' => 'STRUKTUR ORGANISASI',
'subtitle' => 'DINAS SOSIAL KABUPATEN MAJALENGKA',
'description' => 'Susunan organisasi Dinas Sosial Kabupaten Majalengka'
],
'profil.pegawai' => [
'title' => 'DAFTAR PEGAWAI',
'subtitle' => 'DINAS SOSIAL KABUPATEN MAJALENGKA',
'description' => 'Informasi lengkap mengenai pegawai Dinas Sosial Kabupaten Majalengka'
],
'profil.visi-misi' => [
'title' => 'VISI DAN MISI',
'subtitle' => 'DINAS SOSIAL KABUPATEN MAJALENGKA',
'description' => 'Sejarah, visi, dan misi Dinas Sosial Kabupaten Majalengka'
],
'profil.linjamsos' => [
'title' => 'Bidang Linjamsos',
'subtitle' => 'DINAS SOSIAL KABUPATEN MAJALENGKA',
'description' => 'Badan perlindungan dan Jaminan Sosial'
],
'profil.dayasos' => [
'title' => 'Bidang Dayasos',
'subtitle' => 'DINAS SOSIAL KABUPATEN MAJALENGKA',
'description' => 'Pemberdayaan Perempuan dan perlindungan Anak'
],
'profil.resos' => [
'title' => 'Bidang Resos',
'subtitle' => 'DINAS SOSIAL KABUPATEN MAJALENGKA',
'description' => 'Rehabilitasi Sosial'
]
];

// Ambil nama halaman dari parameter atau route name
$currentPage = $page ?? Route::currentRouteName() ?? 'home';

// Fallback ke 'home' jika halaman tidak ditemukan
$headerData = $headerTexts[$currentPage] ?? $headerTexts['home'];
@endphp

<header class="relative w-full">
    <!-- Background Image -->
    <img src="{{ $background_image }}" alt="Header Background" class="w-full h-auto min-h-96 object-cover">

    <!-- Dark overlay -->
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>

    <!-- Content -->
    <div class="absolute inset-0 z-10 flex items-center justify-center">
        <div class="text-center text-white px-4">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight">
                {{ $headerData['title'] }}
            </h1>
            <h2 class="text-2xl md:text-3xl font-semibold mb-6 leading-tight">
                {{ $headerData['subtitle'] }}
            </h2>
            <p class="text-lg md:text-xl max-w-4xl mx-auto leading-relaxed">
                {!! $headerData['description'] !!}
            </p>
        </div>
    </div>
</header>