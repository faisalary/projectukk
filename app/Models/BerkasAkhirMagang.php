<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BerkasAkhirMagang extends Model
{
    use HasUuids;

    protected $table = 'berkas_akhir_magang';
    protected $fillable = [
        'id_lap_akhir',
        'id_mhsmagang',
        'berkas_file',
        'berkas_magang',
        'status_berkas',
        'tgl_upload'
    ];
    protected $primaryKey = 'id_berkas_akhir_magang';
    protected $keyType = 'string';
    public $timestamps = false;

    public function laporan_akhir()
    {
        return $this->belongsTo(LaporanAkhir::class, 'id_lap_akhir');
    }
    public function mhs_magang()
    {
        return $this->belongsTo(MhsMagang::class, 'id_mhsmagang');
    }
}
