<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileUserLanguage extends Model
{
    protected $table = 'profile_user_languages';

    public function profileUser(){
        return $this->belongsTo(ProfileUser::class);
    }
}
