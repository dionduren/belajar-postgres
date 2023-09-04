<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tiket;
use App\Models\GrupMember;
use App\Models\GrupTechnical;
use App\Models\KnowledgeManagement;

class APIGroup extends Controller
{
    function technical_group_list()
    {
        $list_group = GrupTechnical::all();
        return response()->json($list_group);
    }

    function technical_list($id)
    {
        $id_group = Tiket::where('id', $id)->first()->id_group;
        $list_technical = GrupMember::where('id_group', $id_group)->get();
        return response()->json($list_technical);
    }

    function tiket_assign_group(Request $request)
    {
        $id_tiket = $request->input('id_tiket');
        $id_group = $request->input('id_group');
        $nama_group = $request->input('nama_group');

        Tiket::where('id', $id_tiket)->update([
            'id_group' => $id_group,
            'assigned_group' => $nama_group,
            'status_tiket' => 'Assigned',
            'updated_by' => 'Helpdesk',        //Todo: Ganti jadi user Helpdesk
        ]);

        return response()->json([
            'success' => true,
        ], 201);
    }


    function tiket_assign_technical(Request $request)
    {
        $id_tiket = $request->input('id_tiket');
        $id_technical = $request->input('id_technical');
        $nama_technical = $request->input('nama_technical');

        Tiket::where('id', $id_tiket)->update([
            'id_technical' => $id_technical,
            'assigned_technical' => $nama_technical,
            'updated_by' => 'Team Lead',        //Todo: Ganti jadi user Teamlead
        ]);

        return response()->json([
            'success' => true,
        ], 201);
    }
}
