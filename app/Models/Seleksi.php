<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seleksi extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'seleksi';
    public $timestamps = false;
    protected $fillable = [
        'id_pendaftaran',
        'pelaksanaan',
        'detail',
        'tglseleksi',
        'jamseleksi',
        'statusseleksi',
    ];
    protected $primaryKey = 'id_seleksi';
    protected $keyType = 'string';
}
