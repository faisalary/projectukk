<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupRisetLab extends Model
{
    use HasFactory;

    protected $fillable = ['namamitra', 'namaPIC', 'nohpPIC', 'emailPIC', 'kdruang_alamat', 'ketuaGrup'];
    protected $primaryKey = 'kdmitra';

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
