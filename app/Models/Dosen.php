<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasUuids;

    protected $table = 'dosen';
    protected $fillable = ['nip','namadosen', 'nohpdosen', 'emaildosen', 'status','id_prodi','kode_dosen','id_univ','id_fakultas'];
    protected $primaryKey = 'nip';
    protected $keyType = 'string';
    public $timestamps = false;

    public function univ(){
        return $this->belongsTo(Universitas::class,'id_univ');
    }
    public function prodi(){
        return $this->belongsTo(ProgramStudi::class,'id_prodi');
    }
    public function fakultas(){
        return $this->belongsTo(Fakultas::class,'id_prodi');
    }
}