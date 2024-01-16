<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InforamasiPribadi extends Model
{
    use HasFactory;
    use HasUlids;

    protected $table = 'informasi_prib';
    protected $fillable = ['id_infoprib', 'nim', 'ipk', 'epert', 'TAK', 'tgl_lahir', 'headliner', 'deskripsi_diri', 'gender'];
    protected $primaryKey = 'id_infoprib';
    protected $keyType = 'string';
    public $timestamps = false;

    public function relasi()
    {
        return $this->hasManyThrough(
            Mahasiswa::class,
            'nim',
        );
    }
}
