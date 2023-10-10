<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorLap extends Model
{
    use HasFactory;

    protected $fillable = ['namamentor', 'posisimentor', 'emailmentor', 'telpmentor'];
    protected $primaryKey = 'idmentor';

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
