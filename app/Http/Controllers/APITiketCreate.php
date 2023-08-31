<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use App\Models\Kategori;
use App\Models\Subkategori;
use App\Models\ItemCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        // Random antara Incident dan Request
        $randomNumber = rand(1, 2);
        $randomValue = $randomNumber === 1 ? "Incident" : "Request";
        $tipe_tiket = strtoupper($randomValue);

        // Define the validation rules
        $rules = [
            'kategori_tiket' => 'required',
            'nama_kategori' => 'required',
            'subkategori_tiket' => 'required',
            'nama_subkategori' => 'required',
            'item_kategori_tiket' => 'sometimes|required', // only validate when present
            'nama_item_kategori' => 'sometimes|required', // only validate when present
            'judul_tiket' => 'required',
            'detail_tiket' => 'required',
            // 'attachment' => 'sometimes|required', // only validate when present
        ];

        // Perform validation
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // Validation fails

            // Identify empty fields
            $emptyFields = [];
            foreach ($rules as $field => $rule) {
                if (empty($request[$field])) {
                    $emptyFields[] = $field;
                }
            }

            return response()->json([
                'success' => false,
                'reason' => 'Ada kolom kosong',
                'empty_fields' => $emptyFields,
                'errors' => $validator->errors()
            ], 422);
        }

        try {

            $id_kategori = $request->input('kategori_tiket');
            $nama_kategori = $request->input('nama_kategori');
            $id_subkategori = $request->input('subkategori_tiket');
            $nama_subkategori = $request->input('nama_subkategori');
            $id_item_kategori = $request->input('item_kategori_tiket');
            $nama_item_kategori = $request->input('nama_item_kategori');
            $judul_tiket = $request->input('judul_tiket');
            $detail_tiket = $request->input('detail_tiket');

            //randomized matriks prioritas insiden
            $level_dampak = rand(1, 3);
            $level_prioritas = rand(1, 3);
            $tingkat_matriks = (int)$level_dampak * (int)$level_prioritas;
            if ($tingkat_matriks < 5) {
                $tipe_matriks = 'LOW';
            } else if ($tingkat_matriks < 8) {
                $tipe_matriks = 'MEDIUM';
            } else {
                $tipe_matriks = 'HIGH';
            }

            $db_raw_data = [
                'tipe_tiket' => $tipe_tiket,
                'id_kategori' => $id_kategori,
                'kategori_tiket' => $nama_kategori,
                'id_subkategori' => $id_subkategori,
                'subkategori_tiket' => $nama_subkategori,
                'id_item_kategori' => $id_item_kategori,
                'item_kategori_tiket' => $nama_item_kategori,
                'judul_tiket' => $judul_tiket,
                'detail_tiket' => $detail_tiket,
                'status_tiket' => "Submitted",
                'attachment' => null,
                'level_dampak' => $level_dampak,
                'level_prioritas' => $level_prioritas,
                'tingkat_matriks' => $tingkat_matriks,
                'tipe_matriks' => $tipe_matriks,
                'updated_by' => 'User Test',
                'created_by' => 'User Test',
            ];

            Tiket::create($db_raw_data);

            return response()->json([
                'success' => true,
                'data' => $db_raw_data,
            ], 201);
        } catch (\Exception $e) {
            // Catch any error during the storing process
            return response()->json([
                'success' => false,
                'reason' => 'Server error',
                'message' => $e->getMessage()
            ], 500);
        }
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

    public function list_item_kategori($id)
    {
        $item_kategori = ItemCategory::where('id_subkategori', $id)->get();
        return response()->json($item_kategori);
    }
}
