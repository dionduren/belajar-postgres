<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tr_tiket', function (Blueprint $table) {
            $table->id();
            $table->integer('id_tiket_prev')->unsigned()->nullable();
            $table->string('tipe_tiket');
            $table->string('kategori_tiket');
            $table->string('subkategori_tiket');
            $table->string('item_kategori_tiket')->nullable();
            $table->string('judul_tiket');
            $table->text('detail_tiket');
            $table->string('status_tiket');
            $table->text('attachment')->nullable();
            $table->integer('id_solusi')->unsigned()->nullable();
            $table->text('solusi_text')->nullable();
            $table->string('updated_by');
            $table->string('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tr_tiket');
    }
};
