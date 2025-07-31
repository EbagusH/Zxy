<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Linjamsos extends Model
{
    protected $table = 'linjamsos';

    protected $fillable = [
        'isi',
        'foto'
    ];
}
