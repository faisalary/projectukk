<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileUserExperience extends Model
{
    protected $table = 'profile_user_experiences';

    public function profileUser(){
        return $this->belongsTo(ProfileUser::class);
    }
}
