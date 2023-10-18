<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Industri extends Model
{
    use HasUuids;

    protected $table = 'industri';
    protected $fillable = ['namaindustri', 'notelpon', 'alamatindustri', 'kategori_industri', 'statuskerjasama'];
    protected $primaryKey = 'id_industri';
    protected $keyType = 'string';
}
