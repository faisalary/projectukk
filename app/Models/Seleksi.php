<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seleksi extends Model
{
    use HasUuids;

    protected $table = 'seleksi';
    protected $fillable = [
        'tglseleksi',
        'jamseleksi',
        'statusseleksi',
    ];
    protected $primaryKey = 'id_seleksi';
    protected $keyType = 'string';
}
