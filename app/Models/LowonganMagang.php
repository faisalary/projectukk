<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LowonganMagang extends Model
{
    use HasUuids;

    protected $table = 'lowongan_magang';
    protected $guarded = [];
    protected $primaryKey = 'id_lowongan';
    protected $keyType = 'string';
    protected $casts = [
        'date_confirm_closing' => 'datetime'
    ];
    public $timestamps = false;

    public function industri()
    {
        return $this->belongsTo(Industri::class, 'id_industri');
    }
    public function tahunAkademik()
    {
        return $this->belongsTo(TahunAkademik::class, 'id_year_akademik');
    }
    public function jenisMagang()
    {
        return $this->belongsTo(JenisMagang::class, 'id_jenismagang');
    }
    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'id_lokasi');
    }
    public function Prodi(){
        return $this->belongsTo(ProgramStudi::class,'id_prodi');
    }
    public function fakultas(){
        return $this->belongsTo(Fakultas::class,'id_fakultas');
    }
    public function total_pelamar()
    {
        return $this->belongsTo(PendaftaranMagang::class, 'id_lowongan');
    }
}
