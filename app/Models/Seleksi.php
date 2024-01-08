<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use phpDocumentor\Reflection\Types\This;

class Seleksi extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'seleksi_lowongan';
    public $timestamps = false;
    protected $fillable = [
        'id_email_tamplate',
        'start_date',
        'end_date',
        'namatahap_seleksi',
        'id_status_seleksi'
    ];
    protected $primaryKey = 'id_seleksi_lowongan';
    protected $keyType = 'string';

    // public function getStatusSeleksiTextAttribute()
    // {
    //     if ($this->statusseleksi == 0) {
    //         return "<div class='text-center'><div class='badge bg-label-secondary'>" . "Belum di proses" . "</div></div>";
    //     } else if ($this->statusseleksi == 1) {
    //         return "<div class='text-center'><div class='badge bg-label-success'>" . "Sudah di proses" . "</div></div>";
    //     }
    // }
}
