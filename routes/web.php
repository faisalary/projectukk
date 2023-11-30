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



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth'])->name('dashboard');
//admin
Route::get('/dashboard-admin', [App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard.admin');
//super admin
Route::get('/super-admin', [App\Http\Controllers\SuperAdminController::class, 'index'])->middleware(['auth'])->name('dashboard.superadmin');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/register', [App\Http\Controllers\Auth\RegisterAdminController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [App\Http\Controllers\Auth\RegisterAdminController::class, 'adminregister']);
    Route::get('/set-password/{token}', [App\Http\Controllers\Auth\SetPasswordController::class, 'showResetForm'])->name('set.password');
    Route::post('/set-password', [App\Http\Controllers\Auth\SetPasswordController::class, 'reset'])->name('update.password');
    Route::get('/logout', [App\Http\Controllers\Auth\LoginAdminController::class, 'logout'])->name('logout');
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

Route::middleware('auth')->group(function () {

    //untuk lkm
    Route::prefix('master')->middleware('can:only.lkm')->group(function () {
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
            Route::get('/', [App\Http\Controllers\KomponenPenilaianController::class, 'index'])->name('komponen-penilaian.index');
            Route::get('/show', [App\Http\Controllers\KomponenPenilaianController::class, 'show'])->name('komponen-penilaian.show');
            Route::post('/store', [App\Http\Controllers\KomponenPenilaianController::class, 'store'])->name('komponen-penilaian.store');
            Route::post('/update/{id}', [App\Http\Controllers\KomponenPenilaianController::class, 'update'])->name('komponen-penilaian.update');
            Route::get('/edit/{id}', [App\Http\Controllers\KomponenPenilaianController::class, 'edit'])->name('komponen-penilaian.edit');
            Route::post('/status/{id}', [App\Http\Controllers\KomponenPenilaianController::class, 'status'])->name('komponen-penilaian.status');
            Route::get('/list-fakultas/{id_univ}', [App\Http\Controllers\KomponenPenilaianController::class, 'list_fakultas'])->name('komponen-penilaian.list_fakultas');
        });
    });
    //kelola-mitra
    Route::prefix('company')->middleware('can:only.lkm')->group(function (){
        Route::prefix('kelola-mitra')->group(function () {
            Route::get('/', [App\Http\Controllers\KelolaMitraController::class, 'index'])->name('kelola_mitra.index');
            Route::get('/show', [App\Http\Controllers\KelolaMitraController::class, 'show'])->name('kelola_mitra.show');
            Route::post('/store', [App\Http\Controllers\KelolaMitraController::class, 'store'])->name('kelola_mitra.store');
            Route::post('/update/{id}', [App\Http\Controllers\KelolaMitraController::class, 'update'])->name('kelola_mitra.update');
            Route::get('/edit/{id}', [App\Http\Controllers\KelolaMitraController::class, 'edit'])->name('kelola_mitra.edit');
            Route::post('/status/{id}', [App\Http\Controllers\KelolaMitraController::class, 'status'])->name('kelola_mitra.status');
        });
        Route::prefix('profile-company')->group( function() {
            Route::get('/', [App\Http\Controllers\ProfileCompanyController::class, 'index'])->name('profile_company.index');
            Route::post('/store', [App\Http\Controllers\ProfileCompanyController::class, 'store'])->name('profile_company.store');
        });
    });
    Route::prefix('data-kandidat')->middleware('can:only.lkm')->group(function () {
        Route::get('/', [App\Http\Controllers\DatakandidatController::class, 'index'])->name('data-kandidat.index');
        Route::get('/show', [App\Http\Controllers\DatakandidatController::class, 'show'])->name('data-kandidat.show');
        Route::post('/store', [App\Http\Controllers\DatakandidatControllerta::class, 'store'])->name('data-kandidat.store');
        Route::post('/update/{id}', [App\Http\Controllers\DatakandidatController::class, 'update'])->name('data-kandidat.update');
        Route::get('/edit/{id}', [App\Http\Controllers\DatakandidatController::class, 'edit'])->name('data-kandidat.edit');
        Route::post('/status/{id}', [App\Http\Controllers\DatakandidatController::class, 'status'])->name('data-kandidat.status');
        Route::get('/list-kandidat/{id_univ}', [App\Http\Controllers\DatakandidatController::class, 'list_kandidat'])->name('data-kandidat.list_kandidat');
    });

    //route untuk LKM dan Mitra
    Route::prefix('informasi')->middleware('permission:only.lkm.mitra')->group(function () {
        Route::prefix('lowongan/admin')->group(function () {
            Route::get('/', [App\Http\Controllers\InformasiLowonganController::class, 'index'])->name('lowongan.index');
            Route::get('/show', [App\Http\Controllers\InformasiLowonganController::class, 'show'])->name('lowongan.show');
            Route::post('/store', [App\Http\Controllers\InformasiLowonganController::class, 'store'])->name('lowongan.store');
            Route::post('/status/{id}', [App\Http\Controllers\InformasiLowonganController::class, 'status'])->name('lowongan.status');
            Route::post('/update/{id}', [App\Http\Controllers\InformasiLowonganController::class, 'update'])->name('lowongan.update');
            Route::get('/edit/{id}', [App\Http\Controllers\InformasiLowonganController::class, 'edit'])->name('lowongan.edit');
        });
        Route::prefix('mitra/admin')->group(function () {
            Route::get('/', [App\Http\Controllers\InformasiMitraController::class, 'index'])->name('mitra.index');
            Route::get('/show', [App\Http\Controllers\InformasiMitraController::class, 'show'])->name('mitra.show');
            Route::post('/store', [App\Http\Controllers\InformasiMitraController::class, 'store'])->name('mitra.store');
            Route::post('/status/{id}', [App\Http\Controllers\InformasiMitraController::class, 'status'])->name('mitra.status');
            Route::post('/update/{id}', [App\Http\Controllers\InformasiMitraController::class, 'update'])->name('mitra.update');
            Route::get('/edit/{id}', [App\Http\Controllers\InformasiMitraController::class, 'edit'])->name('mitra.edit');
        });
        Route::prefix('kelola/lowongan')->group(function () {
            Route::get('/', [App\Http\Controllers\KelolaLowonganController::class, 'index'])->name('kelolalowongan.index');
            Route::get('/detail/lowongan', [App\Http\Controllers\KelolaLowonganController::class, 'index'])->name('kelolalowongan.index');
        });
        Route::prefix('kandidat/admin')->middleware('can:only.lkm')->group(function () {
            Route::get('/', [App\Http\Controllers\InformasiKandidatController::class, 'index'])->name('kandidat.index');
            Route::get('/show', [App\Http\Controllers\InformasiKandidatController::class, 'show'])->name('kandidat.show');
            Route::post('/store', [App\Http\Controllers\InformasiKandidatController::class, 'store'])->name('kandidat.store');
            Route::post('/status/{id}', [App\Http\Controllers\InformasiKandidatController::class, 'status'])->name('kandidat.status');
            Route::post('/update/{id}', [App\Http\Controllers\InformasiKandidatController::class, 'update'])->name('kandidat.update');
            Route::get('/edit/{id}', [App\Http\Controllers\InformasiKandidatController::class, 'edit'])->name('kandidat.edit');
        });
    });

    Route::prefix('/seleksi/lanjutan')->group(function () {
        Route::get('/', [App\Http\Controllers\JadwalSeleksiController::class, 'index'])->name('lowongan.index');
        Route::get('show', [App\Http\Controllers\JadwalSeleksiController::class, 'show'])->name('lowongan.show');
        Route::get('store', [App\Http\Controllers\JadwalSeleksiController::class, 'store'])->name('lowongan.store');
    });

    Route::prefix('company')->group(function (){
        Route::prefix('kelola-mitra')->group(function () {
            Route::get('/', [App\Http\Controllers\KelolaMitraController::class, 'index'])->name('kelola_mitra.index');
            Route::get('/show', [App\Http\Controllers\KelolaMitraController::class, 'show'])->name('kelola_mitra.show');
            Route::post('/store', [App\Http\Controllers\KelolaMitraController::class, 'store'])->name('kelola_mitra.store');
            Route::post('/update/{id}', [App\Http\Controllers\KelolaMitraController::class, 'update'])->name('kelola_mitra.update');
            Route::get('/edit/{id}', [App\Http\Controllers\KelolaMitraController::class, 'edit'])->name('kelola_mitra.edit');
            Route::post('/status/{id}', [App\Http\Controllers\KelolaMitraController::class, 'status'])->name('kelola_mitra.status');
        });
        Route::get('/', [App\Http\Controllers\KelolaMitraController::class, 'index'])->name('kelola_mitra.index'); 
        
        Route::prefix('profile-company')->group( function() {
            Route::get('/', [App\Http\Controllers\ProfileCompanyController::class, 'index'])->name('profile_company.index');
            Route::post('/store', [App\Http\Controllers\ProfileCompanyController::class, 'store'])->name('profile_company.store');
        });
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


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

Route::get('/detail/lowongan/magang', function () {
    return view('layouts.program_magang.detail_lowongan');
});
Route::get('/konfigurasi', function () {
    return view('konfigurasi.konfigurasi', ['active_menu' => 'konfigurasi']);
});
