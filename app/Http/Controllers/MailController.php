<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MyTestMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    
    public function index(){

	$details = [
    'title' => 'Halo ini aku mita, aku lagi coba test kirim email',
    'body' => 'This is for testing email using smtp'
    ];
   
    Mail::to('mitamutiara476@gmail.com')->send(new \App\Mail\EmailJadwalSeleksi($details));
   
    dd("Email sudah terkirim.");

	}
}