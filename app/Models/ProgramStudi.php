<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    use HasFactory, HasUuids;
    public $timestamps = false;
    protected $table = 'program_studi';
    protected $primaryKey = 'id_prodi';
    protected $fillable = [ 'id_fakultas', 'id_univ','namaprodi'];
    public $keyType = 'string';

    public function univ(){
        return $this->belongsTo(Universitas::class,'id_univ');
    }
    public function fakultas(){
       return $this->belongsTo(Fakultas::class,"id_fakultas");
    }

}