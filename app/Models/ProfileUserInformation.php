<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileUserInformation extends Model
{
    protected $table = 'profile_user_informations';

    public function profileUser(){
        return $this->belongsTo(ProfileUser::class);
    }
}
