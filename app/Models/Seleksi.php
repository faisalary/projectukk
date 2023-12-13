<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use phpDocumentor\Reflection\Types\This;

class Seleksi extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'seleksi';
    public $timestamps = false;
    protected $fillable = [
        'id_pendaftaran',
        'pelaksanaan',
        'detail',
        'tglseleksi',
        'jamseleksi',
        'statusseleksi',
    ];
    protected $primaryKey = 'id_seleksi';
    protected $keyType = 'string';

    public function getStatusSeleksiTextAttribute()
    {
        if ($this->statusseleksi == 0) {
            return "<div class='text-center'><div class='badge bg-label-secondary'>" . "Belum di Proses" . "</div></div>";
        } else if ($this->statusseleksi == 1) {
            return "<div class='text-center'><div class='badge bg-label-danger'>" . "Ditolak" . "</div></div>";
        } else if ($this->statusseleksi == 2) {
            return "<div class='text-center'><div class='badge bg-label-success'>" . "Diterima" . "</div></div>";
        } 
       
    }
}
