<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobApplicationExperience extends Model
{
    protected $table = 'job_application_experiences';

    public function jobApplication(){
        return $this->belongsTo(JobApplication::class)->withTrashed();
    }
}
