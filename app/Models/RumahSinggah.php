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
        'lokasi'
    ];
}
