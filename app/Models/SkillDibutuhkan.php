<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillDibutuhkan extends Model
{
    use HasFactory;

    protected $fillable = ['nama_skill_dibutuhkan'];
    protected $primaryKey = 'id_skill_dibutuhkan';

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
