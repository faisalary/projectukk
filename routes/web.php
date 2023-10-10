<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Front\JobController;
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

Route::group(['middleware' => 'auth'], function () {
    // Rute untuk AdminController di dalam namespace Auth
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
        Route::post('/update-profile', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
    });
});



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

    // Route::group(
    //     ['namespace' => 'Front', 'as' => 'Jobs.'], function () {
    //     Route::post('/search', 'FrontSearchController@searchOpenings')->name('searchOpenings');
    //     }
    // );

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
    
    
Route::get('/pengaturan', function () {
        return view('pengaturan_akun.pengaturan_akun');
    });


Route::post('/search', [App\Http\Controllers\Front\FrontSearchController::class, 'searchOpenings'])->name('searchOpenings');
    
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
