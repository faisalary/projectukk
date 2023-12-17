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

    public function total_pelamar()
    {
        return $this->belongsTo(LowonganMagang::class, 'id_lowongan');
    }
}
