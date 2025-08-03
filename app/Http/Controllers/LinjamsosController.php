<?php

namespace App\Http\Controllers;

use App\Models\Linjamsos;
use App\Models\Berita;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LinjamsosController extends Controller
{
    /**
     * Display the admin edit form
     */
    public function edit()
    {
        $linjamsos = Linjamsos::first();

        // Jika belum ada data, buat data default
        if (!$linjamsos) {
            $linjamsos = Linjamsos::create([
                'isi' => '',
                'foto' => null
            ]);
        }

        return view('dashboard.profil.linjamsos-admin', compact('linjamsos'));
    }

    /**
     * Update the linjamsos data
     */
    public function update(Request $request)
    {
        $request->validate([
            'isi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus JPEG, PNG, JPG, atau GIF.',
            'foto.max' => 'Ukuran gambar maksimal 2MB.'
        ]);

        $linjamsos = Linjamsos::first();

        // Jika belum ada data, buat baru
        if (!$linjamsos) {
            $linjamsos = new Linjamsos();
        }

        // Update isi
        $linjamsos->isi = $request->input('isi');

        // Handle file upload 
        if ($request->hasFile('foto')) {
            // Hapus gambar lama jika ada
            if ($linjamsos->foto && Storage::disk('public')->exists($linjamsos->foto)) {
                Storage::disk('public')->delete($linjamsos->foto);
            }

            // Upload gambar baru
            $gambarPath = $request->file('foto')->store('linjamsos', 'public');
            $linjamsos->foto = $gambarPath;
        }

        $linjamsos->save();

        return redirect()->back()->with('success', 'Data Bidang Linjamsos berhasil diperbarui!');
    }

    /**
     * Display the public linjamsos page
     */
    public function show()
    {
        $linjamsos = Linjamsos::first();

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

        return view('profil-index.linjamsos', compact('linjamsos', 'beritaTerbaru', 'artikelTerbaru', 'layananTerbaru'));
    }
}
