<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PendaftaranMagang extends Model
{
    use HasUuids;

    protected $table = 'pendaftaran_magang';
    protected $fillable = [
        'tanggaldaftar',
        'nim',
        'current_step',
        'approval',
        'status_seleksi',
        'approvetime',
        'id_lowongan',
        'approved_by',
        'konfirmasi_status',
        'bukti_doc',
        'portofolio',
        'reason_aplicant',

    ];
    public $timestamps = false;
    protected $primaryKey = 'id_pendaftaran';
    protected $keyType = 'string';
    protected $casts = [
        'tanggaldaftar' => 'datetime',
        'approvetime' => 'datetime'
    ];

    public function lowongan_magang()
    {
        return $this->belongsTo(LowonganMagang::class, 'id_lowongan');
    }
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim');
    }
    public function tahun_akademik()
    {
        return $this->belongsTo(TahunAkademik::class, 'id_year_akademik');
    }
    public function mahasiswa_magang()
    {
        return $this->hasOne(MhsMagang::class, 'id_pendaftaran');
    }
}
