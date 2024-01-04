<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balita extends Model
{
    use HasFactory;

    protected $table = "balita";
    protected $primaryKey = "id_balita";
    protected $fillable = [
        'id_balita', 
        'id_posyandu', 
        'nama', 
        'nik', 
        'no_kk', 
        'nik_ibu', 
        'nama_ibu', 
        'nik_ayah', 
        'nama_ayah', 
        'jenis_kelamin',
        'tanggal_lahir',
        'berat_badan_lahir',
        'tinggi_badan_lahir',
        'is_deleted',
    ];
}
