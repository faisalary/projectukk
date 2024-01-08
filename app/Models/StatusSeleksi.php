<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use phpDocumentor\Reflection\Types\This;

class StatusSeleksi extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'status_seleksi';
    public $timestamps = false;
    protected $fillable = [
        'id_pendaftaran',
        'status_seleksi',
        'tgl_seleksi',
        'waktu_seleksi',
    ];
    protected $primaryKey = 'id_status_seleksi';
    protected $keyType = 'string';
}
