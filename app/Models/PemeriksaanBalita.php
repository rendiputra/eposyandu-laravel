<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanBalita extends Model
{
    use HasFactory;

    protected $table = "pemeriksaan_balita";
    protected $primaryKey = "id_pemeriksaan_balita";
    protected $fillable = [
        'id_pemeriksaan_balita', 
        'id_balita', 
        'id_posyandu', 
        'id_user_petugas',
        'berat_badan',
        'tinggi_badan',
        'lingkar_lengan_atas',
        'lingkar_kepala',
        'is_deleted',
    ];
}
