<?php

namespace App\Models;

use App\Models\JenisMagang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


class KomponenNilai extends Model
{
    use HasUuids;

    protected $table = 'komponen_nilai';
    protected $fillable = ['namakomponen', 'bobot', 'tipe', 'scoredby', 'status', 'total_bobot', 'id_jenismagang'];
    protected $primaryKey = 'id_kompnilai';
    protected $keyType = 'string';
    public $timestamps = false;

    public function jenismagang()
    {
        return $this->belongsTo(JenisMagang::class, 'id_jenismagang');
    }
    public function getTotalBobotAttribute()
    {
        return $this->where('id_jenismagang', $this->id_jenismagang)
            ->distinct()
            ->sum('bobot');
    }
}
