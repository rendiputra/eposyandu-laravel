<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaksin extends Model
{
    use HasFactory;

    protected $table = "vaksin";
    protected $primaryKey = "id_vaksin";
    protected $fillable = [
        'id_vaksin',
        'nama',
    ];
}
