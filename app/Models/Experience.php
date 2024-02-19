<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Experience extends Model
{
    use HasUuids;

    protected $table = 'experience';
    protected $fillable = [
        'posisi',
        'nim',
        'jenis',
        'name_intitutions',
        'startdate',
        'enddate',
        'deskripsi',
    ];
    public $timestamps = false;
    protected $primaryKey = 'id_experience';
    protected $keyType = 'string';

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim');
    }
}
