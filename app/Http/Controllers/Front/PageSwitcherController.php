<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class PageSwitcherController extends Controller
{
    
    public function switchPage($pagesw)
    {
        if (array_key_exists($pagesw, Config::get('filter_page'))) {
            Session::put('applocale', $pagesw);
        }
        return Redirect::back();
    }
}