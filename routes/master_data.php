<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\IndustriController;
use App\Http\Controllers\mahasiswaController;
use App\Http\Controllers\NilaiMutuController;
use App\Http\Controllers\JenisMagangController;
use App\Http\Controllers\UniversitasController;
use App\Http\Controllers\DokumenSyaratController;
use App\Http\Controllers\TahunAkademikController;
use App\Http\Controllers\PegawaiIndustriController;
use App\Http\Controllers\KomponenPenilaianController;

Route::prefix('master')->group(function () {
    Route::prefix('fakultas')->controller(FakultasController::class)->group(function () {
        Route::get('/', 'index')->name('fakultas');
        Route::get('/show/{id_univ}', 'show')->name('fakultas.show');
        Route::post('/store', 'store')->name('fakultas.store');
        Route::post('/update/{id}', 'update')->name('fakultas.update');
        Route::get('/edit/{id}', 'edit')->name('fakultas.edit');
        Route::post('/status/{id}', 'status')->name('fakultas.status');
    });
    Route::prefix('prodi')->controller(ProdiController::class)->group(function () {
        Route::get('/', 'index')->name('prodi');
        Route::post('/show', 'show')->name('prodi.show');
        Route::post('/store', 'store')->name('prodi.store');
        Route::post('/update/{id}', 'update')->name('prodi.update');
        Route::get('/edit/{id}', 'edit')->name('prodi.edit');
        Route::post('/status/{id}', 'status')->name('prodi.status');
    });
    Route::prefix('dokumen-persyaratan')->controller(DokumenSyaratController::class)->group(function () {
        Route::get('/', 'index')->name('doc-syarat');
        Route::get('/show', 'show')->name('doc-syarat.show');
        Route::post('/store', 'store')->name('doc-syarat.store');
        Route::post('status/{id}', 'status')->name('doc-syarat.status');
        Route::post('/update/{id}', 'update')->name('doc-syarat.update');
        Route::get('/edit/{id}', 'edit')->name('doc-syarat.edit');
    });
    Route::prefix('tahun-akademik')->controller(TahunAkademikController::class)->group(function () {
        Route::get('/', 'index')->name('thn-akademik');
        Route::get('/show', 'show')->name('thn-akademik.show');
        Route::post('/store', 'store')->name('thn-akademik.store');
        Route::post('status/{id}', 'status')->name('thn-akademik.status');
        Route::post('/update/{id}', 'update')->name('thn-akademik.update');
        Route::get('/edit/{id}', 'edit')->name('thn-akademik.edit');
    });
    Route::prefix('nilai-mutu')->controller(NilaiMutuController::class)->group(function () {
        Route::get('/', 'index')->name('nilai-mutu');
        Route::get('/show', 'show')->name('nilai-mutu.show');
        Route::post('/store', 'store')->name('nilai-mutu.store');
        Route::post('status/{id}', 'status')->name('nilai-mutu.status');
        Route::post('/update/{id}', 'update')->name('nilai-mutu.update');
        Route::get('/edit/{id}', 'edit')->name('nilai-mutu.edit');
    });

    Route::prefix('mitra')->controller(IndustriController::class)->group(function () {
        Route::get('/', 'index')->name('mitra');
        Route::get('/show', 'show')->name('mitra.show');
        Route::get('/create', 'create')->name('mitra.create');
        Route::post('/store', 'store')->name('mitra.store');
        Route::post('/update/{id}', 'update')->name('mitra.update');
        Route::post('/status/{id}', 'status')->name('mitra.status');
        Route::get('/edit/{id}', 'edit')->name('mitra.edit');
    });
    Route::prefix('pegawai-industri')->controller(PegawaiIndustriController::class)->group(function () {
        Route::get('/', 'index')->name('pegawaiindustri');
        Route::get('/show', 'show')->name('pegawaiindustri.show');
        Route::get('/create', 'create')->name('pegawaiindustri.create');
        Route::post('/store', 'store')->name('pegawaiindustri.store');
        Route::post('/update/{id}', 'update')->name('pegawaiindustri.update');
        Route::post('/status/{id}', 'status')->name('pegawaiindustri.status');
        Route::get('/edit/{id}', 'edit')->name('pegawaiindustri.edit');
    });
    Route::prefix('jenis-magang')->controller(JenisMagangController::class)->group(function () {
        Route::get('/', 'index')->name('jenismagang');
        Route::get('/create', 'create')->name('jenismagang.create');
        Route::get('/show', 'show')->name('jenismagang.show');
        Route::post('/store', 'store')->name('jenismagang.store');
        Route::post('/update/{id}', 'update')->name('jenismagang.update');
        Route::get('/edit/{id}', 'edit')->name('jenismagang.edit');
        Route::post('/status/{id}', 'status')->name('jenismagang.status');
    });
    Route::prefix('universitas')->controller(UniversitasController::class)->group(function () {
        Route::get('/', 'index')->name('universitas');
        Route::get('/show', 'show')->name('universitas.show');
        Route::post('/store', 'store')->name('universitas.store');
        Route::post('/status/{id}', 'status')->name('universitas.status');
        Route::post('/update/{id}', 'update')->name('universitas.update');
        Route::get('/edit/{id}', 'edit')->name('universitas.edit');
    });
    Route::prefix('mahasiswa')->controller(mahasiswaController::class)->group(function () {
        Route::get('/', 'index')->name('mahasiswa');
        Route::post('/show', 'show')->name('mahasiswa.show');
        Route::post('/store', 'store')->name('mahasiswa.store');
        Route::post('/update/{id}', 'update')->name('mahasiswa.update');
        Route::get('/edit/{id}', 'edit')->name('mahasiswa.edit');
        Route::post('/status/{id}', 'status')->name('mahasiswa.status');
        Route::get('/list-fakultas/{id_univ}', 'list_fakultas')->name('mahasiswa.list_fakultas');
        Route::get('/list-prodi/{id_fakultas}', 'list_prodi')->name('mahasiswa.list_prodi');
        Route::post('/import', 'import')->name('mahasiswa.import');
    });
    Route::prefix('dosen')->controller(DosenController::class)->group(function () {
        Route::get('/', 'index')->name('dosen');
        Route::post('/show', 'show')->name('dosen.show');
        Route::post('/store', 'store')->name('dosen.store');
        Route::post('/update/{id}', 'update')->name('dosen.update');
        Route::get('/edit/{id}', 'edit')->name('dosen.edit');
        Route::post('/status/{id}', 'status')->name('dosen.status');
        Route::get('/list-fakultas/{id_univ}', 'list_fakultas')->name('dosen.list_fakultas');
        Route::get('/list-prodi/{id_fakultas}', 'list_prodi')->name('dosen.list_prodi');
        Route::post('/import', 'import')->name('dosen.import');
    });
    Route::prefix('komponen-penilaian')->controller(KomponenPenilaianController::class)->group(function () {
        Route::get('/', 'index')->name('komponen-penilaian');
        Route::get('/show/{scored_by}', 'show')->name('komponen-penilaian.show');
        Route::post('/store', 'store')->name('komponen-penilaian.store');
        Route::post('/update/{id}', 'update')->name('komponen-penilaian.update');
        Route::get('/edit/{id}', 'edit')->name('komponen-penilaian.edit');
        Route::post('/status/{id}', 'status')->name('komponen-penilaian.status');
        Route::get('/list-fakultas/{id_univ}', 'list_fakultas')->name('komponen-penilaian.list_fakultas');
    });
    Route::get('pembimbing-mandiri', function () {
        return view('masters.pembimbing_lapangan_mandiri.index');
    })->name('pembimbing-lapangan-mandiri');

    // Route::prefix('laporan-akhir')->group(function () {
    //     Route::get('/', [App\Http\Controllers\LaporanAkhirController::class, 'index'])->name('laporan-akhir.index');
    //     Route::get('/show', [App\Http\Controllers\LaporanAkhirController::class, 'show'])->name('laporan-akhir.show');
    //     Route::post('/store', [App\Http\Controllers\LaporanAkhirController::class, 'store'])->name('laporan-akhir.store');
    //     Route::post('/update/{id}', [App\Http\Controllers\LaporanAkhirController::class, 'update'])->name('laporan-akhir.update');
    //     Route::get('/edit/{id}', [App\Http\Controllers\LaporanAkhirController::class, 'edit'])->name('laporan-akhir.edit');
    //     Route::post('status/{id}', [App\Http\Controllers\LaporanAkhirController::class, 'status'])->name('laporan-akhir.status');
    // });
});
