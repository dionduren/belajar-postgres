<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use App\Models\Kategori;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function homepage()
    {
        return view('home.homepage');
    }


    public function home_user()
    {
        $daftar_tiket = Tiket::all();
        return view('home.user', [
            'daftar_tiket' => $daftar_tiket,
        ]);
    }


    public function home_vp_user()
    {
        return view('home.user');
    }
}
