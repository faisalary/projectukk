<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobApplicationSkill extends Model
{
    protected $table = 'job_application_skills';

    public function jobApplication(){
        return $this->belongsTo(JobApplication::class)->withTrashed();
    }

    public function skill(){
        return $this->belongsTo(Skill::class);
    }
}
