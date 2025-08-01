<?php

namespace App\Http\Controllers;

use App\Models\Dayasos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DayasosController extends Controller
{
    /**
     * Display the admin edit form
     */
    public function edit()
    {
        $dayasos = Dayasos::first();

        // Jika belum ada data, buat data default
        if (!$dayasos) {
            $dayasos = Dayasos::create([
                'isi' => '',
                'foto' => null
            ]);
        }

        return view('dashboard.profil.dayasos-admin', compact('dayasos'));
    }

    /**
     * Update the Dayasos data
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

        $dayasos = Dayasos::first();

        // Jika belum ada data, buat baru
        if (!$dayasos) {
            $dayasos = new Dayasos();
        }

        // Update isi
        $dayasos->isi = $request->input('isi');

        // Handle file upload 
        if ($request->hasFile('foto')) {
            // Hapus gambar lama jika ada
            if ($dayasos->foto && Storage::disk('public')->exists($dayasos->foto)) {
                Storage::disk('public')->delete($dayasos->foto);
            }

            // Upload gambar baru
            $gambarPath = $request->file('foto')->store('dayasos', 'public');
            $dayasos->foto = $gambarPath;
        }

        $dayasos->save();

        return redirect()->back()->with('success', 'Data Bidang Dayasos berhasil diperbarui!');
    }

    /**
     * Display the public Dayasos page
     */
    public function show()
    {
        $dayasos = Dayasos::first();

        // Get latest news and articles for sidebar
        // $beritaTerbaru = Berita::where('kategori', 'berita')
        //     ->where('status', 'published')
        //     ->latest()
        //     ->take(5)
        //     ->get();

        // $artikelTerbaru = Berita::where('kategori', 'artikel')
        //     ->where('status', 'published')
        //     ->latest()
        //     ->take(5)
        //     ->get();

        return view('profil-index.dayasos', compact('dayasos'));
    }
}
