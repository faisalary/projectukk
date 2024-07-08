<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApproveMandiriController;
use App\Http\Controllers\NilaiMahasiswaController;
use App\Http\Controllers\LogBookMahasiswaController;
use App\Http\Controllers\ProfileMahasiswaController;
use App\Http\Controllers\BerkasAkhirMagangController;
use App\Http\Controllers\DataMahasiswaMagangController;

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

Route::prefix('nilai-mahasiswa')->name('nilai_mahasiswa')->controller(NilaiMahasiswaController::class)->group(function () {
    Route::prefix('magang-fakultas')->name('.fakultas')->group(function () {
        Route::get('/', 'viewMagangFakultas');
        Route::get('detail', 'detailMagangFakultas')->name('.detail');
    });

    Route::prefix('magang-mandiri')->name('.mandiri')->group(function () {
        Route::get('/', 'viewMagangMandiri');
        Route::get('detail', 'detailMagangMandiri')->name('.detail');
    });
});

Route::prefix('logbook-mahasiswa')->name('logbook_magang')->controller(LogBookMahasiswaController::class)->group(function () {
    Route::prefix('magang-fakultas')->name('.fakultas')->group(function () {
        Route::get('/', 'viewMagangFakultas');
        Route::get('detail', 'detailMagangFakultas')->name('.detail');
        Route::get('view', 'showMagangFakultas')->name('.view');
    });

    Route::prefix('magang-mandiri')->name('.mandiri')->group(function () {
        Route::get('/', 'viewMagangMandiri');
        Route::get('detail', 'detailMagangMandiri')->name('.detail');
        Route::get('view', 'showMagangMandiri')->name('.view');
    });
});

Route::prefix('profile')->name('profile')->controller(ProfileMahasiswaController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('get-data-profile', 'getDataProfile')->name('.get_data');
    Route::post('update-data', 'update')->name('.update_data');
});

// kegiatan saya -> landing page
// baru grouping route yang berhubungan dengan mahasiswa, belum dikerjakan/diperbaiki
Route::middleware('role:Mahasiswa')->group(function () {
    Route::get('/logbook', function () {
        return view('logbook.logbook', ['active_menu' => 'logbook']);
    });

    Route::get('/logbook-detail', function () {
        return view('logbook.logbook_detail', ['active_menu' => 'logbook']);
    });

    Route::prefix('/kegiatan-saya')->group(function () {
        Route::get('/lamaran-saya', [App\Http\Controllers\KonfirmasiMagangController::class, 'index'])->name('lamaran_saya.index');
        Route::post('/show', [App\Http\Controllers\KonfirmasiMagangController::class, 'show'])->name('lamaran_saya.show');
        Route::post('/store', [App\Http\Controllers\KonfirmasiMagangController::class, 'store'])->name('lamaran_saya.store');
        Route::get('/detail/{id}', [App\Http\Controllers\KonfirmasiMagangController::class, 'detail'])->name('lamaran_saya.detail');
        Route::get('/porto/{file}', [App\Http\Controllers\KonfirmasiMagangController::class, 'porto'])->name('lamaran_saya.porto');
        Route::post('/update/{id}', [App\Http\Controllers\KonfirmasiMagangController::class, 'update'])->name('lamaran_saya.update');
        Route::post('/mulai/{id}', [App\Http\Controllers\KonfirmasiMagangController::class, 'mulai'])->name('mulai.update');
        Route::post('/updateDitolak/{id}', [App\Http\Controllers\KonfirmasiMagangController::class, 'updateDitolak'])->name('lamaran_saya.updateDitolak');
        Route::get('/edit/{id}', [App\Http\Controllers\KonfirmasiMagangController::class, 'edit'])->name('lamaran_saya.edit');
        Route::get('/editMulai/{id}', [App\Http\Controllers\KonfirmasiMagangController::class, 'editMulai'])->name('mulai.edit');
        Route::post('/ambil/{nim}', [App\Http\Controllers\KonfirmasiMagangController::class, 'ambil'])->name('ambil.penawaran');
        Route::post('/tolak/{nim}', [App\Http\Controllers\KonfirmasiMagangController::class, 'tolak'])->name('tolak.penawaran');
        Route::post('/status/{id}', [App\Http\Controllers\KonfirmasiMagangController::class, 'status'])->name('lamaran_saya.status');
    });

    Route::get('/nilai/magang', function () {
        return view('kegiatan_saya.nilai_magang.nilai');
    });

    Route::get('/berkas/akhir', function () {
        return view('kegiatan_saya.berkas_akhir.index');
    });

    Route::get('/lowongan-pekerjaan-tersimpan', function () {
        return view('program_magang.lowongan_pekerjaan_tersimpan');
    });
});
