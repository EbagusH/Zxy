<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resos extends Model
{
    protected $table = 'resos';

    protected $fillable = [
        'isi',
        'foto'
    ];
}
