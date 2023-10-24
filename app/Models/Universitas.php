<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Universitas extends Model
{
    use HasUuids;

    protected $table = 'universitas';
    protected $fillable = ['namauniv', 'jalan', 'kota', 'telp', 'status'];
    protected $primaryKey = 'id_univ';
    protected $keyType = 'string';
    public $timestamps = false;
}
