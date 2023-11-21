<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $table = "artikel";
    protected $primaryKey = "id_artikel";
    protected $fillable = [
        'id_artikel',
        'slug',
        'title',
        'description', 
        'image', 
        'is_deleted', 
        'id_user', 
    ];
}
