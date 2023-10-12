<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LowonganMag extends Model
{
    use HasFactory;

    protected $fillable = ['tanggalinput', 'waktu_input'];
    protected $primaryKey = 'kdlowongan';

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
