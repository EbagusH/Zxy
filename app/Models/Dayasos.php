<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dayasos extends Model
{
    protected $table = 'dayasos';

    protected $fillable = [
        'isi',
        'foto'
    ];
}
