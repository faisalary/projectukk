<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelolaMitraController;
use App\Http\Controllers\MasterEmailController;
// 2 ini
use App\Http\Controllers\MitraJadwalController;
use App\Http\Controllers\JadwalSeleksiController;
// kyknya gak kepake ya?
use App\Http\Controllers\InformasiMitraController;
use App\Http\Controllers\LowonganMagangController;
use App\Http\Controllers\ProfileCompanyController;
use App\Http\Controllers\PegawaiIndustriController;
use App\Http\Controllers\AssignPembimbingController;
use App\Http\Controllers\LowonganMagangLkmController;
use App\Http\Controllers\Logbook\LogbookPemLapController;

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
        Route::post('set-date-confirm-closing/{id}', 'setDateConfirmClosing')->name('.set_confirm_closing');

        Route::get('/detail/{id}', 'detailInformasi')->name('.detail');
        Route::get('/get-data/{id}', 'getDataDetailInformasi')->name('.get_data');
        Route::post('update-status/{id}', 'updateStatusPelamar')->name('.update_status');
        Route::get('get-kandidat/{tahap}', 'getKandidat')->name('.get_kandidat');
        Route::post('set-jadwal/{id}', 'setJadwal')->name('.set_jadwal');
    });
    Route::prefix('kelola-lowongan')->name('kelola_lowongan')->group(function () {
        Route::get('/', 'index');
        Route::get('/show', 'show')->name('.show');
        Route::get('/create', 'create')->name('.create');
        Route::post('/store', 'store')->name('.store');
        Route::get('/detail/{id}', 'detail')->name('.detail');
        Route::get('/edit/{id}', 'edit')->name('.edit');
        Route::post('/update/{id}', 'update')->name('.update');
        Route::post('/change-status/{id}', 'status')->name('.change_status');
    });
});

Route::prefix('lowongan')->name('lowongan')->group(function () {
    Route::prefix('informasi')->name('.informasi')->controller(InformasiMitraController::class)->group(function () {
        Route::get('/', 'listMitra');
        Route::get('get-mitra', 'getListMitra')->name('.get_mitra');

        Route::get('mitra/{id}', 'index')->name('.list_lowongan');
        Route::get('show/{id}', 'show')->name('.show');

        Route::get('detail/{id}', 'detail')->name('.detail');
        Route::get('/get-data/{id}', 'getDataDetail')->name('.get_data');
    });

    Route::prefix('kelola')->name('.kelola')->controller(LowonganMagangLkmController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/show', 'show')->name('.show');
        Route::get('/detail/{id}', 'detail')->name('.detail');
        Route::post('/approved/{id}', 'approved')->name('.approved')->middleware('permission:kelola_lowongan_lkm.approval');
        Route::post('/rejected/{id}', 'rejected')->name('.rejected')->middleware('permission:kelola_lowongan_lkm.approval');
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

// Route::prefix('jadwal-seleksi-mitra')->name('jadwal_seleksi')->controller(JadwalSeleksiController::class)->group(function () {
//     Route::get('/', 'index');
//     Route::get('get-data', 'getData')->name('.get_data');
//     Route::get('detail/{id}', 'detail')->name('.detail');
//     Route::get('detail/get-data/{id}', 'getDetailData')->name('.get_data_detail');
//     Route::get('detail/{id_lowongan}/mahasiswa/{id_pendaftaran}', 'detailMahasiswa')->name('.detail_mahasiswa');
//     Route::post('detail/{id}/set-jadwal', 'setJadwal')->name('.set_jadwal');
//     Route::post('detail/approval/{id}', 'approval')->name('.approval');
// });

// Route::prefix('jadwal-seleksi')->group(function () {

//     Route::prefix('/lowongan')->group(function () {
//         Route::get('/{id_industri}', [App\Http\Controllers\LowonganJadwalController::class, 'index'])->name('jadwal.index');
//     });

//     Route::prefix('/lanjutan')->group(function () {
//         Route::get('/{id_lowongan}', [App\Http\Controllers\JadwalSeleksiController::class, 'index'])->name('seleksi.index');
//         Route::get('/show/{id}', [App\Http\Controllers\JadwalSeleksiController::class, 'show'])->name('seleksi.show');
//         Route::post('/store', [App\Http\Controllers\JadwalSeleksiController::class, 'store'])->name('seleksi.store');
//         Route::get('/detail/{id}', [App\Http\Controllers\JadwalSeleksiController::class, 'detail'])->name('seleksi.detail');
//         Route::post('/update/{id}', [App\Http\Controllers\JadwalSeleksiController::class, 'update'])->name('seleksi.update');
//         Route::get('/kirim-email', [App\Http\Controllers\MailController::class, 'index'])->name('seleksi.email');
//     });
// });

Route::prefix('profile-perusahaan')->name('profile_company')->controller(ProfileCompanyController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/{id}', 'update')->name('.update');
    Route::get('/edit/{id}', 'edit')->name('.edit');
});

Route::prefix('assign-pembimbing')->name('assign_pembimbing')->controller(AssignPembimbingController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/show', 'show')->name('.show');
    Route::post('assign-pembimbing-lapangan', 'assignPemLapangan')->name('.assign_pem_lapangan');
});

Route::prefix('company')->group(function () {
    Route::prefix('summary-profile')->controller()->group(function () {
        Route::get('/', [App\Http\Controllers\SummaryProfileController::class, 'index'])->name('summary_profile.index');
        Route::put('/{id}', [App\Http\Controllers\KelolaMitraController::class, 'update']);
        Route::get('/edit/{id}', [App\Http\Controllers\KelolaMitraController::class, 'edit']);
    });

});

Route::prefix('template-email')->name('template_email')->controller(MasterEmailController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/show', 'show')->name('.show');
    Route::get('/create', 'create')->name('.create');
    Route::post('/store', 'store')->name('.store');
    Route::get('edit/{id}', 'edit')->name('.edit');
    Route::post('update/{id}', 'update')->name('.update');
});


Route::prefix('kelola-mahasiswa-magang')->name('kelola_magang_pemb_lapangan')->controller(LogbookPemLapController::class)->group(function () {
    Route::get('/', 'viewList');
    Route::get('get-data', 'getData')->name('.get_data');
    Route::get('logbook/{id}', 'viewLogbook')->name('.logbook');
    Route::post('logbook/approval/{id}', 'approval')->name('.approval');
    Route::get('input-nilai/{id}', 'viewInputNilai')->name('.input_nilai');
    Route::post('input-nilai/store/{id}', 'storeNilai')->name('.store_nilai');
});

Route::middleware('permission:dashboard.dashboard_mitra')->get('dashboard/company', function () {
    return view('dashboard.company.index');
})->name('dashboard_company');