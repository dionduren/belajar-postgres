<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use App\Models\Kategori;
use App\Models\Subkategori;
use Illuminate\Http\Request;

class APITiketCreate extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Tiket $tiket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tiket $tiket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tiket $tiket)
    {
        //
    }

    public function list_kategori()
    {
        $kategori = Kategori::all();
        return response()->json($kategori);
    }

    public function list_subkategori($id)
    {
        $subkategori = Subkategori::where('id_kategori', $id)->get();
        return response()->json($subkategori);
    }
}
