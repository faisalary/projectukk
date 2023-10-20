<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Model
{

    use HasUuids;

    protected $table = 'mahasiswa';
    protected $fillable = ['namamhs', 'emailmhs', 'nohpmhs', 'alamatmhs', 'kelas'];
    protected $keyType = 'string';
}