<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\isApplicant;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('layouts.front');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/dashboard', [AdminDashboardController::class,'index'])->name('dashboard');

//profile user
Route::group(['middleware' => isApplicant::class], function () {
    Route::get('/profile/setup', 'ProfileUserController@index')->name('profile.setup');
    Route::get('/profile', 'ProfileUserController@edit')->name('profile.index');
    Route::get('/profile/information', 'ProfileUserController@edit')->name('profile.information');
    Route::get('/profile/educations', 'ProfileUserController@edit')->name('profile.educations');
    Route::get('/profile/skills', 'ProfileUserController@edit')->name('profile.skills');
    Route::get('/profile/languages', 'ProfileUserController@edit')->name('profile.languages');
    Route::get('/profile/portfolio', 'ProfileUserController@edit')->name('profile.portfolio');
});



require __DIR__.'/auth.php';

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
