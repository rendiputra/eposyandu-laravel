<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posyandu extends Model
{
    use HasFactory;

    protected $table = "posyandu";
    protected $primaryKey = "id_posyandu";
    protected $fillable = [
        'id_posyandu', 
        'nama', 
        'alamat'
    ];
}
