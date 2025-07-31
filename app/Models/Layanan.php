<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'layanan';

    protected $fillable = [
        'nama',
        'bidang',
        'foto'
    ];

    /**
     * Get the available bidang options
     */
    public static function getBidangOptions()
    {
        return [
            'Linjamsos' => 'Linjamsos',
            'Dayasos' => 'Dayasos',
            'Resos' => 'Resos'
        ];
    }
}
