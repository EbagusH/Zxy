<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class BeritaController extends Controller
{
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

        $layananTerbaru = Layanan::orderBy('created_at', 'desc')->take(5)->get();

        return view('berita-detail', compact('berita', 'layananTerbaru'));
    }

    public function create()
    {
        return view('dashboard.CRUD.crud-berita');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|in:berita,artikel',
            'isi' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            // Handle upload photo
            $fotoPath = null;
            if ($request->hasFile('foto')) {
                Log::info('File foto ditemukan: ' . $request->file('foto')->getClientOriginalName());

                // Pastikan direktori ada
                if (!Storage::disk('public')->exists('berita')) {
                    Storage::disk('public')->makeDirectory('berita');
                }

                // Upload file dengan nama unik
                $foto = $request->file('foto');
                $filename = time() . '_' . $foto->getClientOriginalName();
                $fotoPath = $foto->storeAs('berita', $filename, 'public');

                Log::info('File berhasil diupload ke: ' . $fotoPath);
            } else {
                Log::info('Tidak ada file foto yang diupload');
            }

            // Create new record
            $berita = Berita::create([
                'judul' => $request->judul,
                'kategori' => $request->kategori,
                'isi' => $request->isi,
                'foto' => $fotoPath
            ]);

            Log::info('Berita berhasil dibuat dengan ID: ' . $berita->id);

            // Pesan sukses berdasarkan kategori
            $kategori = $request->kategori;
            $pesan = $kategori === 'berita' ? 'Berita berhasil ditambahkan!' : 'Artikel berhasil ditambahkan!';

            // Redirect
            return redirect('/dashboard/berita')->with('success', $pesan);
        } catch (\Exception $e) {
            Log::error('Error saat menyimpan berita: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }

    // Tampilkan detail berita/artikel tertentu
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

        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|in:berita,artikel',
            'isi' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            // Handle photo upload
            $fotoPath = $berita->foto; // Keep existing photo by default

            if ($request->hasFile('foto')) {
                Log::info('File foto baru ditemukan: ' . $request->file('foto')->getClientOriginalName());

                // Pastikan direktori ada
                if (!Storage::disk('public')->exists('berita')) {
                    Storage::disk('public')->makeDirectory('berita');
                }

                // Upload file baru dengan nama unik
                $foto = $request->file('foto');
                $filename = time() . '_' . $foto->getClientOriginalName();
                $newFotoPath = $foto->storeAs('berita', $filename, 'public');

                // Hapus foto lama jika ada dan upload berhasil
                if ($berita->foto && Storage::disk('public')->exists($berita->foto)) {
                    Log::info('Menghapus foto lama: ' . $berita->foto);
                    Storage::disk('public')->delete($berita->foto);
                }

                $fotoPath = $newFotoPath;
                Log::info('File berhasil diupload ke: ' . $fotoPath);
            }

            // Update record
            $berita->update([
                'judul' => $request->judul,
                'kategori' => $request->kategori,
                'isi' => $request->isi,
                'foto' => $fotoPath,
            ]);

            Log::info('Berita berhasil diupdate dengan ID: ' . $berita->id);

            $pesan = $request->kategori === 'berita' ? 'Berita berhasil diperbarui!' : 'Artikel berhasil diperbarui!';
            return redirect('/dashboard/berita')->with('success', $pesan);
        } catch (\Exception $e) {
            Log::error('Error saat mengupdate berita: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat mengupdate data. Silakan coba lagi.');
        }
    }

    // Method untuk menghapus berita/artikel
    public function destroy($id)
    {
        try {
            $berita = Berita::findOrFail($id);

            // Hapus file foto kalau ada
            if ($berita->foto && Storage::disk('public')->exists($berita->foto)) {
                Log::info('Menghapus foto: ' . $berita->foto);
                Storage::disk('public')->delete($berita->foto);
            }

            $kategori = $berita->kategori;
            $berita->delete();

            Log::info('Berita berhasil dihapus dengan ID: ' . $id);

            $pesan = $kategori === 'berita'
                ? 'Berita Berhasil Dihapus!'
                : 'Artikel Berhasil Dihapus!';

            return redirect()->route('dashboard.berita-admin')->with('success', $pesan);
        } catch (\Exception $e) {
            Log::error('Error saat menghapus berita: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }

    // Method untuk live search berita dan artikel
    public function search(Request $request)
    {
        try {
            $query = $request->get('query', '');

            if (empty($query)) {
                // Jika query kosong, return semua data
                $berita = Berita::where('kategori', 'berita')
                    ->orderBy('created_at', 'desc')
                    ->get();

                $artikel = Berita::where('kategori', 'artikel')
                    ->orderBy('created_at', 'desc')
                    ->get();
            } else {
                // Search berdasarkan judul
                $berita = Berita::where('kategori', 'berita')
                    ->where('judul', 'LIKE', '%' . $query . '%')
                    ->orderBy('created_at', 'desc')
                    ->get();

                $artikel = Berita::where('kategori', 'artikel')
                    ->where('judul', 'LIKE', '%' . $query . '%')
                    ->orderBy('created_at', 'desc')
                    ->get();
            }

            // Return JSON response dengan data berita dan artikel
            return response()->json([
                'success' => true,
                'berita' => $berita,
                'artikel' => $artikel,
                'message' => 'Data berhasil diambil'
            ]);
        } catch (\Exception $e) {
            Log::error('Error saat melakukan pencarian: ' . $e->getMessage());
            // Handle error dengan response JSON
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat melakukan pencarian: ' . $e->getMessage(),
                'berita' => [],
                'artikel' => []
            ], 500);
        }
    }
}
