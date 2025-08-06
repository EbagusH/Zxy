<?php

namespace App\Http\Controllers;

use App\Models\RumahSinggah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
        // Custom validation dengan pesan error yang lebih spesifik
        $validator = Validator::make($request->all(), [
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
        ], [
            'gambar.max' => 'Ukuran gambar utama maksimal 2MB',
            'gambar.image' => 'File gambar utama harus berformat gambar',
            'gambar.mimes' => 'Format gambar utama harus: jpeg, png, jpg, atau gif',
            'galeri.*.max' => 'Ukuran setiap foto galeri maksimal 2MB',
            'galeri.*.image' => 'File galeri harus berformat gambar',
            'galeri.*.mimes' => 'Format foto galeri harus: jpeg, png, jpg, atau gif',
            'video.max' => 'Ukuran video maksimal 50MB',
            'video.mimes' => 'Format video harus: mp4, avi, mov, atau wmv',
            'alur_pelayanan.max' => 'Ukuran diagram alur pelayanan maksimal 2MB',
            'alur_pelayanan.image' => 'File alur pelayanan harus berformat gambar',
            'alur_pelayanan.mimes' => 'Format alur pelayanan harus: jpeg, png, jpg, atau gif',
            'isi.required' => 'Deskripsi rumah singgah harus diisi',
            'email.email' => 'Format email tidak valid'
        ]);

        // Jika validasi gagal, flash input data untuk mencegah form reset
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except(['gambar', 'galeri', 'video', 'alur_pelayanan'])); // Exclude file inputs
        }

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

        // Handle gallery image deletion
        $existingGaleri = ($rumahSinggah && $rumahSinggah->galeri) ? $rumahSinggah->galeri : [];

        // Process deleted images
        if ($request->has('delete_images')) {
            $deleteImages = $request->delete_images;
            foreach ($deleteImages as $imageToDelete) {
                // Remove from storage
                if (Storage::disk('public')->exists($imageToDelete)) {
                    Storage::disk('public')->delete($imageToDelete);
                }
                // Remove from existing gallery array
                $existingGaleri = array_filter($existingGaleri, function ($image) use ($imageToDelete) {
                    return $image !== $imageToDelete;
                });
            }
            // Reset array keys
            $existingGaleri = array_values($existingGaleri);
        }

        // Handle new gallery images upload
        if ($request->hasFile('galeri')) {
            $galeriPaths = [];
            foreach ($request->file('galeri') as $file) {
                $path = $file->store('rumah-singgah/galeri', 'public');
                $galeriPaths[] = $path;
            }
            // Merge with existing gallery images (after deletion)
            $data['galeri'] = array_merge($existingGaleri, $galeriPaths);
        } else {
            // Keep existing gallery (after deletion if any)
            $data['galeri'] = $existingGaleri;
        }

        // Handle facilities
        if ($request->has('fasilitas')) {
            $data['fasilitas'] = array_values(array_filter($request->fasilitas, function ($item) {
                return !empty(trim($item));
            }));
        }

        // Handle guest criteria
        if ($request->has('kriteria_tamu')) {
            $data['kriteria_tamu'] = array_values(array_filter($request->kriteria_tamu, function ($item) {
                return !empty(trim($item));
            }));
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

        try {
            $rumahSinggah->update($data);
            return redirect()->back()->with('success', 'Rumah Singgah berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage())
                ->withInput($request->except(['gambar', 'galeri', 'video', 'alur_pelayanan']));
        }
    }
}
