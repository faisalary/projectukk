<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Model
{

    use HasFactory, HasUuids;
    protected $table = 'mahasiswa';
    protected $fillable = ['namamhs','id_univ','id_prodi','id_fakultas', 'emailmhs', 'nohpmhs', 'alamatmhs', 'angkatan','nim'];
    protected $keyType = 'string';
    protected $primaryKey = 'nim';
    public $timestamps = false;
}