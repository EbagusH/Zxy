<?php

namespace App\Http\Controllers;

use App\Models\HeaderFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeaderFotoController extends Controller
{
    /**
     * Display the image for header
     */
    public function index()
    {
        $header_foto = HeaderFoto::first();

        if ($header_foto && $header_foto->gambar) {
            return asset('storage/' . $header_foto->gambar);
        }

        // Return default image if no header image exists
        return 'https://i.ytimg.com/vi/aKeSm4BUFCk/maxresdefault.jpg';
    }

    /**
     * Display the edit form for header photo
     */
    public function edit()
    {
        // Ambil data header foto, jika tidak ada buat record baru
        $header_foto = HeaderFoto::first();

        if (!$header_foto) {
            $header_foto = HeaderFoto::create([]);
        }

        return view('dashboard.edit-header', compact('header_foto'));
    }

    /**
     * Update the header photo
     */
    public function update(Request $request)
    {
        $request->validate([
            'gambar_header' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $header_foto = HeaderFoto::first();

        if ($request->hasFile('gambar_header')) {
            // Hapus gambar lama jika ada
            if ($header_foto->gambar && Storage::disk('public')->exists($header_foto->gambar)) {
                Storage::disk('public')->delete($header_foto->gambar);
            }

            // Upload gambar baru
            $gambarPath = $request->file('gambar_header')->store('header', 'public');
            $header_foto->update(['gambar' => $gambarPath]);
        }

        return redirect()->back()->with('success', 'Gambar header berhasil diperbarui!');
    }
}
