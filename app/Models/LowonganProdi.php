<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LowonganHasProdi extends Model
{
    use HasFactory;
    protected $table=['lowongan_prodi'];
    protected $fillable = [
        'id_lowongan',
        'id_prodi',
    ];
}
