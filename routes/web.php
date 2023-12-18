<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdiController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// landingpage
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
// after-login-user
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth'])->name('dashboard.user');
//admin
Route::get('/dashboard-admin/{id}', [App\Http\Controllers\DashboardMitraController::class, 'index'])->middleware(['auth'])->name('dashboard.admin');
//super admin
Route::get('/super-admin', [App\Http\Controllers\SuperAdminController::class, 'index'])->middleware(['auth'])->name('dashboard.superadmin');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'mitra', 'as' => 'admin.'], function () {
    Route::get('/register', [App\Http\Controllers\Auth\RegisterMitraController::class, 'showRegistrationForm'])->name('register.form');
    Route::post('/register', [App\Http\Controllers\Auth\RegisterMitraController::class, 'store'])->name('register.store');
    Route::get('/set-password/{token}', [App\Http\Controllers\Auth\SetPasswordController::class, 'showResetForm'])->name('set.password');
    Route::post('/set-password', [App\Http\Controllers\Auth\SetPasswordController::class, 'reset'])->name('update.password');
});

require __DIR__ . '/auth.php';

Auth::routes();
//profile user


Route::middleware('auth')->group(function () {

    //untuk lkm
    Route::prefix('master')->middleware('can:only.lkm')->group(function () {
        Route::prefix('fakultas')->group(function () {
            Route::get('/', [App\Http\Controllers\FakultasController::class, 'index'])->name('fakultas.index');
            Route::get('/show/{id_univ}', [App\Http\Controllers\FakultasController::class, 'show'])->name('fakultas.show');
            Route::post('/store', [App\Http\Controllers\FakultasController::class, 'store'])->name('fakultas.store');
            Route::post('/update/{id}', [App\Http\Controllers\FakultasController::class, 'update'])->name('fakultas.update');
            Route::get('/edit/{id}', [App\Http\Controllers\FakultasController::class, 'edit'])->name('fakultas.edit');
            Route::post('/status/{id}', [App\Http\Controllers\FakultasController::class, 'status'])->name('fakultas.status');
        });
        Route::prefix('prodi')->group(function () {
            Route::get('/', [App\Http\Controllers\ProdiController::class, 'index'])->name('prodi.index');
            Route::post('/show', [App\Http\Controllers\ProdiController::class, 'show'])->name('prodi.show');
            Route::post('/store', [App\Http\Controllers\ProdiController::class, 'store'])->name('prodi.store');
            Route::post('/update/{id}', [App\Http\Controllers\ProdiController::class, 'update'])->name('prodi.update');
            Route::get('/edit/{id}', [App\Http\Controllers\ProdiController::class, 'edit'])->name('prodi.edit');
            Route::post('/status/{id}', [App\Http\Controllers\ProdiController::class, 'status'])->name('prodi.status');
            Route::get('/list-fakultas/{id_univ}', [App\Http\Controllers\ProdiController::class, 'list_fakultas'])->name('prodi.list_fakultas');
            Route::get('/list-prodi/{id_fakultas}', [App\Http\Controllers\ProdiController::class, 'list_prodi'])->name('prodi.list_prodi');
        });
        Route::prefix('dokumen-persyaratan')->group(function () {
            Route::get('/', [App\Http\Controllers\DokumenSyaratController::class, 'index'])->name('doc-syarat.index');
            Route::get('/show', [App\Http\Controllers\DokumenSyaratController::class, 'show'])->name('doc-syarat.show');
            Route::post('/store', [App\Http\Controllers\DokumenSyaratController::class, 'store'])->name('doc-syarat.store');
            Route::post('status/{id}', [App\Http\Controllers\DokumenSyaratController::class, 'status'])->name('doc-syarat.status');
            Route::post('/update/{id}', [App\Http\Controllers\DokumenSyaratController::class, 'update'])->name('doc-syarat.update');
            Route::get('/edit/{id}', [App\Http\Controllers\DokumenSyaratController::class, 'edit'])->name('doc-syarat.edit');
        });
        Route::prefix('tahun-akademik')->group(function () {
            Route::get('/', [App\Http\Controllers\TahunAkademikController::class, 'index'])->name('thn-akademik.index');
            Route::get('/show', [App\Http\Controllers\TahunAkademikController::class, 'show'])->name('thn-akademik.show');
            Route::post('/store', [App\Http\Controllers\TahunAkademikController::class, 'store'])->name('thn-akademik.store');
            Route::post('status/{id}', [App\Http\Controllers\TahunAkademikController::class, 'status'])->name('thn-akademik.status');
            Route::post('/update/{id}', [App\Http\Controllers\TahunAkademikController::class, 'update'])->name('thn-akademik.update');
            Route::get('/edit/{id}', [App\Http\Controllers\TahunAkademikController::class, 'edit'])->name('thn-akademik.edit');
        });
        Route::prefix('nilai-mutu')->group(function () {
            Route::get('/', [App\Http\Controllers\NilaiMutuController::class, 'index'])->name('nilai-mutu.index');
            Route::get('/show', [App\Http\Controllers\NilaiMutuController::class, 'show'])->name('nilai-mutu.show');
            Route::post('/store', [App\Http\Controllers\NilaiMutuController::class, 'store'])->name('nilai-mutu.store');
            Route::post('status/{id}', [App\Http\Controllers\NilaiMutuController::class, 'status'])->name('nilai-mutu.status');
            Route::post('/update/{id}', [App\Http\Controllers\NilaiMutuController::class, 'update'])->name('nilai-mutu.update');
            Route::get('/edit/{id}', [App\Http\Controllers\NilaiMutuController::class, 'edit'])->name('nilai-mutu.edit');
        });

        Route::prefix('mitra')->group(function () {
            Route::get('/', [App\Http\Controllers\IndustriController::class, 'index'])->name('mitra.index');
            Route::get('/show', [App\Http\Controllers\IndustriController::class, 'show'])->name('mitra.show');
            Route::get('/create', [App\Http\Controllers\IndustriController::class, 'create'])->name('mitra.create');
            Route::post('/store', [App\Http\Controllers\IndustriController::class, 'store'])->name('mitra.store');
            Route::post('/update/{id}', [App\Http\Controllers\IndustriController::class, 'update'])->name('mitra.update');
            Route::post('/status/{id}', [App\Http\Controllers\IndustriController::class, 'status'])->name('mitra.status');
            Route::get('/edit/{id}', [App\Http\Controllers\IndustriController::class, 'edit'])->name('mitra.edit');
        });
        Route::prefix('pegawai-industri')->group(function () {
            Route::get('/', [App\Http\Controllers\PegawaiIndustriController::class, 'index'])->name('pegawaiindustri.index');
            Route::get('/show', [App\Http\Controllers\PegawaiIndustriController::class, 'show'])->name('pegawaiindustri.show');
            Route::get('/create', [App\Http\Controllers\PegawaiIndustriController::class, 'create'])->name('pegawaiindustri.create');
            Route::post('/store', [App\Http\Controllers\PegawaiIndustriController::class, 'store'])->name('pegawaiindustri.store');
            Route::post('/update/{id}', [App\Http\Controllers\PegawaiIndustriController::class, 'update'])->name('pegawaiindustri.update');
            Route::post('/status/{id}', [App\Http\Controllers\PegawaiIndustriController::class, 'status'])->name('pegawaiindustri.status');
            Route::get('/edit/{id}', [App\Http\Controllers\PegawaiIndustriController::class, 'edit'])->name('pegawaiindustri.edit');
        });
        Route::prefix('jenis-magang')->group(function () {
            Route::get('/', [App\Http\Controllers\JenisMagangController::class, 'index'])->name('jenismagang.index');
            Route::get('/show', [App\Http\Controllers\JenisMagangController::class, 'show'])->name('jenismagang.show');
            Route::post('/store', [App\Http\Controllers\JenisMagangController::class, 'store'])->name('jenismagang.store');
            Route::post('/update/{id}', [App\Http\Controllers\JenisMagangController::class, 'update'])->name('jenismagang.update');
            Route::get('/edit/{id}', [App\Http\Controllers\JenisMagangController::class, 'edit'])->name('jenismagang.edit');
            Route::post('/status/{id}', [App\Http\Controllers\JenisMagangController::class, 'status'])->name('jenismagang.status');
        });
        Route::prefix('universitas')->group(function () {
            Route::get('/', [App\Http\Controllers\UniversitasController::class, 'index'])->name('universitas.index');
            Route::get('/show', [App\Http\Controllers\UniversitasController::class, 'show'])->name('universitas.show');
            Route::post('/store', [App\Http\Controllers\UniversitasController::class, 'store'])->name('universitas.store');
            Route::post('/status/{id}', [App\Http\Controllers\UniversitasController::class, 'status'])->name('universitas.status');
            Route::post('/update/{id}', [App\Http\Controllers\UniversitasController::class, 'update'])->name('universitas.update');
            Route::get('/edit/{id}', [App\Http\Controllers\UniversitasController::class, 'edit'])->name('universitas.edit');
        });
        Route::prefix('mahasiswa')->group(function () {
            Route::get('/', [App\Http\Controllers\mahasiswaController::class, 'index'])->name('mahasiswa.index');
            Route::post('/show', [App\Http\Controllers\mahasiswaController::class, 'show'])->name('mahasiswa.show');
            Route::post('/store', [App\Http\Controllers\mahasiswaController::class, 'store'])->name('mahasiswa.store');
            Route::post('/update/{id}', [App\Http\Controllers\mahasiswaController::class, 'update'])->name('mahasiswa.update');
            Route::get('/edit/{id}', [App\Http\Controllers\mahasiswaController::class, 'edit'])->name('mahasiswa.edit');
            Route::post('/status/{id}', [App\Http\Controllers\mahasiswaController::class, 'status'])->name('mahasiswa.status');
            Route::get('/list-fakultas/{id_univ}', [App\Http\Controllers\mahasiswaController::class, 'list_fakultas'])->name('mahasiswa.list_fakultas');
            Route::get('/list-prodi/{id_fakultas}', [App\Http\Controllers\mahasiswaController::class, 'list_prodi'])->name('mahasiswa.list_prodi');
            Route::post('/import', [App\Http\Controllers\mahasiswaController::class, 'import'])->name('mahasiswa.import');
        });
        Route::prefix('dosen')->group(function () {
            Route::get('/', [App\Http\Controllers\DosenController::class, 'index'])->name('dosen.index');
            Route::post('/show', [App\Http\Controllers\DosenController::class, 'show'])->name('dosen.show');
            Route::post('/store', [App\Http\Controllers\DosenController::class, 'store'])->name('dosen.store');
            Route::post('/update/{id}', [App\Http\Controllers\DosenController::class, 'update'])->name('dosen.update');
            Route::get('/edit/{id}', [App\Http\Controllers\DosenController::class, 'edit'])->name('dosen.edit');
            Route::post('/status/{id}', [App\Http\Controllers\DosenController::class, 'status'])->name('dosen.status');
            Route::get('/list-fakultas/{id_univ}', [App\Http\Controllers\DosenController::class, 'list_fakultas'])->name('dosen.list_fakultas');
            Route::get('/list-prodi/{id_fakultas}', [App\Http\Controllers\DosenController::class, 'list_prodi'])->name('dosen.list_prodi');
        });
        Route::prefix('komponen-penilaian')->group(function () {
            Route::get('/', [App\Http\Controllers\KomponenPenilaianController::class, 'index'])->name('komponen-penilaian.index');
            Route::get('/show', [App\Http\Controllers\KomponenPenilaianController::class, 'show'])->name('komponen-penilaian.show');
            Route::post('/store', [App\Http\Controllers\KomponenPenilaianController::class, 'store'])->name('komponen-penilaian.store');
            Route::post('/update/{id}', [App\Http\Controllers\KomponenPenilaianController::class, 'update'])->name('komponen-penilaian.update');
            Route::get('/edit/{id}', [App\Http\Controllers\KomponenPenilaianController::class, 'edit'])->name('komponen-penilaian.edit');
            Route::post('/status/{id}', [App\Http\Controllers\KomponenPenilaianController::class, 'status'])->name('komponen-penilaian.status');
            Route::get('/list-fakultas/{id_univ}', [App\Http\Controllers\KomponenPenilaianController::class, 'list_fakultas'])->name('komponen-penilaian.list_fakultas');
        });
    });
    Route::prefix('konfigurasi')->middleware('permission:only.lkm')->group(function () {
        Route::get('/', [App\Http\Controllers\KonfigurasiController::class, 'index'])->name('konfigurasi.index');
    });
    //kelola-mitra
    Route::prefix('company')->middleware('can:only.lkm')->group(function () {
        Route::prefix('kelola-mitra')->group(function () {
            Route::get('/', [App\Http\Controllers\KelolaMitraController::class, 'index'])->name('kelola_mitra.index');
            Route::get('/show/{statusapprove}', [App\Http\Controllers\KelolaMitraController::class, 'show'])->name('kelola_mitra.show');
            Route::post('/store', [App\Http\Controllers\KelolaMitraController::class, 'store'])->name('kelola_mitra.store');
            Route::post('/update/{id}', [App\Http\Controllers\KelolaMitraController::class, 'update'])->name('kelola_mitra.update');
            Route::get('/edit/{id}', [App\Http\Controllers\KelolaMitraController::class, 'edit'])->name('kelola_mitra.edit');
            Route::post('/status/{id}', [App\Http\Controllers\KelolaMitraController::class, 'status'])->name('kelola_mitra.status');
            Route::post('/approved/{id}', [App\Http\Controllers\KelolaMitraController::class, 'approved'])->name('kelola_mitra.approved');
            Route::post('/rejected/{id}', [App\Http\Controllers\KelolaMitraController::class, 'rejected'])->name('kelola_mitra.rejected');
        });
        Route::prefix('profile-company')->group(function () {
            Route::get('/', [App\Http\Controllers\ProfileCompanyController::class, 'index'])->name('profile_company.index');
            Route::post('/store', [App\Http\Controllers\ProfileCompanyController::class, 'store'])->name('profile_company.store');
            Route::post('/update/{id}', [App\Http\Controllers\ProfileCompanyController::class, 'update'])->name('profile_company.update');
        });
    });
    Route::prefix('data-kandidat')->middleware('can:only.lkm')->group(function () {
        Route::get('/', [App\Http\Controllers\DatakandidatController::class, 'index'])->name('data-kandidat.index');
        Route::get('/show', [App\Http\Controllers\DatakandidatController::class, 'show'])->name('data-kandidat.show');
        Route::post('/store', [App\Http\Controllers\DatakandidatController::class, 'store'])->name('data-kandidat.store');
        Route::post('/update/{id}', [App\Http\Controllers\DatakandidatController::class, 'update'])->name('data-kandidat.update');
        Route::get('/edit/{id}', [App\Http\Controllers\DatakandidatController::class, 'edit'])->name('data-kandidat.edit');
        Route::post('/status/{id}', [App\Http\Controllers\DatakandidatController::class, 'status'])->name('data-kandidat.status');
        Route::get('/list-kandidat/{id_univ}', [App\Http\Controllers\DatakandidatController::class, 'list_kandidat'])->name('data-kandidat.list_kandidat');
    });

    //route untuk LKM dan Mitra
    Route::prefix('informasi')->middleware([RoleMiddleware::class])->group(function () {
        Route::prefix('/lowongan/{id_industri}')->group(function () {
            Route::get('/', [App\Http\Controllers\InformasiLowonganController::class, 'index'])->name('lowongan.index');
            Route::get('/show', [App\Http\Controllers\InformasiLowonganController::class, 'show'])->name('lowongan.show');
            Route::post('/store', [App\Http\Controllers\InformasiLowonganController::class, 'store'])->name('lowongan.store');
            Route::post('/status/{id}', [App\Http\Controllers\InformasiLowonganController::class, 'status'])->name('lowongan.status');
            Route::post('/update/{id}', [App\Http\Controllers\InformasiLowonganController::class, 'update'])->name('lowongan.update');
            Route::get('/edit/{id}', [App\Http\Controllers\InformasiLowonganController::class, 'edit'])->name('lowongan.edit');
        });
        Route::prefix('mitra/')->middleware('can:only.lkm')->group(function () {
            Route::get('/', [App\Http\Controllers\InformasiMitraController::class, 'index'])->name('mitra.index');
            Route::get('/show', [App\Http\Controllers\InformasiMitraController::class, 'show'])->name('mitra.show');
            Route::post('/store', [App\Http\Controllers\InformasiMitraController::class, 'store'])->name('mitra.store');
            Route::post('/status/{id}', [App\Http\Controllers\InformasiMitraController::class, 'status'])->name('mitra.status');
            Route::post('/update/{id}', [App\Http\Controllers\InformasiMitraController::class, 'update'])->name('mitra.update');
            Route::get('/edit/{id}', [App\Http\Controllers\InformasiMitraController::class, 'edit'])->name('mitra.edit');
        });
        Route::prefix('kandidat/')->group(function () {
            Route::get('/', [App\Http\Controllers\InformasiKandidatController::class, 'index'])->name('kandidat.index');
            Route::get('/show', [App\Http\Controllers\InformasiKandidatController::class, 'show'])->name('kandidat.show');
            Route::post('/store', [App\Http\Controllers\InformasiKandidatController::class, 'store'])->name('kandidat.store');
            Route::post('/status/{id}', [App\Http\Controllers\InformasiKandidatController::class, 'status'])->name('kandidat.status');
            Route::post('/update/{id}', [App\Http\Controllers\InformasiKandidatController::class, 'update'])->name('kandidat.update');
            Route::get('/edit/{id}', [App\Http\Controllers\InformasiKandidatController::class, 'edit'])->name('kandidat.edit');
        });
    });

    Route::prefix('/seleksi/lanjutan')->group(function () {
        Route::get('/', [App\Http\Controllers\JadwalSeleksiController::class, 'jadwal'])->name('seleksi.jadwal');
        Route::get('/jadwal', [App\Http\Controllers\JadwalSeleksiController::class, 'index'])->name('seleksi.index');
        Route::post('/show', [App\Http\Controllers\JadwalSeleksiController::class, 'show'])->name('seleksi.show');
        Route::post('/store', [App\Http\Controllers\JadwalSeleksiController::class, 'store'])->name('seleksi.store');
    });

    Route::prefix('kelola')->group(function () {
        Route::prefix('lowongan/')->group(function () {
            Route::get('/', [App\Http\Controllers\LowonganMagangController::class, 'index'])->name('lowongan-magang.index');
            Route::get('/show', [App\Http\Controllers\LowonganMagangController::class, 'show'])->name('lowongan-magang.show');
            Route::get('/create', [App\Http\Controllers\LowonganMagangController::class, 'create'])->name('lowongan-magang.create');
            Route::post('/store', [App\Http\Controllers\LowonganMagangController::class, 'store'])->name('lowongan-magang.store');
            Route::post('/create', [App\Http\Controllers\LowonganMagangController::class, 'create'])->name('lowongan-magang.create');
            Route::post('/detail', [App\Http\Controllers\LowonganMagangController::class, 'detail'])->name('lowongan-magang.detail');
            Route::post('/update/{id}', [App\Http\Controllers\LowonganMagangController::class, 'update'])->name('lowongan-magang.update');
            Route::get('/edit/{id}', [App\Http\Controllers\LowonganMagangController::class, 'edit'])->name('lowongan-magang.edit');
            Route::post('/status/{id}', [App\Http\Controllers\LowonganMagangController::class, 'status'])->name('lowongan-magang.status');
        });
    });
});

