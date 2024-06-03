<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BerkasMagang extends Model
{
    use HasUuids;

    protected $table = 'berkas_magang';
    protected $fillable = [
        'nama_berkas',
        'template',
        'status_upload',
        'id_jenismagang'

    ];
    public $timestamps = false;
    protected $primaryKey = 'id_berkas_magang';
    protected $keyType = 'string';

    public function jenis_magang()
    {
        return $this->belongsTo(JenisMagang::class, 'id_jenismagang');
    }
}
