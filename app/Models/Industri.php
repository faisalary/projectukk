<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use App\Models\LowonganMagang;

class Industri extends Model
{
    use HasUuids;

    protected $table = 'industri';
    protected $fillable = ['namaindustri', 'notelpon', 'email', 'alamatindustri', 'kategori_industri', 'statuskerjasama', 'description', 'statusapprove'];
    protected $primaryKey = 'id_industri';
    protected $keyType = 'string';
    public $timestamps = false;

    public function relasi()
    {
        return $this->hasManyThrough(
            LowonganMagang::class,
            PendaftaranMagang::class,
            'id_pendaftaran',
            'id_lowongan',
            'id_pendaftaran',
            'id_lowongan'
        );
    }
    public function total_lowongan()
    {
        return $this->hasMany(LowonganMagang::class, 'id_industri');
    }
}
