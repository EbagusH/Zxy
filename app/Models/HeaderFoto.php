<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderFoto extends Model
{
    use HasFactory;

    protected $table = 'header_foto';

    protected $fillable = [
        'gambar'
    ];
}
