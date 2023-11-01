<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    use HasUuids;

    protected $table = 'fakultas';
    protected $fillable = ['namafakultas'];
    protected $primaryKey = 'id_fakultas';
    public $timestamps=false;
    
    protected $keyType = 'string';
}