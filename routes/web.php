<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndustriController;

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
    Route::get('/master-prodi', function () {
        return view('masters.prodi.index', ['active_menu' => 'master-prodi']);
    });
    Route::prefix('tahun-akademik')->group(function () {
        Route::get('/', [App\Http\Controllers\TahunAkademikController::class, 'index'])->name('thn-akademik.index');
        Route::get('/show', [App\Http\Controllers\TahunAkademikController::class, 'show'])->name('thn-akademik.show');
        Route::post('/store', [App\Http\Controllers\TahunAkademikController::class, 'store'])->name('thn-akademik.store');
        Route::post('status/{id}', [App\Http\Controllers\TahunAkademikController::class, 'status'])->name('thn-akademik.status');
        Route::post('/update/{id}', [App\Http\Controllers\TahunAkademikController::class, 'update'])->name('thn-akademik.update');
        Route::get('/edit/{id}', [App\Http\Controllers\TahunAkademikController::class, 'edit'])->name('thn-akademik.edit');
    });
    Route::prefix('nilai-mutu')->group(function () {
        Route::get('/', [App\Http\Controllers\NilaiMutuController::class, 'index'])->name('nilai-mutu.index');
        Route::get('/show', [App\Http\Controllers\NilaiMutuController::class, 'show'])->name('nilai-mutu.show');
        Route::post('/store', [App\Http\Controllers\NilaiMutuController::class, 'store'])->name('nilai-mutu.store');
        Route::post('status/{id}', [App\Http\Controllers\NilaiMutuController::class, 'status'])->name('nilai-mutu.status');
        Route::post('/update/{id}', [App\Http\Controllers\NilaiMutuController::class, 'update'])->name('nilai-mutu.update');
        Route::get('/edit/{id}', [App\Http\Controllers\NilaiMutuController::class, 'edit'])->name('nilai-mutu.edit');
    });
    Route::prefix('mitra')->group(function () {
        Route::get('/', [App\Http\Controllers\IndustriController::class, 'index'])->name('mitra.index');
        Route::get('/show', [App\Http\Controllers\IndustriController::class, 'show'])->name('mitra.show');
        Route::get('/create', [App\Http\Controllers\IndustriController::class, 'create'])->name('mitra.create');
        Route::post('/store', [App\Http\Controllers\IndustriController::class, 'store'])->name('mitra.store');
        Route::post('/update/{id}', [App\Http\Controllers\IndustriController::class, 'update'])->name('mitra.update');
        Route::post('/status/{id}', [App\Http\Controllers\IndustriController::class, 'status'])->name('mitra.status');
        Route::get('/edit/{id}', [App\Http\Controllers\IndustriController::class, 'edit'])->name('mitra.edit');
    });
    Route::get('/master_mahasiswa', function () {
        return view('masters.mahasiswa.index', ['active_menu' => 'master_mahasiswa']);
    });
    Route::prefix('pegawai-industri')->group(function () {
        Route::get('/', [App\Http\Controllers\PegawaiIndustriController::class, 'index'])->name('pegawaiindustri.index');
        Route::get('/show', [App\Http\Controllers\PegawaiIndustriController::class, 'show'])->name('pegawaiindustri.show');
        Route::get('/create', [App\Http\Controllers\PegawaiIndustriController::class, 'create'])->name('pegawaiindustri.create');
        Route::post('/store', [App\Http\Controllers\PegawaiIndustriController::class, 'store'])->name('pegawaiindustri.store');
        Route::post('/update/{id}', [App\Http\Controllers\PegawaiIndustriController::class, 'update'])->name('pegawaiindustri.update');
        Route::post('/status/{id}', [App\Http\Controllers\PegawaiIndustriController::class, 'status'])->name('pegawaiindustri.status');
        Route::get('/edit/{id}', [App\Http\Controllers\PegawaiIndustriController::class, 'edit'])->name('pegawaiindustri.edit');
    });
    Route::get('/master_jenis_magang', function () {
        return view('masters.jenis_magang.index', ['active_menu' => 'master_jenis_magang']);
    });
    Route::get('/kelola_mitra', function () {
        return view('mitra.kelola_mitra.index', ['active_menu' => 'kelola_mitra']);
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
    Route::prefix('dosen')->group(function () {
        Route::get('/', [App\Http\Controllers\DosenController::class, 'index'])->name('dosen.index');
        Route::get('/show', [App\Http\Controllers\DosenController::class, 'show'])->name('dosen.show');
        Route::post('/store', [App\Http\Controllers\DosenController::class, 'store'])->name('dosen.store');
        Route::post('/update/{id}', [App\Http\Controllers\DosenController::class, 'update'])->name('dosen.update');
        Route::get('/edit/{id}', [App\Http\Controllers\DosenController::class, 'edit'])->name('dosen.edit');
        Route::post('/status/{id}', [App\Http\Controllers\DosenController::class, 'status'])->name('dosen.status');
    });
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

Route::prefix('master_mahasiswa')->group(function () {
    Route::get('/', [App\Http\Controllers\mahasiswaController::class, 'index'])->name('mahasiswa.index');
    Route::get('/show', [App\Http\Controllers\MahasiswaController::class, 'show'])->name('mahasiswa.show');
    Route::get('/create', [App\Http\Controllers\MahasiswaController::class, 'create'])->name('mahasiswa.create');
    Route::post('/', [App\Http\Controllers\MahasiswaController::class, 'store'])->name('mahasiswa.store');
    Route::put('/{id}', [App\Http\Controllers\MahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::delete('/{id}', [App\Http\Controllers\MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
});

Route::prefix('master-mitra')->group(function () {
    Route::get('/', [App\Http\Controllers\IndustriController::class, 'index'])->name('mitra.index');
    Route::get('/show', [App\Http\Controllers\IndustriController::class, 'show'])->name('mitra.show');
    Route::get('/create', [App\Http\Controllers\IndustriController::class, 'create'])->name('mitra.create');
    Route::post('/store', [App\Http\Controllers\IndustriController::class, 'store'])->name('mitra.store');
    Route::put('/update/{id}', [App\Http\Controllers\IndustriController::class, 'update'])->name('mitra.update');
    Route::delete('/destory/{id}', [App\Http\Controllers\IndustriController::class, 'destory'])->name('mitra.destory');
    Route::get('/edit/{id}', [App\Http\Controllers\IndustriController::class, 'edit'])->name('mitra.edit');
    Route::get('/list-fakultas/{id_univ}', [App\Http\Controllers\MahasiswaController::class, 'list_fakultas'])->name('mahasiswa.list_fakultas');
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
