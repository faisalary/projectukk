<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasUuids;

    protected $table = 'lokasi';
    protected $fillable = ['kota'];
    protected $primaryKey = 'id_lokasi';
    protected $keyType = 'string';
    public $timestamps = false;
}
