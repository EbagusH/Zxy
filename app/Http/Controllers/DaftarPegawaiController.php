<?php

namespace App\Http\Controllers;

use App\Models\DaftarPegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DaftarPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pegawai = DaftarPegawai::orderBy('nama', 'asc')->get();
        return view('dashboard.profil.pegawai-admin', compact('pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.CRUD.create-pegawai-admin');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|in:Kepala Dinas,Sekretaris,Kabid,Kasubag,Kasi,Staff',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048'
        ], [
            'nama.required' => 'Nama pegawai harus diisi',
            'nama.string' => 'Nama harus berupa teks',
            'nama.max' => 'Nama maksimal 255 karakter',
            'jabatan.required' => 'Jabatan harus dipilih',
            'jabatan.in' => 'Jabatan yang dipilih tidak valid',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format foto harus JPG, JPEG, atau PNG',
            'foto.max' => 'Ukuran foto maksimal 2MB'
        ]);

        $data = $request->only(['nama', 'jabatan']);

        // Handle file upload
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $data['foto'] = $file->storeAs('pegawai', $filename, 'public');
        }

        DaftarPegawai::create($data);

        return redirect()->route('dashboard.profil.pegawai-admin')
            ->with('success', 'Data pegawai berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(DaftarPegawai $pegawai)
    {
        return view('dashboard.profil.pegawai-admin', compact('pegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DaftarPegawai $pegawai)
    {
        return view('dashboard.CRUD.edit-pegawai-admin', compact('pegawai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DaftarPegawai $pegawai)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|in:Kepala Dinas,Sekretaris,Kabid,Kasubag,Kasi,Staff',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048'
        ], [
            'nama.required' => 'Nama pegawai harus diisi',
            'nama.string' => 'Nama harus berupa teks',
            'nama.max' => 'Nama maksimal 255 karakter',
            'jabatan.required' => 'Jabatan harus dipilih',
            'jabatan.in' => 'Jabatan yang dipilih tidak valid',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format foto harus JPG, JPEG, atau PNG',
            'foto.max' => 'Ukuran foto maksimal 2MB'
        ]);

        $data = $request->only(['nama', 'jabatan']);

        // Handle file upload
        if ($request->hasFile('foto')) {
            // Delete old photo if exists
            if ($pegawai->foto && Storage::disk('public')->exists($pegawai->foto)) {
                Storage::disk('public')->delete($pegawai->foto);
            }

            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $data['foto'] = $file->storeAs('pegawai', $filename, 'public');
        }

        $pegawai->update($data);

        return redirect()->route('dashboard.profil.pegawai-admin')
            ->with('success', 'Data pegawai berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DaftarPegawai $pegawai)
    {
        try {
            // Delete photo if exists
            if ($pegawai->foto && Storage::disk('public')->exists($pegawai->foto)) {
                Storage::disk('public')->delete($pegawai->foto);
            }

            $pegawai->delete();

            return redirect()->route('dashboard.profil.pegawai-admin')
                ->with('success', 'Data pegawai berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.profil.pegawai-admin')
                ->with('error', 'Gagal menghapus pegawai: ' . $e->getMessage());
        }
    }
}
