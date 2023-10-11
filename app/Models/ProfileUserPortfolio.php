<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileUserPortfolio extends Model
{
    protected $table = 'profile_user_portfolios';

    public function profileUser(){
        return $this->belongsTo(ProfileUser::class);
    }
}
