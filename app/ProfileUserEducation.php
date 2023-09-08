<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileUserEducation extends Model
{
    protected $table = 'profile_user_educations';

    public function profileUser(){
        return $this->belongsTo(ProfileUser::class);
    }
}
