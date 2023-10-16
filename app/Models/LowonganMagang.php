<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LowonganMagang extends Model
{
    use HasUuids;

    protected $table = 'lowongan_magang';
    protected $fillable = [
        'created_by',
        'intern_position',
        'bidang',
        'durasimagang',
        'deskripsi',
        'requirements',
        'kuota',
        'benefitmagang',
        'startdate',
        'enddate',
        'tahapan_seleksi',
        'date_confirm_closing',
    ];
    protected $primaryKey = 'id_lowongan';
    protected $keyType = 'string';
}
