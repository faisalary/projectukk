<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiPribadi extends Model
{
    use HasFactory;
    use HasUlids;

    protected $table = 'informasi_prib';
    protected $fillable = ['id_infoprib', 'nim', 'ipk', 'eprt', 'TAK', 'tgl_lahir', 'headliner', 'deskripsi_diri', 'gender', 'profile_picture'];
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
