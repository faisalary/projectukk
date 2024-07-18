<?php

use App\Http\Controllers\ApprovalMahasiswaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApprovalMahasiswaKaprodiController;
use App\Http\Controllers\DataMahasiswaMagangKaprodiController;

// Dosen Wali
Route::prefix('approval-mahasiswa')->name('approval_mahasiswa')->controller(ApprovalMahasiswaController::class)->group(function () {
    Route::get('/', 'index')->middleware('permission:approval_mhs_doswal.view');
    Route::get('get-data', 'getData')->name('.get_data')->middleware('permission:approval_mhs_doswal.view');
    Route::get('detail/{id}', 'detail')->name('.detail');
    Route::post('approval/{id}', 'approval')->name('.approval');
});

// Kaprodi
Route::prefix('approval-mahasiswa-kaprodi')->name('approval_mahasiswa_kaprodi')->controller(ApprovalMahasiswaKaprodiController::class)->group(function () {
    Route::get('/', 'index')->middleware('permission:approval_mhs_kaprodi.view');
    Route::get('get-data', 'getData')->name('.get_data')->middleware('permission:approval_mhs_kaprodi.view');
    Route::get('detail/{id}', 'detail')->name('.detail');
    Route::post('approval/{id}', 'approval')->name('.approval');
});

Route::prefix('data-mahasiswa-magang-kaprodi')->name('mahasiswa_magang_kaprodi')->controller(DataMahasiswaMagangKaprodiController::class)->group(function () {
    Route::get('/', 'index');
});