<?php

namespace App\Http\Controllers;

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

        return view('dashboard.index-admin', compact('data'));
    }
}
