<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class InformasiPribadi extends Model
{
    use HasUuids;

    protected $table = 'informasi_prib';
    protected $fillable = [
        'ipk',
        'nim',
        'eprt',
        'TAK',
        'tgl_lahir',
        'headliner',
        'deskripsi_diri',
        'profile_picture',
        'gender',

    ];
    public $timestamps = false;
    protected $primaryKey = 'id_infoprib';
    protected $keyType = 'string';

    public function mahasiswa()
    {
        return $this->hasManyThrough(Mahasiswa::class, 'nim');
    }
}
