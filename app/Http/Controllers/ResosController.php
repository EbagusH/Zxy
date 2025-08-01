<?php

namespace App\Http\Controllers;

use App\Models\Resos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResosController extends Controller
{
    /**
     * Display the admin edit form
     */
    public function edit()
    {
        $resos = Resos::first();

        // Jika belum ada data, buat data default
        if (!$resos) {
            $resos = Resos::create([
                'isi' => '',
                'foto' => null
            ]);
        }

        return view('dashboard.profil.resos-admin', compact('resos'));
    }

    /**
     * Update the Resos data
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

        $resos = Resos::first();

        // Jika belum ada data, buat baru
        if (!$resos) {
            $resos = new Resos();
        }

        // Update isi
        $resos->isi = $request->input('isi');

        // Handle file upload 
        if ($request->hasFile('foto')) {
            // Hapus gambar lama jika ada
            if ($resos->foto && Storage::disk('public')->exists($resos->foto)) {
                Storage::disk('public')->delete($resos->foto);
            }

            // Upload gambar baru
            $gambarPath = $request->file('foto')->store('resos', 'public');
            $resos->foto = $gambarPath;
        }

        $resos->save();

        return redirect()->back()->with('success', 'Data Bidang Resos berhasil diperbarui!');
    }

    /**
     * Display the public Resos page
     */
    public function show()
    {
        $resos = Resos::first();

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

        return view('profil-index.resos', compact('resos'));
    }
}
