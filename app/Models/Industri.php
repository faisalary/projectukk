<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Industri extends Model
{
    use HasUuids;

    protected $table = 'industri';
    protected $fillable = ['namaindustri', 'notelpon', 'email', 'alamatindustri', 'kategori_industri', 'statuskerjasama', 'des'];
    protected $primaryKey = 'id_industri';
    protected $keyType = 'string';
    public $timestamps = false;
}