<?php

namespace App\Http\Controllers;

use App\Models\VisiMisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VisiMisiController extends Controller
{
    // Method untuk tampilan public
    public function show()
    {
        $visiMisi = VisiMisi::first();
        return view('profil-index.visi-misi', compact('visiMisi'));
    }

    // Method untuk edit admin
    public function edit()
    {
        $visiMisi = VisiMisi::first();

        // Jika belum ada data, buat data kosong
        if (!$visiMisi) {
            $visiMisi = VisiMisi::create([
                'sejarah' => '',
                'visi' => '',
                'misi' => ''
            ]);
        }

        return view('dashboard.profil.visimisi-admin', compact('visiMisi'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'sejarah' => 'required|string',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $visiMisi = VisiMisi::first();

        $data = [
            'sejarah' => $request->sejarah,
            'visi' => $request->visi,
            'misi' => $request->misi
        ];

        // Handle file upload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($visiMisi->gambar && Storage::disk('public')->exists($visiMisi->gambar)) {
                Storage::disk('public')->delete($visiMisi->gambar);
            }

            // Upload gambar baru
            $gambarPath = $request->file('gambar')->store('visi-misi', 'public');
            $data['gambar'] = $gambarPath;
        }

        $visiMisi->update($data);

        return redirect()->back()->with('success', 'Visi Misi berhasil diperbarui!');
    }
}
