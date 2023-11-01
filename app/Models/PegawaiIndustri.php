<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PegawaiIndustri extends Model
{
    use HasUuids;

    protected $table = 'pegawai_industri';
    protected $fillable = ['id_peg_industri','id_industri', 'namapeg', 'nohppeg', 'emailpeg', 'jabatan', 'unit', 'statuspeg'];
    protected $primaryKey = 'id_peg_industri';
    protected $keyType = 'string';
    public $timestamps = false;

    public function industri(){
        return $this->belongsTo(industri::class, 'id_industri');
    }
}
