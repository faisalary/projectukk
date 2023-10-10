<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisMagang extends Model
{
    use HasFactory;

    protected $fillable = ['namajenis', 'durasimagang'];
    protected $primaryKey = 'kdjenismagang';

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
