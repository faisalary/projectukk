<?php

use App\Http\Controllers\NilaiMagangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApproveMandiriController;
use App\Http\Controllers\NilaiMahasiswaController;
use App\Http\Controllers\SimpanLowonganController;
use App\Http\Controllers\LogBookMahasiswaController;
use App\Http\Controllers\ProfileMahasiswaController;
use App\Http\Controllers\StatusLamaranMagangController;
use App\Http\Controllers\BerkasAkhir\BerkasMahasiswaController;
use App\Http\Controllers\BerkasAkhir\BerkasAkhirMagangController;
use App\Http\Controllers\DataMahasiswaMagang\DataMahasiswaMagangController;
use App\Http\Controllers\Logbook\LogbookMahasiswaController as LogbookLogbookMahasiswaController;

Route::prefix('pengajuan-magang')->name('pengajuan_magang')->controller(ApproveMandiriController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('show', 'show')->name('.show');
    Route::post('approved', 'approved')->name('.approved');
    Route::post('/rejected/{id}', 'rejected')->name('.rejected');
});

Route::prefix('data-mahasiswa-magang')->name('data_mahasiswa')->controller(DataMahasiswaMagangController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/get-data', 'getDataTable')->name('.get_data');
});

Route::prefix('berkas-akhir-magang')->name('berkas_akhir_magang')->controller(BerkasAkhirMagangController::class)->group(function () {
    Route::prefix('magang-fakultas')->name('.fakultas')->group(function () {
        Route::get('/', 'viewMagangFakultas');
        Route::get('get-data', 'getDataFakultas')->name('.get_data');
        Route::get('detail-mhs/{id}', 'getDataMhs')->name('.detail_mhs');
        Route::get('detail-file/{id}', 'detailFile')->name('.detail_file');
        Route::post('approval-file/{id}', 'approvalBerkas')->name('.approval_file');
        Route::post('adjustment-nilai/{id}', 'adjustmentNilai')->name('.adjustment_nilai');
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

    Route::post('update-informasi-tambahan', 'updateInfoTambahan')->name('.update_info_tambahan');

    Route::post('update-pendidikan', 'updatePendidikan')->name('.update_pendidikan');
    Route::post('delete-pendidikan/{id}', 'deletePendidikan')->name('.delete_pendidikan');

    Route::post('update-keahlian', 'updateKeahlian')->name('.update_keahlian');

    Route::post('update-experience', 'updateExperience')->name('.update_experience');
    Route::post('delete-experience/{id}', 'deleteExperience')->name('.delete_experience');

    Route::post('update-dokumen', 'updateDokumenPendukung')->name('.update_dokumen');
    Route::post('delete-dokumen/{id}', 'deleteDokumen')->name('.delete_dokumen');

    Route::get('percentage', 'getPercentage')->name('.percentage');
});

// route untuk ke hlm. unduh cv
Route::prefix('unduh-profile')->name('unduh-profile.')->group(function () {
    Route::get('/{nim}', [ProfileMahasiswaController::class, 'showCV'])->name('cv');
});

// kegiatan saya -> landing page

Route::prefix('kegiatan-saya')->group(function () {
    Route::prefix('status-lamaran-magang')->name('lamaran_saya')->controller(StatusLamaranMagangController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('detail/{id}', 'detail')->name('.detail');
        Route::get('detail-lowongan/{id}', 'detailLowongan')->name('.detail_lowongan');
        Route::post('/approval-penawaran/{id}', 'approvalPenawaran')->name('.approval_penawaran');
    });

    Route::prefix('lowongan-tersimpan')->name('lowongan_tersimpan')->controller(SimpanLowonganController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('save/{id}', 'simpanLowongan')->name('.save');
    });

    Route::prefix('logbook')->name('logbook')->controller(LogbookLogbookMahasiswaController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('detail/{id}', 'detail')->name('.detail');

        Route::post('create-logbook', 'storeCreateLogbook')->name('.create');
        Route::post('change-logbook-type/{id_logbook_week}', 'changeLogbookType')->name('.change_type');
        Route::post('create-logbook-daily/{id_logbook_week}', 'storeLogbookDaily')->name('.create_logbook_daily');
        Route::post('update-logbook-daily/{id}', 'updateLogbookDaily')->name('.update_logbook_daily');

        Route::post('apply-logbook/{id_logbook_week}', 'applyLogbook')->name('.apply_logbook');
    });

    Route::prefix('berkas-akhir')->name('berkas_akhir')->controller(BerkasMahasiswaController::class)->group(function () {
        Route::get('/', 'viewBerkasMahasiswa');
        Route::post('store/{id}', 'storeBerkasMahasiswa')->name('.store');
    });

    Route::prefix('nilai-magang')->name('nilai_magang')->controller(NilaiMagangController::class)->group(function (){
        Route::get('/','index');
    });
});

// baru grouping route yang berhubungan dengan mahasiswa, belum dikerjakan/diperbaiki
// Route::middleware('role:Mahasiswa')->group(function () {

//     Route::get('/logbook-detail', function () {
//         return view('logbook.logbook_detail', ['active_menu' => 'logbook']);
//     });

    // Route::prefix('/kegiatan-saya')->group(function () {
    //     // Route::get('/lamaran-saya', [App\Http\Controllers\KonfirmasiMagangController::class, 'index'])->name('lamaran_saya.index');
    //     Route::post('/show', [App\Http\Controllers\KonfirmasiMagangController::class, 'show'])->name('lamaran_saya.show');
    //     Route::post('/store', [App\Http\Controllers\KonfirmasiMagangController::class, 'store'])->name('lamaran_saya.store');
    //     Route::get('/detail/{id}', [App\Http\Controllers\KonfirmasiMagangController::class, 'detail'])->name('lamaran_saya.detail');
    //     Route::get('/porto/{file}', [App\Http\Controllers\KonfirmasiMagangController::class, 'porto'])->name('lamaran_saya.porto');
    //     Route::post('/update/{id}', [App\Http\Controllers\KonfirmasiMagangController::class, 'update'])->name('lamaran_saya.update');
    //     Route::post('/mulai/{id}', [App\Http\Controllers\KonfirmasiMagangController::class, 'mulai'])->name('mulai.update');
    //     Route::post('/updateDitolak/{id}', [App\Http\Controllers\KonfirmasiMagangController::class, 'updateDitolak'])->name('lamaran_saya.updateDitolak');
    //     Route::get('/edit/{id}', [App\Http\Controllers\KonfirmasiMagangController::class, 'edit'])->name('lamaran_saya.edit');
    //     Route::get('/editMulai/{id}', [App\Http\Controllers\KonfirmasiMagangController::class, 'editMulai'])->name('mulai.edit');
    //     Route::post('/ambil/{nim}', [App\Http\Controllers\KonfirmasiMagangController::class, 'ambil'])->name('ambil.penawaran');
    //     Route::post('/tolak/{nim}', [App\Http\Controllers\KonfirmasiMagangController::class, 'tolak'])->name('tolak.penawaran');
    //     Route::post('/status/{id}', [App\Http\Controllers\KonfirmasiMagangController::class, 'status'])->name('lamaran_saya.status');
    // });

    // Route::get('/berkas/akhir', function () {
    //     return view('kegiatan_saya.berkas_akhir.index');
    // });

    // Route::get('/lowongan-pekerjaan-tersimpan', function () {
    //     return view('program_magang.lowongan_pekerjaan_tersimpan');
    // });
// });
