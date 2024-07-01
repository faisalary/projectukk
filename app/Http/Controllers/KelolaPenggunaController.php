<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KelolaPenggunaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:kelola_pengguna.view');
    }

    public function index()
    {
        return view('admin.kelola-pengguna.index');
    }
}
