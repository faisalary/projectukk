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
    
    
Route::get('/pengaturan', function () {
        return view('pengaturan_akun.pengaturan_akun');
    });

Route::get('/apply_alert', function () {
    return view('apply.apply_alert');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/master_universitas', function () {
    return view('masters.universitas.index', ['active_menu' => 'master_universitas']);
});
Route::get('/master_fakultas', function () {
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
Route::get('/master_mahasiswa', function () {
    return view('masters.mahasiswa.index', ['active_menu' => 'master_mahasiswa']);
});
Route::get('/master_pegawai_industri', function () {
    return view('masters.pegawai_industri.index', ['active_menu' => 'master_pegawai_industri']);
});
Route::get('/master_dokumen_persyaratan', function () {
    return view('masters.dokumen_persyaratan.index', ['active_menu' => 'master_dokumen_persyaratan']);
});
Route::get('/master_komponen_penilaian', function () {
    return view('masters.komponen_penilaian.index', ['active_menu' => 'master_komponen_penilaian']);
});