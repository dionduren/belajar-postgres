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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // $table->string('user_sso')->unique();
            $table->string('nik')->unique();
            $table->string('password');
            $table->string('nama');
            $table->string('jabatan')->nullable();
            $table->string('unit_kerja')->nullable();
            $table->string('email')->nullable();
            // $table->timestamp('email_verified_at')->nullable();
            $table->integer('role_id')->unsigned();
            $table->string('atasan_id')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
