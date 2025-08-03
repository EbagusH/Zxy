<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Layanan;
use App\Models\SambutanKepalaDinas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SambutanKepalaDinasController extends Controller
{
    // Method untuk tampilan public
    public function index()
    {
        $sambutan = SambutanKepalaDinas::first();

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

        return view('profil-index.sambutan', compact('sambutan', 'beritaTerbaru', 'artikelTerbaru', 'layananTerbaru'));
    }

    // Method untuk edit admin
    public function edit()
    {
        $sambutan = SambutanKepalaDinas::first();

        // Jika belum ada data, buat data kosong
        if (!$sambutan) {
            $sambutan = SambutanKepalaDinas::create([
                'nama_kepala_dinas' => '',
                'jabatan' => '',
                'isi_sambutan' => ''
            ]);
        }

        return view('dashboard.profil.sambutan-admin', compact('sambutan'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_kepala_dinas' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'isi_sambutan' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $sambutan = SambutanKepalaDinas::first();

        $data = [
            'nama_kepala_dinas' => $request->nama_kepala_dinas,
            'jabatan' => $request->jabatan,
            'isi_sambutan' => $request->isi_sambutan
        ];

        // Handle file upload
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($sambutan->foto && Storage::disk('public')->exists($sambutan->foto)) {
                Storage::disk('public')->delete($sambutan->foto);
            }

            // Upload foto baru
            $fotoPath = $request->file('foto')->store('sambutan', 'public');
            $data['foto'] = $fotoPath;
        }

        $sambutan->update($data);

        return redirect()->back()->with('success', 'Sambutan berhasil diperbarui!');
    }
}
