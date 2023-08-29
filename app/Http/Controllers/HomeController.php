<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function homepage()
    {
        return view('home.homepage');
    }


    public function home_user()
    {
        return view('home.user');
    }


    public function home_vp_user()
    {
        return view('home.user');
    }
}
