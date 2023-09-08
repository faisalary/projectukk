<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileUserSkill extends Model
{
    protected $table = 'profile_user_skills';

    public function profileUser(){
        return $this->belongsTo(ProfileUser::class);
    }

    public function skill(){
        return $this->belongsTo(Skill::class);
    }
}
