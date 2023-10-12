<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


class KomponenNilai extends Model
{
    use HasUuids;

    protected $table = 'komponen_nilai';
    protected $fillable = ['namakomponen', 'tipe', 'bobot', 'scoredby', 'status'];
    protected $primaryKey = 'id_kompnilai';
    protected $keyType = 'string';
}
