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
        'applicant_status',
        'approval',
        'status',

    ];
    protected $primaryKey = 'id_pendaftaran';
    protected $keyType = 'string';

    public function lowonganMagang()
    {
        return $this->belongsTo(LowonganMagang::class, 'id_lowongan');
    }
    public function univ()
    {
        return $this->belongsTo(Universitas::class, 'id_univ');
    }
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim');
    }
    public function prodi()
    {
        return $this->belongsTo(ProgramStudi::class, 'id_prodi');
    }
    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'id_fakultas');
    }
}
