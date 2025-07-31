<?php

namespace App\Http\Controllers;

use App\Models\RumahSinggah;
use App\Models\Berita;
use App\Models\Layanan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil data rumah singgah
        $rumahSinggah = RumahSinggah::first();

        // Ambil berita terbaru (sama seperti di BeritaController)
        $beritaTerbaru = Berita::where('kategori', 'berita')
            ->orderBy('created_at', 'desc')
            ->take(1)
            ->get();

        // Ambil artikel terbaru (sama seperti di BeritaController)
        $artikelTerbaru = Berita::where('kategori', 'artikel')
            ->orderBy('created_at', 'desc')
            ->take(1)
            ->get();

        // Ambil data layanan
        try {
            $layananTerbaru = Layanan::orderBy('created_at', 'desc')
                ->take(6)
                ->get();
        } catch (\Exception $e) {
            $layananTerbaru = collect();
        }

        return view('home', compact(
            'rumahSinggah',
            'beritaTerbaru',
            'artikelTerbaru',
            'layananTerbaru'
        ));
    }
}
