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
})->middleware(['auth', 'isAdmin', 'verified'])->name('dashboard');


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/register', [RegisterAdminController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterAdminController::class, 'adminregister']);
    Route::get('/set-password/{token}', [SetPasswordController::class, 'showResetForm'])->name('set.password');
    Route::post('/set-password', [SetPasswordController::class, 'reset'])->name('update.password');
    Route::get('/dashboard', [LoginAdminController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/logout', [LoginAdminController::class, 'logout'])->name('logout');
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
    Route::prefix('fakultas')->group(function () {
        Route::get('/', [App\Http\Controllers\FakultasController::class, 'index'])->name('fakultas.index');
        Route::get('/show/{id_univ}', [App\Http\Controllers\FakultasController::class, 'show'])->name('fakultas.show');
        Route::post('/store', [App\Http\Controllers\FakultasController::class, 'store'])->name('fakultas.store');
        Route::post('/update/{id}', [App\Http\Controllers\FakultasController::class, 'update'])->name('fakultas.update');
        Route::get('/edit/{id}', [App\Http\Controllers\FakultasController::class, 'edit'])->name('fakultas.edit');
        Route::post('/status/{id}', [App\Http\Controllers\FakultasController::class, 'status'])->name('fakultas.status');
    });
    Route::prefix('prodi')->group(function () {
        Route::get('/', [App\Http\Controllers\ProdiController::class, 'index'])->name('prodi.index');
        Route::post('/show', [App\Http\Controllers\ProdiController::class, 'show'])->name('prodi.show');
        Route::post('/store', [App\Http\Controllers\ProdiController::class, 'store'])->name('prodi.store');
        Route::post('/update/{id}', [App\Http\Controllers\ProdiController::class, 'update'])->name('prodi.update');
        Route::get('/edit/{id}', [App\Http\Controllers\ProdiController::class, 'edit'])->name('prodi.edit');
        Route::post('/status/{id}', [App\Http\Controllers\ProdiController::class, 'status'])->name('prodi.status');
        Route::get('/list-fakultas/{id_univ}', [App\Http\Controllers\ProdiController::class, 'list_fakultas'])->name('prodi.list_fakultas');
        Route::get('/list-prodi/{id_fakultas}', [App\Http\Controllers\ProdiController::class, 'list_prodi'])->name('prodi.list_prodi');
    });
    Route::prefix('dokumen-persyaratan')->group(function () {
        Route::get('/', [App\Http\Controllers\DokumenSyaratController::class, 'index'])->name('doc-syarat.index');
        Route::get('/show', [App\Http\Controllers\DokumenSyaratController::class, 'show'])->name('doc-syarat.show');
        Route::post('/store', [App\Http\Controllers\DokumenSyaratController::class, 'store'])->name('doc-syarat.store');
        Route::post('status/{id}', [App\Http\Controllers\DokumenSyaratController::class, 'status'])->name('doc-syarat.status');
        Route::post('/update/{id}', [App\Http\Controllers\DokumenSyaratController::class, 'update'])->name('doc-syarat.update');
        Route::get('/edit/{id}', [App\Http\Controllers\DokumenSyaratController::class, 'edit'])->name('doc-syarat.edit');
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
    Route::prefix('pegawai-industri')->group(function () {
        Route::get('/', [App\Http\Controllers\PegawaiIndustriController::class, 'index'])->name('pegawaiindustri.index');
        Route::get('/show', [App\Http\Controllers\PegawaiIndustriController::class, 'show'])->name('pegawaiindustri.show');
        Route::get('/create', [App\Http\Controllers\PegawaiIndustriController::class, 'create'])->name('pegawaiindustri.create');
        Route::post('/store', [App\Http\Controllers\PegawaiIndustriController::class, 'store'])->name('pegawaiindustri.store');
        Route::post('/update/{id}', [App\Http\Controllers\PegawaiIndustriController::class, 'update'])->name('pegawaiindustri.update');
        Route::post('/status/{id}', [App\Http\Controllers\PegawaiIndustriController::class, 'status'])->name('pegawaiindustri.status');
        Route::get('/edit/{id}', [App\Http\Controllers\PegawaiIndustriController::class, 'edit'])->name('pegawaiindustri.edit');
    });
    Route::prefix('jenis-magang')->group(function () {
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
        Route::post('/show', [App\Http\Controllers\mahasiswaController::class, 'show'])->name('mahasiswa.show');
        Route::post('/store', [App\Http\Controllers\mahasiswaController::class, 'store'])->name('mahasiswa.store');
        Route::post('/update/{id}', [App\Http\Controllers\mahasiswaController::class, 'update'])->name('mahasiswa.update');
        Route::get('/edit/{id}', [App\Http\Controllers\mahasiswaController::class, 'edit'])->name('mahasiswa.edit');
        Route::post('/status/{id}', [App\Http\Controllers\mahasiswaController::class, 'status'])->name('mahasiswa.status');
        Route::get('/list-fakultas/{id_univ}', [App\Http\Controllers\mahasiswaController::class, 'list_fakultas'])->name('mahasiswa.list_fakultas');
        Route::get('/list-prodi/{id_fakultas}', [App\Http\Controllers\mahasiswaController::class, 'list_prodi'])->name('mahasiswa.list_prodi');
    });
    Route::prefix('dosen')->group(function () {
        Route::get('/', [App\Http\Controllers\DosenController::class, 'index'])->name('dosen.index');
        Route::post('/show', [App\Http\Controllers\DosenController::class, 'show'])->name('dosen.show');
        Route::post('/store', [App\Http\Controllers\DosenController::class, 'store'])->name('dosen.store');
        Route::post('/update/{id}', [App\Http\Controllers\DosenController::class, 'update'])->name('dosen.update');
        Route::get('/edit/{id}', [App\Http\Controllers\DosenController::class, 'edit'])->name('dosen.edit');
        Route::post('/status/{id}', [App\Http\Controllers\DosenController::class, 'status'])->name('dosen.status');
        Route::get('/list-fakultas/{id_univ}', [App\Http\Controllers\DosenController::class, 'list_fakultas'])->name('dosen.list_fakultas');
        Route::get('/list-prodi/{id_fakultas}', [App\Http\Controllers\DosenController::class, 'list_prodi'])->name('dosen.list_prodi');
    });
    Route::prefix('komponen-penilaian')->group(function () {
        Route::get('/', [App\Http\Controllers\KomponenPenilaianController::class, 'index'])->name('komponen_penilaian.index');
        Route::get('/show', [App\Http\Controllers\KomponenPenilaianController::class, 'show'])->name('komponen_penilaian.show');
        Route::post('/store', [App\Http\Controllers\KomponenPenilaianController::class, 'store'])->name('komponen_penilaian.store');
        Route::post('/update/{id}', [App\Http\Controllers\KomponenPenilaianController::class, 'update'])->name('komponen_penilaian.update');
        Route::get('/edit/{id}', [App\Http\Controllers\KomponenPenilaianController::class, 'edit'])->name('komponen_penilaian.edit');
        Route::post('/status/{id}', [App\Http\Controllers\KomponenPenilaianController::class, 'status'])->name('komponen_penilaian.status');
        Route::get('/list-fakultas/{id_univ}', [App\Http\Controllers\KomponenPenilaianController::class, 'list_fakultas'])->name('komponen_penilaian.list_fakultas');
    });
});

Route::get('/pengaturan', function () {
    return view('pengaturan_akun.pengaturan');
});

Route::get('/apply_alert', function () {
    return view('apply.apply_alert');
});

Route::get('/magang_fakultas', function () {
    return view('layouts.program_magang.magang');
});

Route::get('/informasi/magang', function () {
    return view('layouts.program_magang.informasi_magang');
});

Route::get('/informasi/lowongan', function () {
    return view('company.lowongan_magang.informasi_lowongan');
});
Route::get('/detail/kandidat', function () {
    return view('company.lowongan_magang.detail_kandidat');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/lowongan-magang-tersimpan', function () {
    return view('layouts.program_magang.lowongan_magang_tersimpan');
});
Route::get('/lowongan-pekerjaan-tersimpan', function () {
    return view('layouts.program_magang.lowongan_pekerjaan_tersimpan');
});

Route::get('/informasi/pribadi', function () {
    return view('profile.informasi_pribadi');
});

Route::get('/detail-informasi-pengalaman', function () {
    return view('profile.pengalaman');
});

Route::get('/detail-informasi-dokumen', function () {
    return view('profile.dokumen');
});

Route::get('/profile-company', function () {
    return view('company.profile_company', ['active_menu' => 'profile-company']);
});

Route::get('/summary-profile', function () {
    return view('company.summary_profile');
});

Route::get('/jadwal-seleksi', function () {
    return view('company.jadwal_seleksi.index', ['active_menu' => 'jadwal-seleksi']);
});

Route::get('/halaman-lowongan-magang', function() {
    return view('lowongan_magang.kelola_lowongan_magang_admin.halaman_lowongan_magang');
});

Route::get('/tambah-lowongan-magang', function() {
    return view('lowongan_magang.kelola_lowongan_magang_admin.tambah_lowongan_magang');
});

Route::get('/edit-lowongan-magang', function() {
    return view('lowongan_magang.kelola_lowongan_magang_admin.edit_lowongan_magang');
});

Route::get('/detail-lowongan-magang', function() {
    return view('lowongan_magang.kelola_lowongan_magang_admin.detail_lowongan_magang');
});
Route::get('informasi/mitra/admin', function () {
    return view('lowongan_magang.informasi_lowongan.informasi_mitra', ['active_menu' => 'informasi/mitra/admin']);
});
Route::get('informasi/lowongan/admin', function () {
    return view('lowongan_magang.informasi_lowongan.informasi_lowongan', ['active_menu' => 'informasi/mitra/admin']);
});
Route::get('/detail/kandidat/admin', function () {
    return view('lowongan_magang.informasi_lowongan.detail', ['active_menu' => 'informasi/mitra/admin']);
});

Route::get('/kelola/mitra', function () {
    return view('mitra.kelola_mitra.index', ['active_menu' => 'kelola/mitra']);
});


Route::get('/company', function () {
    return view('company.lowongan.index', ['active_menu' => 'company']);
});

Route::get('/company/detail-lowongan', function () {
    return view('company.lowongan.detail', ['active_menu' => 'company']);
});

Route::get('/company/add', function () {
    return view('company.lowongan.add', ['active_menu' => 'company']);
});
