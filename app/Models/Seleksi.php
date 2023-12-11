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
            return "<div class='text-center'><div class='badge bg-label-secondary'>" . "Belum Seleksi Tahap 1" . "</div></div>";
        } else if ($this->statusseleksi == 1) {
            return "<div class='text-center'><div class='badge bg-label-success'>" . "Sudah Seleksi Tahap 1" . "</div></div>";
        } else if ($this->statusseleksi == 2) {
            return "<div class='text-center'><div class='badge bg-label-secondary'>" . "Belum Seleksi Tahap 2" . "</div></div>";
        } else if ($this->statusseleksi == 3) {
            return "<div class='text-center'><div class='badge bg-label-success'>" . "Sudah Seleksi Tahap 2" . "</div></div>";
        } else if ($this->statusseleksi == 4) {
            return "<div class='text-center'><div class='badge bg-label-secondary'>" . "Belum Seleksi Tahap 3" . "</div></div>";
        } else if ($this->statusseleksi == 5) {
            return "<div class='text-center'><div class='badge bg-label-success'>" . "Sudah Seleksi Tahap 3" . "</div></div>";
        }
       
    }
}
