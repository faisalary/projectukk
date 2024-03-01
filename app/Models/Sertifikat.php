<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'sertifikat';
    protected $fillable =[
        'nim',
        'nama_sertif',
        'penerbit',
        'file_sertif',
        'startdate',
        'enddate',
        'deskripsi',
        'link_sertif'
    ];
    protected $primaryKey = 'id_sertif';
    protected $keyType = 'string';
    public $timestamps = false;
}
