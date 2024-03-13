<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Model
{

    use HasFactory, HasUuids;
    protected $table = 'mahasiswa';
    protected $fillable = [
        'nim', 
        'angkatan', 
        'id_prodi', 
        'id_univ', 
        'id_fakultas', 
        'namamhs', 
        'alamatmhs', 
        'emailmhs', 
        'nohpmhs', 
        'kelas',
        'status',
        'eprt',
        'ipk',
        'tak',
        'sosmed',
        'url_sosmed',
        'lok_magang',
        'skills',
        'bahasa',
        'tunggakan_bpp'
    ];
    protected $keyType = 'string';
    protected $primaryKey = 'nim';
    public $timestamps = false;

    public function prodi()
    {
        return $this->belongsTo(ProgramStudi::class, 'id_prodi');
    }
    public function univ()
    {
        return $this->belongsTo(Universitas::class, 'id_univ');
    }
    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, "id_fakultas");
    }
    public function informasiprib()
    {
        return $this->belongsTo(InformasiPribadi::class, "id_infoprib");
    }
    public function informasitambahan()
    {
        return $this->belongsTo(InformasiTamabahan::class, "id_infotab");
    }
}
