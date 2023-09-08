<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    //
    public function getStates(Country $country)
    {
        return $country->states()->select('id', 'name')->get();
    }
}
