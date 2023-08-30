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

    // public function user()
    // {
    //     return $this->hasOne(User::class, 'role_id', 'id');
    // }
}
