<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdiController;
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

Route::prefix('master')->group(function () {
    Route::get('/master_fakultas', function () {
        return view('masters.fakultas.index', ['active_menu' => 'master_fakultas']);
    });
    Route::prefix('master-prodi')->group(function () {
        Route::get('/', [App\Http\Controllers\ProdiController::class, 'index'])->name('prodi.index');
        Route::get('/show', [App\Http\Controllers\ProdiController::class, 'show'])->name('prodi.show');
        Route::post('/store', [App\Http\Controllers\ProdiController::class, 'store'])->name('prodi.store');
        Route::post('/update/{id}', [App\Http\Controllers\ProdiController::class, 'update'])->name('prodi.update');
        Route::get('/edit/{id}', [App\Http\Controllers\ProdiController::class, 'edit'])->name('prodi.edit');
        Route::post('/status/{id}', [App\Http\Controllers\ProdiController::class, 'status'])->name('prodi.status');
        Route::get('/list-fakultas/{id_univ}', [App\Http\Controllers\ProdiController::class, 'list_fakultas'])->name('prodi.list_fakultas');
    });
    Route::prefix('tahun-akademik')->group(function () {
        Route::get('/', [App\Http\Controllers\TahunAkademikController::class, 'index'])->name('thn-akademik.index');
        Route::get('/show', [App\Http\Controllers\TahunAkademikController::class, 'show'])->name('thn-akademik.show');
        Route::post('/store', [App\Http\Controllers\TahunAkademikController::class, 'store'])->name('thn-akademik.store');
        Route::post('status/{id}', [App\Http\Controllers\TahunAkademikController::class, 'status'])->name('thn-akademik.status');
        Route::post('/update/{id}', [App\Http\Controllers\TahunAkademikController::class, 'update'])->name('thn-akademik.update');
        Route::get('/edit/{id}', [App\Http\Controllers\TahunAkademikController::class, 'edit'])->name('thn-akademik.edit');
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
    Route::prefix('master-jenis-magang')->group(function () {
        Route::get('/', [App\Http\Controllers\JenisMagangController::class, 'index'])->name('jenismagang.index');
        Route::get('/show', [App\Http\Controllers\JenisMagangController::class, 'show'])->name('jenismagang.show');
        Route::post('/store', [App\Http\Controllers\JenisMagangController::class, 'store'])->name('jenismagang.store');
        Route::post('/update/{id}', [App\Http\Controllers\JenisMagangController::class, 'update'])->name('jenismagang.update');
        Route::get('/edit/{id}', [App\Http\Controllers\JenisMagangController::class, 'edit'])->name('jenismagang.edit');
        Route::post('/status/{id}', [App\Http\Controllers\JenisMagangController::class, 'status'])->name('jenismagang.status');
    });
    Route::prefix('universitas')->group(function () {
        Route::get('/', [App\Http\Controllers\UniversitasController::class, 'index'])->name('universitas.index');
        Route::get('/show', [App\Http\Controllers\UniversitasController::class, 'show'])->name('universitas.show');
        Route::post('/store', [App\Http\Controllers\UniversitasController::class, 'store'])->name('universitas.store');
        Route::post('/status/{id}', [App\Http\Controllers\UniversitasController::class, 'status'])->name('universitas.status');
        Route::post('/update/{id}', [App\Http\Controllers\UniversitasController::class, 'update'])->name('universitas.update');
        Route::get('/edit/{id}', [App\Http\Controllers\UniversitasController::class, 'edit'])->name('universitas.edit');
    });
    Route::prefix('mahasiswa')->group(function () {
        Route::get('/', [App\Http\Controllers\mahasiswaController::class, 'index'])->name('mahasiswa.index');
        Route::get('/show', [App\Http\Controllers\mahasiswaController::class, 'show'])->name('mahasiswa.show');
        Route::post('/store', [App\Http\Controllers\mahasiswaController::class, 'store'])->name('mahasiswa.store');
        Route::post('/destroy/{id}', [App\Http\Controllers\mahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');

        Route::post('/update/{id}', [App\Http\Controllers\mahasiswaController::class, 'update'])->name('mahasiswa.update');
        Route::get('/edit/{id}', [App\Http\Controllers\mahasiswaController::class, 'edit'])->name('mahasiswa.edit');
    });
});

Route::get('/pengaturan', function () {
    return view('pengaturan_akun.pengaturan_akun');
});

Route::get('/apply_alert', function () {
    return view('apply.apply_alert');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');