<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NilaiPemblap extends Model
{
    use HasUuids;

    protected $table = 'nilai_pemblap';
    protected $fillable = ['nilai', 'oleh', 'dateinputnilai'];
    protected $primaryKey = 'id_nilai';
    protected $keyType = 'string';
}
