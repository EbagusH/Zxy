<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarPegawai extends Model
{
    use HasFactory;

    protected $table = 'daftar_pegawai';

    protected $fillable = [
        'nama',
        'jabatan',
        'foto'
    ];

    public static $jabatanOptions = [
        'Kepala Dinas',
        'Sekretaris',
        'Kabid',
        'Kasubag',
        'Kasi',
        'Staff'
    ];
}
