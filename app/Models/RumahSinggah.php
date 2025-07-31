<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RumahSinggah extends Model
{
    use HasFactory;

    protected $table = 'rumah_singgah';

    protected $fillable = [
        'gambar',
        'isi',
        'galeri',
        'fasilitas',
        'kriteria_tamu',
        'video',
        'alur_pelayanan',
        'alamat_lengkap',
        'whatsapp',
        'telepon',
        'email',
        'jam_operasional'
    ];

    protected $casts = [
        'galeri' => 'array',
        'fasilitas' => 'array',
        'kriteria_tamu' => 'array',
        'jam_operasional' => 'array'
    ];

    // Accessor untuk mendapatkan galeri dalam format array
    public function getGaleriAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    // Mutator untuk menyimpan galeri dalam format JSON
    public function setGaleriAttribute($value)
    {
        $this->attributes['galeri'] = is_array($value) ? json_encode($value) : $value;
    }

    // Accessor untuk fasilitas
    public function getFasilitasAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    // Mutator untuk fasilitas
    public function setFasilitasAttribute($value)
    {
        $this->attributes['fasilitas'] = is_array($value) ? json_encode($value) : $value;
    }

    // Accessor untuk kriteria tamu
    public function getKriteriaTamuAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    // Mutator untuk kriteria tamu
    public function setKriteriaTamuAttribute($value)
    {
        $this->attributes['kriteria_tamu'] = is_array($value) ? json_encode($value) : $value;
    }

    // Accessor untuk jam operasional
    public function getJamOperasionalAttribute($value)
    {
        return $value ? json_decode($value, true) : [
            'senin_jumat' => '08:00 - 17:00 WIB',
            'sabtu' => '08:00 - 12:00 WIB',
            'emergency' => '24 Jam'
        ];
    }

    // Mutator untuk jam operasional
    public function setJamOperasionalAttribute($value)
    {
        $this->attributes['jam_operasional'] = is_array($value) ? json_encode($value) : $value;
    }
}
