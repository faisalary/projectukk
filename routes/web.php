<?php


use Illuminate\Support\Facades\Route;
use App\Http\Middleware\isApplicant;
use App\Http\Controllers\Auth\AuthAdminController;
use App\Http\Controllers\Auth\AdminRegisterController;

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

// login users
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// untuk admin
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/register', [AdminRegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AdminRegisterController::class, 'adminregister']);
    Route::get('/login', [AuthAdminController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthAdminController::class, 'adminlogin']);
    Route::get('/dashboard', [AuthAdminController::class, 'dashboard'])->name('dashboard')->middleware(['auth:admin', 'admin.auth']); 
    Route::post('/logout', [AuthAdminController::class, 'logout'])->name('logout');
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
require __DIR__.'/auth.php';


//untuk tampilan home
Route::get('/search', [App\Http\Controllers\Front\FrontSearchController::class, 'searchOpenings'])->name('searchOpenings');
Route::post('/search', [App\Http\Controllers\Front\FrontSearchController::class, 'searchOpenings'])->name('searchOpenings');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
