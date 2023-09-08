<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileUserLanguage extends Model
{
    protected $table = 'profile_user_languages';

    public function profileUser(){
        return $this->belongsTo(ProfileUser::class);
    }
}
