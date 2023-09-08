<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\ThemeSetting;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class FrontBgImageView extends Controller
{
    public function bgimage()
    {
        $img = ThemeSetting::all();
    }
    return view('layouts/front',['liat'=>$img]);
}
