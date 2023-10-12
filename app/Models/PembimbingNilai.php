<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembimbingNilai extends Model
{
    use HasFactory;

    protected $fillable = ['nilaidosenpbb', 'tglnilaipbb', 'nilaimentor', 'tglnilaimentor', 'nilaiadjust', 'tgladjust', 'alasanadjust'];
    protected $primaryKey = 'kdnilai';

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
