<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function create_ticket()
    {
        return view('ticket.create');
    }
}
