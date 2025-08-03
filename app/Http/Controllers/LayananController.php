<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $layanan = Layanan::orderBy('created_at', 'desc')->get();
        return view('dashboard.layanan-admin', compact('layanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.CRUD.create-layanan-admin');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'bidang' => ['required', Rule::in(['Linjamsos', 'Dayasos', 'Resos'])],
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $layanan = new Layanan();
        $layanan->nama = $request->nama;
        $layanan->bidang = $request->bidang;

        // Handle foto upload
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = time() . '_layanan_' . $foto->getClientOriginalName();
            $fotoPath = $foto->storeAs('layanan', $fotoName, 'public');
            $layanan->foto = $fotoPath;
        }

        $layanan->save();

        return redirect()->route('dashboard.layanan-admin')
            ->with('success', 'Layanan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $layanan = Layanan::findOrFail($id);
        return view('dashboard.layanan.show', compact('layanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $layanan = Layanan::findOrFail($id);
        return view('dashboard.CRUD.edit-layanan-admin', compact('layanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $layanan = Layanan::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'bidang' => ['required', Rule::in(['Linjamsos', 'Dayasos', 'Resos'])],
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $layanan->nama = $request->nama;
        $layanan->bidang = $request->bidang;

        // Handle foto upload
        if ($request->hasFile('foto')) {
            // Delete old foto if exists
            if ($layanan->foto && Storage::disk('public')->exists($layanan->foto)) {
                Storage::disk('public')->delete($layanan->foto);
            }

            $foto = $request->file('foto');
            $fotoName = time() . '_layanan_' . $foto->getClientOriginalName();
            $fotoPath = $foto->storeAs('layanan', $fotoName, 'public');
            $layanan->foto = $fotoPath;
        }

        $layanan->save();

        return redirect()->route('dashboard.layanan-admin')
            ->with('success', 'Layanan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $layanan = Layanan::findOrFail($id);

        // Delete foto if exists
        if ($layanan->foto && Storage::disk('public')->exists($layanan->foto)) {
            Storage::disk('public')->delete($layanan->foto);
        }

        $layanan->delete();

        return redirect()->route('dashboard.layanan-admin')
            ->with('success', 'Layanan berhasil dihapus!');
    }

    /**
     * Display layanan for public view
     */
    public function publicIndex()
    {
        $layanan = Layanan::orderBy('bidang')->orderBy('nama')->get();
        return view('layanan', compact('layanan'));
    }

    public function publicShow($id)
    {
        $layanan = Layanan::findOrFail($id);

        // Get 5 latest layanan for sidebar
        $layananTerbaru = Layanan::orderBy('created_at', 'desc')->take(5)->get();

        // data berita dan artikel untuk sidebar
        $beritaTerbaru = Berita::where('kategori', 'berita')
            ->latest()
            ->take(5)
            ->get();

        $artikelTerbaru = Berita::where('kategori', 'artikel')
            ->latest()
            ->take(5)
            ->get();

        return view('layanan-detail', compact('layanan', 'layananTerbaru', 'beritaTerbaru', 'artikelTerbaru'));
    }
}
