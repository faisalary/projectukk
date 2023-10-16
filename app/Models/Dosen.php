<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasUuids;

    protected $table = 'dosen';
    protected $fillable = ['namadosen', 'nohpdosen', 'emaildosen', 'statusdosen'];
    protected $primaryKey = 'id_dosen';
    protected $keyType = 'string';
}
