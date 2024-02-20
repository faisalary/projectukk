<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'experience';
    protected $fillable =[
        'nim',
        'posisi',
        'jenis',
        'name_intitutions',
        'startdate',
        'enddate',
        'deskripsi'
    ];
    protected $primaryKey = 'id_experience';
    protected $keyType = 'string';
    public $timestamps = false;
}
