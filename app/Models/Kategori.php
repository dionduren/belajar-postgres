<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'ms_kategori';
    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    public function subkategori()
    {
        return $this->hasMany(Subkategori::class, 'id', 'id_kategori');
    }
}
