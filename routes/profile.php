<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GantiController;
use App\Http\Controllers\GantiPasswordController;
use Illuminate\Support\Facades\Route;

Route::prefix('profile_detail')->name('profile_detail')->controller(ProfileController::class)->group(function(){
    Route::get('/','index')->name('.informasi-pribadi');
});
Route::get('/ganti', [GantiController::class, 'ganti'])->name('ganti.form');
Route::get('/ganti/show', [GantiController::class, 'show'])->name('ganti.show');
Route::post('ganti/foto', [GantiController::class, 'store'])->name('ganti.store');

Route::get('/ganti', [GantiController::class, 'ganti'])->name('ganti.form');
Route::post('/update', [GantiController::class, 'update'])->name('ganti.update');

Route::post('/hapus', [GantiController::class, 'hapus'])->name('hapus');

Route::get('/password', [GantiPasswordController::class, 'edit'])->name('password.edit');
Route::patch('/password', [GantiPasswordController::class, 'update'])->name('password.edit');
