<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplicationEducation extends Model
{
    protected $table = 'job_application_educations';

    public function jobApplication(){
        return $this->belongsTo(JobApplication::class)->withTrashed();
    }
}
