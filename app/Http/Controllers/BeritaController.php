<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    // Method untuk halaman beranda dengan berita dan artikel terbaru
    public function home()
    {
        // Ambil berita terbaru
        $beritaTerbaru = Berita::where('kategori', 'berita')
            ->orderBy('created_at', 'desc')
            ->take(1)
            ->get();

        // Ambil artikel terbaru
        $artikelTerbaru = Berita::where('kategori', 'artikel')
            ->orderBy('created_at', 'desc')
            ->take(1)
            ->get();

        return view('home', compact('beritaTerbaru', 'artikelTerbaru'));
    }

    // Method untuk menampilkan halaman berita-admin dengan data
    public function index()
    {
        // Ambil semua data berita dan artikel, diurutkan berdasarkan created_at terbaru
        $berita = Berita::where('kategori', 'berita')->orderBy('created_at', 'desc')->get();
        $artikel = Berita::where('kategori', 'artikel')->orderBy('created_at', 'desc')->get();

        return view('dashboard.berita-admin', compact('berita', 'artikel'));
    }

    // Method untuk halaman publik berita
    public function publicIndex()
    {
        // Ambil data berita dan artikel untuk halaman publik
        $berita = Berita::where('kategori', 'berita')
            ->orderBy('created_at', 'desc')
            ->get();

        $artikel = Berita::where('kategori', 'artikel')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('berita', compact('berita', 'artikel'));
    }

    // Method untuk menampilkan detail berita/artikel di halaman publik
    public function publicShow($id)
    {
        $berita = Berita::findOrFail($id);
        return view('berita-detail', compact('berita'));
    }

    public function create()
    {
        return view('dashboard.CRUD.crud-berita');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|in:berita,artikel',
            'isi' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('berita', 'public');
        }

        Berita::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'isi' => $request->isi,
            'foto' => $fotoPath
        ]);

        // Pesan sukses berdasarkan kategori
        $kategori = $request->kategori;
        $pesan = $kategori === 'berita' ? 'Berita berhasil ditambahkan!' : 'Artikel berhasil ditambahkan!';

        // Redirect dengan url langsung (lebih aman)
        return redirect('/dashboard/berita')->with('success', $pesan);
    }

    // Tampilkan detail berita/artikel tertentu (jika diperlukan)
    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        return view('dashboard.CRUD.show-berita', compact('berita'));
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('dashboard.CRUD.edit-berita', compact('berita'));
    }

    // Proses update data
    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|in:berita,artikel',
            'isi' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Cek jika upload foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($berita->foto && Storage::disk('public')->exists($berita->foto)) {
                Storage::disk('public')->delete($berita->foto);
            }

            $fotoPath = $request->file('foto')->store('berita', 'public');
            $berita->foto = $fotoPath;
        }

        $berita->update([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'isi' => $request->isi,
            'foto' => $berita->foto,
        ]);

        $pesan = $request->kategori === 'berita' ? 'Berita berhasil diperbarui!' : 'Artikel berhasil diperbarui!';
        return redirect('/dashboard/berita')->with('success', $pesan);
    }

    // Method untuk menghapus berita/artikel
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        // Hapus file foto kalau ada
        if ($berita->foto && Storage::exists($berita->foto)) {
            Storage::delete($berita->foto);
        }

        $kategori = $berita->kategori;

        $berita->delete();

        $pesan = $kategori === 'berita'
            ? 'Berita Berhasil Dihapus!'
            : 'Artikel Berhasil Dihapus!';

        return redirect()->route('dashboard.berita-admin')->with('success', $pesan);
    }
}
