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
        return view('rumah-singgah', compact('rumahSinggah'));
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
                'galeri' => [],
                'fasilitas' => [],
                'kriteria_tamu' => [],
                'video' => '',
                'alur_pelayanan' => '',
                'alamat_lengkap' => '',
                'whatsapp' => '',
                'telepon' => '',
                'email' => '',
                'jam_operasional' => [
                    'senin_jumat' => '08:00 - 17:00 WIB',
                    'sabtu' => '08:00 - 12:00 WIB',
                    'emergency' => '24 Jam'
                ]
            ]);
        }
        return view('dashboard.rumah-singgah-admin', compact('rumahSinggah'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'galeri.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'fasilitas' => 'nullable|array',
            'kriteria_tamu' => 'nullable|array',
            'video' => 'nullable|file|mimes:mp4,avi,mov,wmv|max:50000',
            'alur_pelayanan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alamat_lengkap' => 'nullable|string',
            'whatsapp' => 'nullable|string',
            'telepon' => 'nullable|string',
            'email' => 'nullable|email',
            'jam_operasional_senin_jumat' => 'nullable|string',
            'jam_operasional_sabtu' => 'nullable|string',
            'jam_operasional_emergency' => 'nullable|string'
        ]);

        $rumahSinggah = RumahSinggah::first();
        $data = [
            'isi' => $request->isi,
            'alamat_lengkap' => $request->alamat_lengkap,
            'whatsapp' => $request->whatsapp,
            'telepon' => $request->telepon,
            'email' => $request->email
        ];

        // Handle main image upload
        if ($request->hasFile('gambar')) {
            if ($rumahSinggah && $rumahSinggah->gambar && Storage::disk('public')->exists($rumahSinggah->gambar)) {
                Storage::disk('public')->delete($rumahSinggah->gambar);
            }
            $gambarPath = $request->file('gambar')->store('rumah-singgah', 'public');
            $data['gambar'] = $gambarPath;
        }

        // Handle gallery images
        if ($request->hasFile('galeri')) {
            $galeriPaths = [];
            foreach ($request->file('galeri') as $file) {
                $path = $file->store('rumah-singgah/galeri', 'public');
                $galeriPaths[] = $path;
            }
            // Merge with existing gallery images
            $existingGaleri = ($rumahSinggah && $rumahSinggah->galeri) ? $rumahSinggah->galeri : [];
            $data['galeri'] = array_merge($existingGaleri, $galeriPaths);
        }

        // Handle facilities
        if ($request->has('fasilitas')) {
            $data['fasilitas'] = array_filter($request->fasilitas, function ($item) {
                return !empty(trim($item));
            });
        }

        // Handle guest criteria
        if ($request->has('kriteria_tamu')) {
            $data['kriteria_tamu'] = array_filter($request->kriteria_tamu, function ($item) {
                return !empty(trim($item));
            });
        }

        // Handle video upload
        if ($request->hasFile('video')) {
            if ($rumahSinggah && $rumahSinggah->video && Storage::disk('public')->exists($rumahSinggah->video)) {
                Storage::disk('public')->delete($rumahSinggah->video);
            }
            $videoPath = $request->file('video')->store('rumah-singgah/video', 'public');
            $data['video'] = $videoPath;
        }

        // Handle service flow diagram
        if ($request->hasFile('alur_pelayanan')) {
            if ($rumahSinggah && $rumahSinggah->alur_pelayanan && Storage::disk('public')->exists($rumahSinggah->alur_pelayanan)) {
                Storage::disk('public')->delete($rumahSinggah->alur_pelayanan);
            }
            $alurPath = $request->file('alur_pelayanan')->store('rumah-singgah/alur', 'public');
            $data['alur_pelayanan'] = $alurPath;
        }

        // Handle operating hours
        $jamOperasional = [
            'senin_jumat' => $request->jam_operasional_senin_jumat ?? '08:00 - 17:00 WIB',
            'sabtu' => $request->jam_operasional_sabtu ?? '08:00 - 12:00 WIB',
            'emergency' => $request->jam_operasional_emergency ?? '24 Jam'
        ];
        $data['jam_operasional'] = $jamOperasional;

        $rumahSinggah->update($data);

        return redirect()->back()->with('success', 'Rumah Singgah berhasil diperbarui!');
    }
}
