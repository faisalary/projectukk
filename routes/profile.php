<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('profile_detail')->name('profile_detail')->controller(ProfileController::class)->group(function(){
    Route::get('/','index')->name('.informasi-pribadi');
});