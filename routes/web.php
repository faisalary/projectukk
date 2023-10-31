<?php

use Illuminate\Support\Facades\Auth;
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

require __DIR__ . '/auth.php';

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

Route::get('/magang_fakultas', function () {
    return view('layouts.program_magang.magang_fakultas');
});

Route::get('/informasi/magang', function () {
    return view('layouts.program_magang.informasi_magang');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/master_universitas', function () {
//     return view('masters.universitas.index', ['active_menu' => 'master_universitas']);
// });
Route::get('/master_fakultas', function () {
    return view('masters.fakultas.index', ['active_menu' => 'master_fakultas']);
});
Route::get('/master_prodi', function () {
    return view('masters.prodi.index', ['active_menu' => 'master_prodi']);
});
Route::get('/master_tahun_akademik', function () {
    return view('masters.tahun_akademik.index', ['active_menu' => 'master_tahun_akademik']);
});
Route::get('/master_nilai_mutu', function () {
    return view('masters.nilai_mutu.index', ['active_menu' => 'master_nilai_mutu']);
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
Route::get('/master_jenis_magang', function () {
    return view('masters.jenis_magang.index', ['active_menu' => 'master_jenis_magang']);
});
Route::get('/kelola_mitra', function () {
    return view('mitra.kelola_mitra.index', ['active_menu' => 'kelola_mitra']);
});

Route::prefix('master_universitas')->group(function () {
    Route::get('/', [App\Http\Controllers\UniversitasController::class, 'index'])->name('universitas.index');
    Route::get('/show', [App\Http\Controllers\UniversitasController::class, 'show'])->name('universitas.show');
    Route::get('/create', [App\Http\Controllers\UniversitasController::class, 'create'])->name('universitas.create');
    Route::post('/', [App\Http\Controllers\UniversitasController::class, 'store'])->name('universitas.store');
    Route::put('/{id}', [App\Http\Controllers\UniversitasController::class, 'update'])->name('universitas.update');
    Route::delete('/{id}', [App\Http\Controllers\UniversitasController::class, 'destroy'])->name('universitas.destroy');
});
