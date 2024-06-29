<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelolaMitraController;
use App\Http\Controllers\InformasiMitraController;
use App\Http\Controllers\LowonganMagangController;
use App\Http\Controllers\ProfileCompanyController;
use App\Http\Controllers\LowonganMagangLkmController;
use App\Http\Controllers\PegawaiIndustriController;

Route::prefix('kelola-mitra')->name('kelola_mitra')->controller(KelolaMitraController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/show', 'show')->name('.show');
    Route::post('/store', 'store')->name('.store');
    Route::get('/edit/{id}', 'edit')->name('.edit');
    Route::post('/update/{id}', 'update')->name('.update');
    Route::post('/status/{id}', 'status')->name('.status');
    Route::post('/approved/{id}', 'approved')->name('.approved');
    Route::post('/rejected/{id}', 'rejected')->name('.rejected');
});

Route::prefix('lowongan-magang')->controller(LowonganMagangController::class)->group(function () {
    Route::prefix('informasi-lowongan')->name('informasi_lowongan')->group(function () {
        Route::get('/', 'indexInformasi');
        Route::get('/show', 'showInformasi')->name('.show');
        Route::get('/detail/{id}', 'detail')->name('.detail');
    });
    Route::prefix('kelola-lowongan')->name('kelola_lowongan')->group(function () {
        Route::get('/', 'index');
        Route::get('/show', 'show')->name('.show');
        Route::get('/create', 'create')->name('.create');
        Route::post('/store', 'store')->name('.store');
        Route::get('/detail/{id}', 'detail')->name('.detail');
        Route::get('/edit/{id}', 'edit')->name('.edit');
        Route::post('/update/{id}', 'update')->name('.update');
    });
});

Route::prefix('lowongan')->name('lowongan')->group(function () {
    Route::prefix('informasi')->name('.informasi')->controller(InformasiMitraController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('show', 'show')->name('.show');
        Route::get('detail/{id}', 'detail')->name('.detail');
    });

    Route::prefix('kelola')->name('.kelola')->controller(LowonganMagangLkmController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/show', 'show')->name('.show');
        Route::get('/detail/{id}', 'detail')->name('.detail');
        Route::post('/approved/{id}', 'approved')->name('.approved')->middleware('kelola_lowongan_lkm.approval');
        Route::post('/rejected/{id}', 'rejected')->name('.rejected')->middleware('kelola_lowongan_lkm.approval');
    });
});

Route::prefix('anggota-tim')->name('pegawaiindustri')->controller(PegawaiIndustriController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/show', 'show')->name('.show');
    Route::post('/store', 'store')->name('.store');
    Route::get('/edit/{id}', 'edit')->name('.edit');
    Route::post('/update/{id}', 'update')->name('.update');
    Route::post('/status/{id}', 'status')->name('.status');
});

Route::prefix('jadwal-seleksi')->group(function () {

    Route::prefix('/lowongan')->group(function () {
        Route::get('/{id_industri}', [App\Http\Controllers\LowonganJadwalController::class, 'index'])->name('jadwal.index');
    });

    Route::prefix('/lanjutan')->group(function () {
        Route::get('/{id_lowongan}', [App\Http\Controllers\JadwalSeleksiController::class, 'index'])->name('seleksi.index');
        Route::get('/show/{id}', [App\Http\Controllers\JadwalSeleksiController::class, 'show'])->name('seleksi.show');
        Route::post('/store', [App\Http\Controllers\JadwalSeleksiController::class, 'store'])->name('seleksi.store');
        Route::get('/detail/{id}', [App\Http\Controllers\JadwalSeleksiController::class, 'detail'])->name('seleksi.detail');
        Route::post('/update/{id}', [App\Http\Controllers\JadwalSeleksiController::class, 'update'])->name('seleksi.update');
        Route::get('/kirim-email', [App\Http\Controllers\MailController::class, 'index'])->name('seleksi.email');
    });
});

Route::prefix('company')->group(function () {
        
    Route::prefix('profile-company')->controller(ProfileCompanyController::class)->group(function () {
        Route::get('/', 'index')->name('profile_company.index');
        Route::put('/{id}', 'update');
        Route::get('/edit/{id}', 'edit');
    });

    Route::prefix('summary-profile')->controller()->group(function () {
        Route::get('/', [App\Http\Controllers\SummaryProfileController::class, 'index'])->name('summary_profile.index');
        Route::put('/{id}', [App\Http\Controllers\KelolaMitraController::class, 'update']);
        Route::get('/edit/{id}', [App\Http\Controllers\KelolaMitraController::class, 'edit']);
    });

    Route::prefix('master-email')->controller()->group(function () {
        Route::get('/', [App\Http\Controllers\MasterEmailController::class, 'index'])->name('master_email.index');
        Route::get('/show', [App\Http\Controllers\MasterEmailController::class, 'show'])->name('master_email.show');
        Route::post('/store', [App\Http\Controllers\MasterEmailController::class, 'store'])->name('master_email.store');
        Route::post('/update/{id}', [App\Http\Controllers\MasterEmailController::class, 'update'])->name('master_email.update');
        Route::get('/edit/{id}', [App\Http\Controllers\MasterEmailController::class, 'edit'])->name('master_email.edit');
        Route::post('/status/{id}', [App\Http\Controllers\MasterEmailController::class, 'status'])->name('master_email.status');
    });
});

Route::get('dashboard/company', function () {
    return view('dashboard.company.index');
})->name('dashboard_company');