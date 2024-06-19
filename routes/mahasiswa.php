<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApproveMandiriController;
use App\Http\Controllers\NilaiMahasiswaController;
use App\Http\Controllers\BerkasAkhirMagangController;
use App\Http\Controllers\DataMahasiswaMagangController;
use App\Http\Controllers\LogBookMahasiswaController;

Route::prefix('pengajuan-magang')->name('pengajuan_magang')->controller(ApproveMandiriController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('show', 'show')->name('.show');
    Route::post('/approved/{id}', 'approved')->name('.approved');
    Route::post('/rejected/{id}', 'rejected')->name('.rejected');
});

Route::prefix('mahasiswa-magang')->name('data_magang')->controller(DataMahasiswaMagangController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/show', 'show')->name('.show');
    Route::post('/store', 'store')->name('.store');
    Route::post('/update{id}', 'update')->name('.update');
    Route::get('/edit{id}', 'edit')->name('.edit');
    Route::post('/status/{id}', 'status')->name('.status');
    Route::get('/doc/{file}', 'doc')->name('.doc');
});

Route::prefix('berkas-akhir-magang')->name('berkas_akhir_magang')->controller(BerkasAkhirMagangController::class)->group(function () {
    Route::prefix('magang-fakultas')->name('.fakultas')->group(function () {
        Route::get('/', 'viewMagangFakultas');
    });
    Route::prefix('magang-mandiri')->name('.mandiri')->group(function () {
        Route::get('/', 'viewMagangMandiri');
    });
});

Route::prefix('nilai-mahasiswa')->controller(NilaiMahasiswaController::class)->group(function () {
    Route::prefix('magang-fakultas')->group(function () {
        Route::get('/', 'viewMagangFakultas')->name('nilai-magang-fakultas.index');
        Route::get('detail', 'detailMagangFakultas')->name('nilai-magang-fakultas.detail');
    });

    Route::prefix('magang-mandiri')->group(function () {
        Route::get('/', 'viewMagangMandiri')->name('nilai-magang-mandiri.index');
        Route::get('detail', 'detailMagangMandiri')->name('nilai-magang-mandiri.detail');
    });
});

Route::prefix('logbook-mahasiswa')->controller(LogBookMahasiswaController::class)->group(function () {
    Route::prefix('magang-fakultas')->group(function () {
        Route::get('/', 'viewMagangFakultas')->name('logbook-magang-fakultas.index');
        Route::get('detail', 'detailMagangFakultas')->name('logbook-magang-fakultas.detail');
        Route::get('view', 'showMagangFakultas')->name('logbook-magang-fakultas.view');
    });

    Route::prefix('magang-mandiri')->group(function () {
        Route::get('/', 'viewMagangMandiri')->name('logbook-magang-mandiri.index');
        Route::get('detail', 'detailMagangMandiri')->name('logbook-magang-mandiri.detail');
        Route::get('view', 'showMagangMandiri')->name('logbook-magang-mandiri.view');
    });
});