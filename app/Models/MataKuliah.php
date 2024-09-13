<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    protected $table = 'mata_kuliah';
    protected $guarded = [];    
    protected $primaryKey = 'kode_mk';
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
