<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginAdminController;
use App\Http\Controllers\Auth\RegisterAdminController;
use App\Http\Controllers\Auth\SetPasswordController;
use App\Http\Middleware\IsAdmin;

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
})->middleware(['auth', 'isAdmin','verified'])->name('dashboard');



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


require __DIR__.'/auth.php';
Route::get('/pengaturan', function () {
    return view('pengaturan_akun.pengaturan_akun');
});


Route::get('/apply_alert', function () {
    return view('apply.apply_alert');
});


//untuk tampilan home
Route::get('/search', [App\Http\Controllers\Front\FrontSearchController::class, 'searchOpenings'])->name('searchOpenings');
Route::post('/search', [App\Http\Controllers\Front\FrontSearchController::class, 'searchOpenings'])->name('searchOpenings');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/master_universitas', function () {
    return view('masters.universitas.index', ['active_menu' => 'master_universitas']);
});
Route::get('/', function () {
    return view('masters.fakultas.index', ['active_menu' => 'master_fakultas']);
});
Route::get('/master_prodi', function () {
    return view('masters.prodi.index', ['active_menu' => 'master_prodi']);
});
Route::get('/master_tahun_akademik', function () {
    return view('masters.tahun_akademik.index', ['active_menu' => 'master_tahun_akademik']);
});
Route::get('/master_mitra', function () {
    return view('masters.mitra.index', ['active_menu' => 'master_mitra']);
});
Route::get('/master_dosen', function () {
    return view('masters.dosen.index', ['active_menu' => 'master_dosen']);
});

Route::get('/master_nilai_mutu', function () {
    return view('masters.nilai_mutu.index', ['active_menu' => 'master_nilai_mutu']);
});
Route::get('/master_jenis_magang', function () {
    return view('masters.jenis_magang.index', ['active_menu' => 'master_jenis_magang']);
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/register', [RegisterAdminController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterAdminController::class, 'adminregister']);
    Route::get('/login', [LoginAdminController::class, 'showLoginForm'])->name('auth.login_mitra');
    Route::post('/login', [LoginAdminController::class, 'adminlogin'])->name('admin.login');
    Route::get('/set-password/{token}', [SetPasswordController::class, 'showResetForm'])->name('set.password');
    Route::post('/set-password', [SetPasswordController::class, 'reset'])->name('update.password');
    Route::get('/dashboard', [LoginAdminController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/logout', [LoginAdminController::class, 'logout'])->name('logout');
});