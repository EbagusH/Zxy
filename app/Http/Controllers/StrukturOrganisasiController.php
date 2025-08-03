<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Layanan;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StrukturOrganisasiController extends Controller
{
    // Method untuk tampilan public
    public function index()
    {
        $struktur = StrukturOrganisasi::first();

        // Ambil berita terbaru untuk sidebar
        $beritaTerbaru = Berita::where('kategori', 'berita')
            ->latest()
            ->take(5)
            ->get();

        // Ambil artikel terbaru untuk sidebar
        $artikelTerbaru = Berita::where('kategori', 'artikel')
            ->latest()
            ->take(5)
            ->get();

        $layananTerbaru = Layanan::orderBy('created_at', 'desc')->take(5)->get();

        return view('profil-index.struktur', compact('struktur', 'beritaTerbaru', 'artikelTerbaru', 'layananTerbaru'));
    }

    // Method untuk edit admin
    public function edit()
    {
        $struktur = StrukturOrganisasi::first();

        // Jika belum ada data, buat data kosong
        if (!$struktur) {
            $struktur = StrukturOrganisasi::create([]);
        }

        return view('dashboard.profil.struktur-admin', compact('struktur'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'gambar_struktur' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120' // Max 5MB untuk diagram
        ]);

        $struktur = StrukturOrganisasi::first();

        // Handle file upload 
        if ($request->hasFile('gambar_struktur')) {
            // Hapus gambar lama jika ada
            if ($struktur->gambar_struktur && Storage::disk('public')->exists($struktur->gambar_struktur)) {
                Storage::disk('public')->delete($struktur->gambar_struktur);
            }

            // Upload gambar baru
            $gambarPath = $request->file('gambar_struktur')->store('struktur', 'public');
            $struktur->update(['gambar_struktur' => $gambarPath]);
        }

        return redirect()->back()->with('success', 'Struktur organisasi berhasil diperbarui!');
    }
}
