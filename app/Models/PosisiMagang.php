<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosisiMagang extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id_posisi_magang'];
    protected $table = 'posisi_magang';
    protected $primaryKey = 'id_posisi_magang';
    public $keyType = 'string';
}
