<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobApplicationPortfolio extends Model
{
    protected $table = 'job_application_portfolios';

    public function jobApplication(){
        return $this->belongsTo(JobApplication::class)->withTrashed();
    }
}
