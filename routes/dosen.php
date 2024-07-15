<?php

use App\Http\Controllers\ApprovalMahasiswaController;
use Illuminate\Support\Facades\Route;

Route::prefix('approval-mahasiswa')->name('approval_mahasiswa')->controller(ApprovalMahasiswaController::class)->group(function () {
    Route::get('/', 'index')->middleware('permission:approval_mhs_doswal.view');
    Route::get('get-data', 'getData')->name('.get_data')->middleware('permission:approval_mhs_doswal.view');
    Route::post('store', 'store')->name('.store');
    Route::get('edit/{id}', 'edit')->name('.edit');
    Route::post('update/{id}', 'update')->name('.update');
});