Route::get('/pengaturan', function () {
    return view('pengaturan_akun.pengaturan');
});

Route::get('/apply_alert', function () {
    return view('apply.apply_alert');
});

Route::get('/magang_fakultas', function () {
    return view('layouts.program_magang.magang');
});

Route::get('/informasi/magang', function () {
    return view('layouts.program_magang.informasi_magang');
});

Route::get('/lowongan-magang-tersimpan', function () {
    return view('layouts.program_magang.lowongan_magang_tersimpan');
});

Route::get('/lowongan-pekerjaan-tersimpan', function () {
    return view('layouts.program_magang.lowongan_pekerjaan_tersimpan');
});

Route::get('/informasi/pribadi', function () {
    return view('profile.informasi_pribadi');
});

Route::get('/detail-informasi-pengalaman', function () {
    return view('profile.pengalaman');
});

Route::get('/detail-informasi-dokumen', function () {
    return view('profile.dokumen');
});

Route::get('/profile-company', function () {
    return view('company.profile_company', ['active_menu' => 'profile-company']);
});

Route::get('/summary-profile', function () {
    return view('company.summary_profile');
});

Route::prefix('jadwal-seleksi')->group(function () {
    Route::get('/', [App\Http\Controllers\JadwalSeleksiController::class, 'jadwal'])->name('seleksi.jadwal');
    Route::get('/jadwal', [App\Http\Controllers\JadwalSeleksiController::class, 'index'])->name('seleksi.index');
    Route::post('/sho w', [App\Http\Controllers\JadwalSeleksiController::class, 'show'])->name('seleksi.show');
    Route::post('/store', [App\Http\Controllers\JadwalSeleksiController::class, 'store'])->name('seleksi.store');
    Route::post('/update/{id}', [App\Http\Controllers\JadwalSeleksiController::class, 'update'])->name('seleksi.update');
    Route::get('/edit/{id}', [App\Http\Controllers\JadwalSeleksiController::class, 'edit'])->name('seleksi.edit');
    Route::post('/status/{id}', [App\Http\Controllers\JadwalSeleksiController::class, 'status'])->name('seleksi.status');
});

Route::get('/detail/lowongan/magang', function () {
    return view('layouts.program_magang.detail_lowongan');
});
Route::get('/konfigurasi', function () {
    return view('konfigurasi.konfigurasi', ['active_menu' => 'konfigurasi']);
});

Route::get('/anggota/tim', function () {
    return view('company.anggota_tim.index');
});

Route::get('/detail/lowongan/magang', function () {
    return view('layouts.program_magang.detail_lowongan');
});
Route::get('/konfigurasi', function () {
    return view('konfigurasi.konfigurasi', ['active_menu' => 'konfigurasi']);
});

Route::get('/anggota/tim', function () {
    return view('company.anggota_tim.index');
});
Route::get('/kegiatan_saya/lamaran_saya', function () {
    return view('kegiatan_saya.lamaran_saya.index');
});

Route::get('/kegiatan_saya/lamaran_saya/status', function () {
    return view('kegiatan_saya.lamaran_saya.status_lamaran');
});
