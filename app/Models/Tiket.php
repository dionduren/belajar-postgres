<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    use HasFactory;

    protected $table = 'tr_tiket';
    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    public function parent_tiket()
    {
        return $this->hasOne(Tiket::class, 'id_tiket_prev', 'id');
    }
}
