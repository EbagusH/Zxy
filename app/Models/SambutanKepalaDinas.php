<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SambutanKepalaDinas extends Model
{
    use HasFactory;

    protected $table = 'sambutan_kepala_dinas';

    protected $fillable = [
        'foto',
        'nama_kepala_dinas',
        'jabatan',
        'isi_sambutan'
    ];
}
