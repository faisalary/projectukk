<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Auth::routes();
    //profile user
    Route::group(['middleware' => isApplicant::class], function () {
        Route::get('/profile/setup', 'ProfileController@index')->name('profile.setup');
        Route::get('/profile', 'ProfileController@edit')->name('profile.index');
        Route::get('/profile/information', 'ProfileController@edit')->name('profile.information');
        Route::get('/profile/educations', 'ProfileController@edit')->name('profile.educations');
        Route::get('/profile/skills', 'ProfileController@edit')->name('profile.skills');
        Route::get('/profile/languages', 'ProfileController@edit')->name('profile.languages');
        Route::get('/profile/portfolio', 'ProfileController@edit')->name('profile.portfolio');
        Route::post('/store-profile', 'ProfileController@store')->name('store-profile');
        Route::post('/store-personal', 'ProfileController@storePersonal')->name('store-personal');
        Route::post('/store-information', 'ProfileController@storeInformation')->name('store-information');
        Route::post('/store-educations', 'ProfileController@storeEducations')->name('store-educations');
        Route::post('/store-skills', 'ProfileController@storeSkills')->name('store-skills');
        Route::post('/store-languages', 'ProfileController@storeLanguages')->name('store-languages');
        Route::post('/store-portfolio', 'ProfileController@storePortfolio')->name('store-portfolio');
        Route::get('/profile/applications', 'ApplicationUserController@index')->name('application.index');
    });

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
