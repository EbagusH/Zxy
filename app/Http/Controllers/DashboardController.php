<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\SambutanKepalaDinas;
use App\Models\StrukturOrganisasi;
use App\Models\DaftarPegawai;
use App\Models\VisiMisi;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data untuk card statistik
        $data = [
            'sambutan_aktif' => SambutanKepalaDinas::count(),
            'struktur_organisasi' => StrukturOrganisasi::count(),
            'pegawai_terdaftar' => DaftarPegawai::count(),
            'visi_misi_aktif' => VisiMisi::count(),
        ];

        // Ambil berita terbaru untuk tabel
        $beritaTerbaru = Berita::where('kategori', 'berita')
            ->select('judul', 'kategori', 'created_at as tanggal_posting')
            ->latest()
            ->first();

        // Ambil artikel terbaru untuk tabel
        $artikelTerbaru = Berita::where('kategori', 'artikel')
            ->select('judul', 'kategori', 'created_at as tanggal_posting')
            ->latest()
            ->first();

        // Gabungkan berita dan artikel dalam satu collection untuk ditampilkan di tabel
        $beritaDanArtikel = collect();
        if ($beritaTerbaru) {
            $beritaDanArtikel->push($beritaTerbaru);
        }
        if ($artikelTerbaru) {
            $beritaDanArtikel->push($artikelTerbaru);
        }

        return view('dashboard.index-admin', compact('data', 'beritaTerbaru', 'artikelTerbaru', 'beritaDanArtikel'));
    }
}
