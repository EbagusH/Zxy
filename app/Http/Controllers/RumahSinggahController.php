<?php

namespace App\Http\Controllers;

use App\Models\RumahSinggah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RumahSinggahController extends Controller
{
    // Method untuk tampilan public
    public function show()
    {
        $rumahSinggah = RumahSinggah::first();
        return view('profil-index.rumah-singgah', compact('rumahSinggah'));
    }

    // Method untuk edit admin
    public function edit()
    {
        $rumahSinggah = RumahSinggah::first();
        // Jika belum ada data, buat data kosong
        if (!$rumahSinggah) {
            $rumahSinggah = RumahSinggah::create([
                'gambar' => '',
                'isi' => '',
                'lokasi' => ''
            ]);
        }
        return view('dashboard.rumah-singgah-admin', compact('rumahSinggah'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'isi' => 'required|string',
            'lokasi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $rumahSinggah = RumahSinggah::first();
        $data = [
            'isi' => $request->isi,
            'lokasi' => $request->lokasi
        ];

        // Handle file upload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($rumahSinggah->gambar && Storage::disk('public')->exists($rumahSinggah->gambar)) {
                Storage::disk('public')->delete($rumahSinggah->gambar);
            }
            // Upload gambar baru
            $gambarPath = $request->file('gambar')->store('rumah-singgah', 'public');
            $data['gambar'] = $gambarPath;
        }

        $rumahSinggah->update($data);

        return redirect()->back()->with('success', 'Rumah Singgah berhasil diperbarui!');
    }
}
