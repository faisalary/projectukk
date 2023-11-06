<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NilaiMutu extends Model
{
    use HasUuids;

    protected $table = 'nilai_mutu';
    protected $fillable = ['nilaimin', 'nilaimax', 'nilaimutu'];
    protected $primaryKey = 'id_nilai';
    protected $keyType = 'string';
    public $timestamps = false;
}
