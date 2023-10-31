<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MhsMagang extends Model
{
    use HasUuids;

    protected $table = 'mhs_magang';
    protected $fillable = ['nim', 'nip', 'nilai_akhir_magang', 'indeks_nilai_akhir_magang'];
    protected $primaryKey = 'id_mhsmagang';
    protected $keyType = 'string';
}
