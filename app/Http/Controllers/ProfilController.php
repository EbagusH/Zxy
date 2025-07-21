<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function sambutan()
    {
        return view('dashboard.profil.sambutan-admin');
    }

    public function struktur()
    {
        return view('dashboard.profil.struktur-admin');
    }

    public function pegawai()
    {
        return view('dashboard.profil.pegawai-admin');
    }

    public function visimisi()
    {
        return view('dashboard.profil.visimisi-admin');
    }
}
