<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ItemCategory;
use App\Models\Kategori;
use App\Models\Subkategori;
use Illuminate\Database\Seeder;

use File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $daftar_kategori = ["Internet/Wifi", "VPN", "File Sharing", "Komputer/ Laptop", "Printer", "Zoom", "Email", "Aplikasi ERP SAP", "Aplikasi Non ERP", "Lainnya"];

        foreach ($daftar_kategori as $kategori) {
            Kategori::create([
                'nama_kategori' => $kategori,
                'updated_by' => 'Seeder',
                'created_by' => 'Seeder',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $json1 = File::get("resources/json/subkategori.json");
        $json2 = File::get("resources/json/item_kategori.json");

        $daftar_subkategori = json_decode($json1);
        $daftar_item_kategori = json_decode($json2);

        foreach ($daftar_subkategori as $subkategori) {
            $id_kategori = Kategori::where("nama_kategori", $subkategori->kategori)->first();

            $list_subkategori = [
                'id_kategori' => $id_kategori->id,
                'nama_kategori' => $subkategori->kategori,
                'nama_subkategori' => $subkategori->subkategori,
                'updated_by' => 'Seeder',
                'created_by' => 'Seeder',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            Subkategori::create($list_subkategori);
        }

        foreach ($daftar_item_kategori as $item_kategori) {
            $id_kategori = Kategori::where("nama_kategori", $item_kategori->kategori)->first()->id;
            $id_subkategori = Subkategori::where("nama_subkategori", $item_kategori->subkategori)->first()->id;

            $list_subkategori = [
                'id_kategori' => $id_kategori,
                'nama_kategori' => $item_kategori->kategori,
                'id_subkategori' => $id_subkategori,
                'nama_subkategori' => $item_kategori->subkategori,
                'nama_item_kategori' => $item_kategori->item_kategori,
                'updated_by' => 'Seeder',
                'created_by' => 'Seeder',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            ItemCategory::create($list_subkategori);
        }
    }
}
