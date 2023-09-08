<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobApplicationLanguage extends Model
{
    protected $table = 'job_application_languages';

    public function jobApplication(){
        return $this->belongsTo(JobApplication::class)->withTrashed();
    }
}
