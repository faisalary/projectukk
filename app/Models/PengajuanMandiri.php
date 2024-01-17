<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class PengajuanMandiri extends Model
{
    use HasUuids;

    protected $table = 'pengajuan_mandiri';
    protected $fillable = ['tglpeng', 'nama_industri', 'email', 'posisi_magang', 'jabatan', 'alamat_industri', 'nohp', 'startdate', 'enddate','statusapprove'];
    protected $primaryKey = 'id_pengajuan';
    protected $keyType = 'string';
    public $timestamps = false;

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim');
    }   
}