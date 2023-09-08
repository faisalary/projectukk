<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterMajor extends Model
{
    protected $table = 'master_majors';
    protected $primaryKey = 'master_major_Id';

    protected $filled = [
        'major',
    ];

    protected $guarded = [];

}
