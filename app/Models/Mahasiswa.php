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
        'tunggakan_bpp',
        'kode_dosen',
    ];
    protected $keyType = 'string';
    protected $primaryKey = 'nim';
    public $timestamps = false;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

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
    public function bahasamhs()
    {
        return $this->hasMany(BahasaMahasiswa::class, 'nim');
    }
    public function sosmedmhs()
    {
        return $this->hasMany(SosmedTambahan::class, 'nim');
    }

    public function education()
    {
        return $this->hasMany(Education::class, 'nim', 'nim');
    }

    public function experience()
    {
        return $this->hasMany(Experience::class, 'nim', 'nim');
    }

    public function sertifikat()
    {
        return $this->hasMany(Sertif::class, 'nim', 'nim');
    }

    public function dosen_wali()
    {
        return $this->hasOne(Dosen::class, 'kode_dosen', 'kode_dosen');
    }

    public function lamaran_magang()
    {
        return $this->hasMany(PendaftaranMagang::class, 'nim', 'nim');
    }
}
