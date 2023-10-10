<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatkulNilai extends Model
{
    use HasFactory;

    protected $fillable = ['nilai'];
    protected $primaryKey = 'kdmatnilai';

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
