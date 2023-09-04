<?php

namespace App\Http\Controllers;

use App\Models\KnowledgeManagement;
use App\Models\Tiket;
use Illuminate\Http\Request;

class APITiket extends Controller
{
    public function helpdesk_list_submitted()
    {
        $list_tiket = Tiket::where('status_tiket', 'Submitted')->get();
        return response()->json($list_tiket);
    }

    public function helpdesk_list_assigned()
    {
        $list_tiket = Tiket::where('status_tiket', 'Assigned')->get();
        return response()->json($list_tiket);
    }

    public function helpdesk_detail($id)
    {
        $detail_tiket = Tiket::where('id', $id)->first();
        return response()->json($detail_tiket);
    }

    public function teamlead_waiting_list($id)
    {
        $list_tiket = Tiket::where('id_group', $id)->whereNull('id_technical')->get();
        return response()->json($list_tiket);
    }

    public function teamlead_ongoing_list($id)
    {
        $list_tiket = Tiket::where('id_group', $id)->whereNotNull('id_technical')->get();
        return response()->json($list_tiket);
    }

    public function teamlead_finished($id)
    {
        $list_tiket = Tiket::where('id_group', $id)->whereNotNull('id_technical')->where('status_tiket', "Closed")->get();
        return response()->json($list_tiket);
    }


    public function technical_ongoing_list($id)
    {
        $list_tiket = Tiket::where('id_technical', $id)->get();
        return response()->json($list_tiket);
    }

    public function technical_finished($id)
    {
        $list_tiket = Tiket::where('id_technical', $id)->where('status_tiket', "Closed")->get();
        return response()->json($list_tiket);
    }

    function solution_list($id)
    {
        $id_kategori = Tiket::where('id', $id)->first()->id_kategori;
        $list_solusi = KnowledgeManagement::where('id_kategori', $id_kategori)->get();
        return response()->json($list_solusi);
    }

    function submit_solution(Request $request)
    {
        $id_tiket = $request->input('id_tiket');
        $id_solusi = $request->input('id_solusi');

        Tiket::where('id', $id_tiket)->update([
            'id_solusi' => $id_solusi,
            'status_tiket' => 'Finished',
            'updated_by' => 'Technical',        //Todo: Ganti jadi user technical
        ]);

        return response()->json([
            'success' => true,
        ], 201);
    }

    function submit_new_solution(Request $request)
    {
        $id_tiket = $request->input('id_tiket');
        $judul_solusi = $request->input('judul_solusi');
        $detail_solusi = $request->input('detail_solusi');

        $info_tiket = Tiket::where('id', $id_tiket)->first();

        $id_solusi = KnowledgeManagement::create([
            'tipe_tiket' => $info_tiket->tipe_tiket,
            'id_kategori' => $info_tiket->id_kategori,
            'kategori_tiket' => $info_tiket->kategori_tiket,
            'id_subkategori' => $info_tiket->id_subkategori,
            'subkategori_tiket' => $info_tiket->subkategori_tiket,
            'id_item_kategori' => $info_tiket->id_item_kategori,
            'item_kategori_tiket' => $info_tiket->item_kategori_tiket,
            'judul_solusi' => $judul_solusi,
            'detail_solusi' => $detail_solusi,
            'created_by' => 'Technical',
            'updated_by' => 'Technical',
        ]);

        Tiket::where('id', $id_tiket)->update([
            'id_solusi' => $id_solusi->id,
            'status_tiket' => 'Finished',
            'updated_by' => 'Technical',        //Todo: Ganti jadi user technical
        ]);

        return response()->json([
            'success' => true,
        ], 201);
    }

    function close_tiket()
    {

        // create metode close tiket
    }
}
