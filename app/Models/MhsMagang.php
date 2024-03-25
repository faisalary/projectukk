<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MhsMagang extends Model
{
    use HasUuids;

    protected $table = 'mhs_magang';
    protected $fillable = [
        'id_pendaftaran',
        'nip',
        'nilai_akhir_magang',
        'indeks_nilai_akhir',
        'id_pengajuan',
        'jenis_magang',
        'id_pbb',
        'id_peg_industri',
        'nilai_lap',
        'nilai_akademik',
        'startdate_magang',
        'enddate_magang',
        'nilai_adjust',
        'alasan_adjust'
    ];
    protected $primaryKey = 'id_mhsmagang';
    protected $keyType = 'string';
    public $timestamps = false;
    protected $casts = [
        'startdate_magang' => 'datetime',
        'enddate_magang' => 'datetime'
    ];

    public function PengajuanMandiri()
    {
        return $this->belongsTo(PengajuanMandiri::class, 'id_pengajuan');
    }
    public function Pendaftaran()
    {
        return $this->belongsTo(PendaftaranMagang::class, 'id_pendaftaran');
    }
    public function Dosen()
    {
        return $this->belongsTo(Dosen::class, 'nip');
    }
    public function Pbb()
    {
        return $this->belongsTo(PembimbingMandiri::class, 'id_pbb');
    }
    public function PegIndustri()
    {
        return $this->belongsTo(PegawaiIndustri::class, 'id_peg_industri');
    }
}
