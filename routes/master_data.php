<?php

use App\Http\Controllers\IgraciasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\IndustriController;
use App\Http\Controllers\mahasiswaController;
use App\Http\Controllers\NilaiMutuController;
use App\Http\Controllers\NilaiAkhirController;
use App\Http\Controllers\JenisMagangController;
use App\Http\Controllers\UniversitasController;
use App\Http\Controllers\DokumenSyaratController;
use App\Http\Controllers\DurasiMagangController;
use App\Http\Controllers\TahunAkademikController;
use App\Http\Controllers\PegawaiIndustriController;
use App\Http\Controllers\KomponenPenilaianController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\PosisiMagangController;

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
    Route::prefix('nilai-akhir')->controller(NilaiAkhirController::class)->group(function(){
        Route::get('/','index')->name('nilai_akhir');
        Route::get('/get-data','getData')->name('nilai_akhir.show');
        Route::post('store','store')->name('nilai_akhir.store');
        Route::get('edit/{id}','edit')->name('nilai_akhir.edit');
        Route::post('update/{id}','update')->name('nilai_akhir.update');
        Route::post('change-status/{id}','changeStatus')->name('nilai_akhir.change_status');
        Route::delete('deletee/{id}','destroy')->name('nilai_akhir.delete');
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
    Route::prefix('jenis-magang')->controller(JenisMagangController::class)->group(function () {
        Route::get('/', 'index')->name('jenismagang');
        Route::get('/create', 'create')->name('jenismagang.create');
        Route::get('/show', 'show')->name('jenismagang.show');
        Route::post('/store', 'store')->name('jenismagang.store');
        Route::post('/update/{id}', 'update')->name('jenismagang.update');
        Route::get('/edit/{id}', 'edit')->name('jenismagang.edit');
        Route::post('/status/{id}', 'status')->name('jenismagang.status');
    });
    Route::prefix('igracias')->controller(IgraciasController::class)->group(function () {
        Route::get('/', 'index')->name('igracias');
       
          // Mata Kuliah route
          Route::prefix('mata-kuliah')->controller(MataKuliahController::class)->group(function () {            
            Route::post('/show', 'show')->name('igracias.matakuliah.show');
            Route::post('/store', 'store')->name('igracias.matakuliah.store');
            Route::post('/update/{id}', 'update')->name('igracias.matakuliah.update');
            Route::get('/edit/{id}', 'edit')->name('igracias.matakuliah.edit');
            Route::post('/status/{id}', 'status')->name('igracias.matakuliah.status');
            Route::post('/import', 'import')->name('igracias.matakuliah.import');
            Route::get('/preview', 'preview')->name('igracias.matakuliah.preview');
            Route::post('/store-import', 'storeImport')->name('igracias.matakuliah.store_import');
            Route::post('/download_failed_data' , 'download_failed_data')->name('igracias.matakuliah.download_failed_data');
        });

        // Dosen route
        Route::prefix('dosen')->controller(DosenController::class)->group(function () {            
            Route::post('/show', 'show')->name('igracias.dosen.show');
            Route::post('/store', 'store')->name('igracias.dosen.store');
            Route::post('/update/{id}', 'update')->name('igracias.dosen.update');
            Route::get('/edit/{id}', 'edit')->name('igracias.dosen.edit');
            Route::post('/status/{id}', 'status')->name('igracias.dosen.status');
            Route::post('/import', 'import')->name('igracias.dosen.import');
            Route::get('/preview', 'preview')->name('igracias.dosen.preview');
            Route::post('/store-import', 'storeImport')->name('igracias.dosen.store_import');
            Route::post('/download_failed_data' , 'download_failed_data')->name('igracias.dosen.download_failed_data');
        });

        // Mahasiswa route
        Route::prefix('mahasiswa')->controller(mahasiswaController::class)->group(function () {            
            Route::post('/show', 'show')->name('igracias.mahasiswa.show');
            Route::post('/store', 'store')->name('igracias.mahasiswa.store');
            Route::post('/update/{id}', 'update')->name('igracias.mahasiswa.update');
            Route::get('/edit/{id}', 'edit')->name('igracias.mahasiswa.edit');
            Route::post('/status/{id}', 'status')->name('igracias.mahasiswa.status');
            Route::get('/list-fakultas/{id_univ}', 'list_fakultas')->name('igracias.mahasiswa.list_fakultas');
            Route::get('/list-prodi/{id_fakultas}', 'list_prodi')->name('igracias.mahasiswa.list_prodi');
            Route::post('/import', 'import')->name('igracias.mahasiswa.import');
            Route::get('/preview', 'preview')->name('igracias.mahasiswa.preview');
            Route::post('/store-import', 'storeImport')->name('igracias.mahasiswa.store_import');
            Route::post('/download_failed_data' , 'download_failed_data')->name('igracias.mahasiswa.download_failed_data');
        });
    });
    Route::prefix('posisi-magang')->controller(PosisiMagangController::class)->group(function () {
        Route::get('/', 'index')->name('posisimagang');
        Route::get('/create', 'create')->name('posisimagang.create');
        Route::get('/show', 'show')->name('posisimagang.show');
        Route::post('/store', 'store')->name('posisimagang.store');
        Route::post('/update/{id}', 'update')->name('posisimagang.update');
        Route::get('/edit/{id}', 'edit')->name('posisimagang.edit');  
        Route::post('/status/{id}', 'status')->name('posisimagang.status');      
    });
    Route::prefix('durasi-magang')->controller(DurasiMagangController::class)->group(function () {
        Route::get('/', 'index')->name('durasimagang');
        Route::get('/create', 'create')->name('durasimagang.create');
        Route::get('/show', 'show')->name('durasimagang.show');
        Route::post('/store', 'store')->name('durasimagang.store');
        Route::post('/update/{id}', 'update')->name('durasimagang.update');
        Route::get('/edit/{id}', 'edit')->name('durasimagang.edit');  
        Route::post('/status/{id}', 'status')->name('durasimagang.status');      
    });
    Route::prefix('universitas')->controller(UniversitasController::class)->group(function () {
        Route::get('/', 'index')->name('universitas');
        Route::get('/show', 'show')->name('universitas.show');
        Route::post('/store', 'store')->name('universitas.store');
        Route::post('/status/{id}', 'status')->name('universitas.status');
        Route::post('/update/{id}', 'update')->name('universitas.update');
        Route::get('/edit/{id}', 'edit')->name('universitas.edit');
    });   
    Route::prefix('komponen-penilaian')->controller(KomponenPenilaianController::class)->group(function () {
        Route::get('/', 'index')->name('komponen-penilaian');
        Route::get('show', 'show')->name('komponen-penilaian.show');
        Route::post('/store', 'store')->name('komponen-penilaian.store');
        Route::post('/update/{id}', 'update')->name('komponen-penilaian.update');
        Route::get('/edit/{id}', 'edit')->name('komponen-penilaian.edit');
        Route::post('status/{id}', 'status')->name('komponen-penilaian.status');
        Route::get('/list-fakultas/{id_univ}', 'list_fakultas')->name('komponen-penilaian.list_fakultas');
    });
    Route::prefix('wilayah')->controller(WilayahController::class)->group(function () {
        Route::get('/', 'index')->name('wilayah');
        Route::get('show', 'show')->name('wilayah.show');
        Route::post('/child', 'getChildren')->name('wilayah.child');
        Route::get('/create/{type}', 'create')->name('wilayah.create');
        Route::post('/store', 'store')->name('wilayah.store');
        Route::post('/update/{id}', 'update')->name('wilayah.update');
        Route::get('/edit/{id}', 'edit')->name('wilayah.edit');
    });
    Route::middleware('permission:pembimbing_lapangan_mandiri.view')->get('pembimbing-mandiri', function () {
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
