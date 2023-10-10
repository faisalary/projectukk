<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function permissions(){
        return $this->hasMany(PermissionRole::class, 'role_id');
    }

    public function roleuser(){
        return $this->hasMany(RoleUser::class, 'role_id');
    }
}
