<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    use HasFactory;

    protected $fillable = ['namamitra', 'notelpon', 'alamat', 'namaPIC', 'nohpPIC', 'emailPIC', 'kategori', 'ketuagrup'];
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
