<?php

namespace App\Http\Controllers;

use App\Models\GrupTechnical;
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


    public function home_helpdesk()
    {
        return view('home.helpdesk');
    }


    public function home_teamlead($id)
    {
        $get_team_id = GrupTechnical::where('nik_team_lead', $id)->first()->id;
        return view('home.teamlead', [
            'id_group' => $get_team_id,
        ]);
    }

    public function home_technical($id)
    {
        return view('home.technical', [
            'id_technical' => $id,
        ]);
    }
}
