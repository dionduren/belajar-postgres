<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TiketController extends Controller
{
    public function create_tiket()
    {
        return view('tiket.create');
    }

    public function helpdesk_detail_tiket($id)
    {
        return view('tiket.helpdesk-detail', [
            "tiket_id" => $id
        ]);
    }

    public function teamlead_detail_tiket($id)
    {
        return view('tiket.teamlead-detail', [
            "tiket_id" => $id
        ]);
    }

    public function technical_detail_tiket($id)
    {
        return view('tiket.technical-detail', [
            "tiket_id" => $id
        ]);
    }
}
