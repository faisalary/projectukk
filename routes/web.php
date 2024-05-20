<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\JadwalSeleksiController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdiController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\RoleMiddleware as MiddlewareRoleMiddleware;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth'])->name('dashboard.user');
//admin
Route::get('/dashboard-admin/{id}', [App\Http\Controllers\DashboardMitraController::class, 'index'])->middleware(['auth'])->name('dashboard.admin');
//super admin
Route::get('/super-admin', [App\Http\Controllers\SuperAdminController::class, 'index'])->middleware(['auth'])->name('dashboard.superadmin');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');


Route::prefix('company')->group(function () {
    Route::get('/register', [App\Http\Controllers\Auth\RegisterMitraController::class, 'showRegistrationForm'])->name('register.form');
    Route::post('/register', [App\Http\Controllers\Auth\RegisterMitraController::class, 'store'])->name('register.store');
    Route::get('/set-password/{token}', [App\Http\Controllers\Auth\SetPasswordController::class, 'index'])->name('set.password');
    Route::post('/set-password', [App\Http\Controllers\Auth\SetPasswordController::class, 'update'])->name('update.password');
});
Route::prefix('mahasiswa')->group(function () {
    Route::get('/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'index'])->name('register.form');
    Route::post('/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'store'])->name('register.store');
    Route::get('/set-password/{token}', [App\Http\Controllers\Auth\SetPasswordController::class, 'setting'])->name('set.password');
    Route::post('/set-password', [App\Http\Controllers\Auth\SetPasswordController::class, 'updateset'])->name('update.password');
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
            Route::post('/import', [App\Http\Controllers\DosenController::class, 'import'])->name('dosen.import');
        });
        Route::prefix('komponen-penilaian')->group(function () {
            Route::get('/', [App\Http\Controllers\KomponenPenilaianController::class, 'index'])->name('komponen-penilaian.index');
            Route::get('/show/{scored_by}', [App\Http\Controllers\KomponenPenilaianController::class, 'show'])->name('komponen-penilaian.show');
            Route::post('/store', [App\Http\Controllers\KomponenPenilaianController::class, 'store'])->name('komponen-penilaian.store');
            Route::post('/update/{id}', [App\Http\Controllers\KomponenPenilaianController::class, 'update'])->name('komponen-penilaian.update');
            Route::get('/edit/{id}', [App\Http\Controllers\KomponenPenilaianController::class, 'edit'])->name('komponen-penilaian.edit');
            Route::post('/status/{id}', [App\Http\Controllers\KomponenPenilaianController::class, 'status'])->name('komponen-penilaian.status');
            Route::get('/list-fakultas/{id_univ}', [App\Http\Controllers\KomponenPenilaianController::class, 'list_fakultas'])->name('komponen-penilaian.list_fakultas');
        });
        Route::get('pembimbing-mandiri', function () {
            return view('masters.pembimbing_lapangan_mandiri.index');
        });

        Route::prefix('laporan-akhir')->group(function () {
            Route::get('/', [App\Http\Controllers\LaporanAkhirController::class, 'index'])->name('laporan-akhir.index');
            Route::get('/show', [App\Http\Controllers\LaporanAkhirController::class, 'show'])->name('laporan-akhir.show');
            Route::post('/store', [App\Http\Controllers\LaporanAkhirController::class, 'store'])->name('laporan-akhir.store');
            Route::post('/update/{id}', [App\Http\Controllers\LaporanAkhirController::class, 'update'])->name('laporan-akhir.update');
            Route::get('/edit/{id}', [App\Http\Controllers\LaporanAkhirController::class, 'edit'])->name('laporan-akhir.edit');
            Route::post('status/{id}', [App\Http\Controllers\LaporanAkhirController::class, 'status'])->name('laporan-akhir.status');
        });
    });

    Route::prefix('konfigurasi')->middleware('can:slidebar.lkm')->group(function () {
        Route::get('/', [App\Http\Controllers\KonfigurasiController::class, 'index'])->name('konfigurasi.index');
        Route::get('/show', [App\Http\Controllers\KonfigurasiController::class, 'show'])->name('konfigurasi.show');
        Route::post('/store', [App\Http\Controllers\KonfigurasiController::class, 'store'])->name('konfigurasi.store');
        Route::post('/update{id}', [App\Http\Controllers\KonfigurasiController::class, 'update'])->name('konfigurasi.update');
        Route::get('/edit{id}', [App\Http\Controllers\KonfigurasiController::class, 'edit'])->name('konfigurasi.edit');
        Route::post('/status/{id}', [App\Http\Controllers\KonfigurasiController::class, 'status'])->name('konfigurasi.status');
    });
    //kelola-mitra
    Route::prefix('company')->group(function () {
        Route::prefix('kelola-mitra')->middleware('can:only.lkm')->group(function () {
            Route::get('/', [App\Http\Controllers\KelolaMitraController::class, 'index'])->name('kelola_mitra.index');
            Route::get('/show/{statusapprove}', [App\Http\Controllers\KelolaMitraController::class, 'show'])->name('kelola_mitra.show');
            Route::post('/store', [App\Http\Controllers\KelolaMitraController::class, 'store'])->name('kelola_mitra.store');
            Route::get('/edit/{id}', [App\Http\Controllers\KelolaMitraController::class, 'edit'])->name('kelola_mitra.edit');
            Route::post('/update/{id}', [App\Http\Controllers\KelolaMitraController::class, 'update'])->name('kelola_mitra.update');
            Route::post('/status/{id}', [App\Http\Controllers\KelolaMitraController::class, 'status'])->name('kelola_mitra.status');
            Route::post('/approved/{id}', [App\Http\Controllers\KelolaMitraController::class, 'approved'])->name('kelola_mitra.approved');
            Route::post('/rejected/{id}', [App\Http\Controllers\KelolaMitraController::class, 'rejected'])->name('kelola_mitra.rejected');
        });
        Route::prefix('profile-company')->middleware('can:only.mitra')->group(function () {
            Route::get('/', [App\Http\Controllers\ProfileCompanyController::class, 'index'])->name('profile_company.index');
            Route::put('/{id}', [App\Http\Controllers\KelolaMitraController::class, 'update'])->name('kelola_mitra.update');
            Route::get('/edit/{id}', [App\Http\Controllers\KelolaMitraController::class, 'edit'])->name('kelola_mitra.edit');
        });
        Route::prefix('summary-profile')->middleware('can:only.mitra')->group(function () {
            Route::get('/', [App\Http\Controllers\SummaryProfileController::class, 'index'])->name('summary_profile.index');
            Route::put('/{id}', [App\Http\Controllers\KelolaMitraController::class, 'update'])->name('kelola_mitra.update');
            Route::get('/edit/{id}', [App\Http\Controllers\KelolaMitraController::class, 'edit'])->name('kelola_mitra.edit');
        });

        Route::prefix('master-email')->middleware('can:only.mitra')->group(function () {
            Route::get('/', [App\Http\Controllers\MasterEmailController::class, 'index'])->name('master_email.index');
            Route::get('/show', [App\Http\Controllers\MasterEmailController::class, 'show'])->name('master_email.show');
            Route::post('/store', [App\Http\Controllers\MasterEmailController::class, 'store'])->name('master_email.store');
            Route::post('/update/{id}', [App\Http\Controllers\MasterEmailController::class, 'update'])->name('master_email.update');
            Route::get('/edit/{id}', [App\Http\Controllers\MasterEmailController::class, 'edit'])->name('master_email.edit');
            Route::post('/status/{id}', [App\Http\Controllers\MasterEmailController::class, 'status'])->name('master_email.status');
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

    Route::prefix('informasi')->middleware([RoleMiddleware::class])->group(function () {
        Route::prefix('/lowongan')->group(function () {
            Route::get('/{id_industri}', [App\Http\Controllers\InformasiLowonganController::class, 'index'])->name('lowongan.index');
            Route::get('/show', [App\Http\Controllers\InformasiLowonganController::class, 'show'])->name('lowongan.show');
            Route::post('/store', [App\Http\Controllers\InformasiLowonganController::class, 'store'])->name('lowongan.store');
            Route::post('/status/{id}', [App\Http\Controllers\InformasiLowonganController::class, 'status'])->name('lowongan.status');
            Route::get('/add/{id}', [App\Http\Controllers\InformasiLowonganController::class, 'add'])->name('lowongan.add');
            Route::post('/date/{id}', [App\Http\Controllers\InformasiLowonganController::class, 'date'])->name('lowongan.date');
        });

        Route::prefix('mitra')->middleware('can:only.lkm')->group(function () {
            Route::get('/', [App\Http\Controllers\InformasiMitraController::class, 'index'])->name('mitra.index');
            Route::get('/show', [App\Http\Controllers\InformasiMitraController::class, 'show'])->name('mitra.show');
            Route::post('/store', [App\Http\Controllers\InformasiMitraController::class, 'store'])->name('mitra.store');
            Route::post('/status/{id}', [App\Http\Controllers\InformasiMitraController::class, 'status'])->name('mitra.status');
            Route::post('/update/{id}', [App\Http\Controllers\InformasiMitraController::class, 'update'])->name('mitra.update');
            Route::get('/edit/{id}', [App\Http\Controllers\InformasiMitraController::class, 'edit'])->name('mitra.edit');
        });
        Route::prefix('kandidat/')->group(function () {
            Route::get('/{id_lowongan}', [App\Http\Controllers\InformasiKandidatController::class, 'index'])->name('kandidat.index');
            Route::get('/detail/{id_pendaftaran}', [App\Http\Controllers\InformasiKandidatController::class, 'detail'])->name('kandidat.detail');
            Route::get('/show/{id}', [App\Http\Controllers\InformasiKandidatController::class, 'show'])->name('kandidat.show');
            Route::post('/store', [App\Http\Controllers\InformasiKandidatController::class, 'store'])->name('kandidat.store');
            Route::post('/status', [App\Http\Controllers\InformasiKandidatController::class, 'status'])->name('kandidat.status');
            Route::post('/update/{id}', [App\Http\Controllers\InformasiKandidatController::class, 'update'])->name('kandidat.update');
            Route::get('/edit/{id}', [App\Http\Controllers\InformasiKandidatController::class, 'edit'])->name('kandidat.edit');
        });
    });

    Route::prefix('kelola')->group(function () {
        Route::prefix('lowongan/mitra')->group(function () {
            Route::get('/{id}', [App\Http\Controllers\LowonganMagangController::class, 'index'])->name('lowongan-magang.index.mitra');
            Route::post('/show', [App\Http\Controllers\LowonganMagangController::class, 'show'])->name('lowongan-magang.show.mitra');
            Route::get('/create/{id}', [App\Http\Controllers\LowonganMagangController::class, 'create'])->name('lowongan-magang.create');
            Route::post('/store', [App\Http\Controllers\LowonganMagangController::class, 'store'])->name('lowongan-magang.store');
            Route::get('/detail/{id}', [App\Http\Controllers\LowonganMagangController::class, 'detail'])->name('lowongan-magang.detail');
            Route::get('/edit/{id}', [App\Http\Controllers\LowonganMagangController::class, 'edit'])->name('lowongan-magang.edit');
            Route::post('/update/{id}', [App\Http\Controllers\LowonganMagangController::class, 'update'])->name('lowongan-magang.edit');
        });
        Route::prefix('lowongan/lkm')->group(function () {
            Route::get('/', [App\Http\Controllers\LowonganMagangLkmController::class, 'index'])->name('lowongan-magang.index.lkm');
            Route::get('/show', [App\Http\Controllers\LowonganMagangLkmController::class, 'show'])->name('lowongan-magang.show.lkm');
            Route::get('/detail/{id}', [App\Http\Controllers\LowonganMagangLkmController::class, 'detail'])->name('lowongan-magang.detail');
            Route::get('/edit/{id}', [App\Http\Controllers\LowonganMagangLkmController::class, 'edit'])->name('lowongan-magang.edit');
            Route::put('/update/{id}', [App\Http\Controllers\LowonganMagangLkmController::class, 'update'])->name('lowongan-magang.update');
            Route::post('/approved/{id}', [App\Http\Controllers\LowonganMagangLkmController::class, 'approved'])->name('lowongan-magang.approved');
            Route::post('/rejected/{id}', [App\Http\Controllers\LowonganMagangLkmController::class, 'rejected'])->name('lowongan-magang.rejected');
        });
    });

    Route::prefix('mahasiswa')->group(function () {
        Route::prefix('profile/pribadi')->group(function () {
            Route::get('/{id}', [App\Http\Controllers\ProfileMahasiswaController::class, 'index'])->name('profile.mahasiswa.index');
            Route::get('/edit/{id}', [App\Http\Controllers\ProfileMahasiswaController::class, 'edit'])->name('profile.mahasiswa.edit');
            Route::post('/update/{id}', [App\Http\Controllers\ProfileMahasiswaController::class, 'update'])->name('profile.mahasiswa.update');
        });
        Route::prefix('profile/update')->group(function () {
            Route::get('/update', [App\Http\Controllers\ProfileMahasiswaController::class, 'update'])->name('profile.mahasiswa.update');
        });

        Route::prefix('profile/informasi-tambahan')->group(function () {
            Route::get('/{id}', [App\Http\Controllers\ProfileMahasiswaController::class, 'index'])->name('profile.infromasi.mahasiswa.index');
            Route::post('/update/{id}', [App\Http\Controllers\ProfileMahasiswaController::class, 'updateinformasitambahan'])->name('profile.infromasi.mahasiswa.update');
            // Route::get('/edit/{id}', [App\Http\Controllers\ProfileMahasiswaController::class,'editinformasi'])->name('profile.infromasi.mahasiswa.edit');
        });
        Route::prefix('profile/pendidikan')->group(function () {
            Route::get('/{id}', [App\Http\Controllers\ProfileMahasiswaController::class, 'index'])->name('profile.pendidikan.mahasiswa.index');
            Route::post('/update/{id}', [App\Http\Controllers\ProfileMahasiswaController::class, 'updatependidikan'])->name('profile.pendidikan.mahasiswa.update');
        });
        Route::prefix('profile/skill')->group(function () {
            Route::get('/{id}', [App\Http\Controllers\ProfileMahasiswaController::class, 'index'])->name('profile.skill.mahasiswa.index');
            Route::get('/edit/{id}', [App\Http\Controllers\ProfileMahasiswaController::class, 'editskill'])->name('profile.skill.mahasiswa.edit');
            Route::post('/update/{id}', [App\Http\Controllers\ProfileMahasiswaController::class, 'updateskill'])->name('profile.skill.mahasiswa.update');
        });
        Route::prefix('profile/pengalaman')->group(function () {
            Route::get('/{id}', [App\Http\Controllers\ProfileMahasiswaController::class, 'index'])->name('profile.pengalaman.mahasiswa.index');
            Route::post('/store/{id}', [App\Http\Controllers\ProfileMahasiswaController::class, 'store'])->name('profile.pengalaman.mahasiswa.store');
            Route::get('/edit/{id}', [App\Http\Controllers\ProfileMahasiswaController::class, 'editpengalaman'])->name('profile.pengalaman.mahasiswa.edit');
            Route::post('/update/{id}', [App\Http\Controllers\ProfileMahasiswaController::class, 'updatepengalaman'])->name('profile.pengalaman.mahasiswa.update');
            Route::delete('/delete/{id}', [App\Http\Controllers\ProfileMahasiswaController::class, 'deletepengalaman'])->name('profile.pengalaman.mahasiswa.delete');
            Route::get('/detail/{id}', [App\Http\Controllers\ProfileMahasiswaController::class, 'detailpengalaman'])->name('profile.pengalaman.mahasiswa.delete');
        });
        Route::prefix('profile/dokumen-pendukung')->group(function () {
            Route::get('/{id}', [App\Http\Controllers\ProfileMahasiswaController::class, 'index'])->name('profile.dokumen.mahasiswa.index');
            Route::post('/store/{id}', [App\Http\Controllers\ProfileMahasiswaController::class, 'storedokumen'])->name('profile.dokumen.mahasiswa.store');
            Route::get('/edit/{id}', [App\Http\Controllers\ProfileMahasiswaController::class, 'editdokumen1'])->name('profile.dokumen.mahasiswa.edit');
            Route::post('/update/{id}', [App\Http\Controllers\ProfileMahasiswaController::class, 'updatedokumen'])->name('profile.dokumen.mahasiswa.update');
            Route::get('/detail/{id}', [App\Http\Controllers\ProfileMahasiswaController::class, 'detail'])->name('profile.dokumen.mahasiswa.detail');
            Route::delete('/delete/{id}', [App\Http\Controllers\ProfileMahasiswaController::class, 'deletedok'])->name('profile.dokumen.mahasiswa.delete');
        });
    });

    Route::prefix('jadwal-seleksi')->middleware([RoleMiddleware::class])->group(function () {

        Route::prefix('/lowongan')->group(function () {
            Route::get('/{id_industri}', [App\Http\Controllers\LowonganJadwalController::class, 'index'])->name('jadwal.index');
        });
        Route::prefix('/mitra')->middleware('can:only.lkm')->group(function () {
            Route::get('/', [App\Http\Controllers\MitraJadwalController::class, 'index'])->name('mitrajadwal.index');
            Route::get('/show', [App\Http\Controllers\MitraJadwalController::class, 'show'])->name('mitrajadwal.show');
        });
        Route::prefix('/lanjutan')->group(function () {
            Route::get('/{id_lowongan}', [App\Http\Controllers\JadwalSeleksiController::class, 'index'])->name('seleksi.index');
            Route::get('/show/{id}', [App\Http\Controllers\JadwalSeleksiController::class, 'show'])->name('seleksi.show');
            Route::post('/store', [App\Http\Controllers\JadwalSeleksiController::class, 'store'])->name('seleksi.store');
            Route::get('/detail/{id}', [App\Http\Controllers\JadwalSeleksiController::class, 'detail'])->name('seleksi.detail');
            Route::post('/update/{id}', [App\Http\Controllers\JadwalSeleksiController::class, 'update'])->name('seleksi.update');
            Route::get('/kirim-email', [MailController::class, 'index'])->name('seleksi.email');
        });
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

    Route::prefix('mandiri')->group(function () {
        Route::prefix('approve-mandiri')->middleware('can:only.lkm')->group(function () {
            Route::get('/', [App\Http\Controllers\ApproveMandiriController::class, 'index'])->name('approve_mandiri.index');
            Route::get('/show/{statusapprove}', [App\Http\Controllers\ApproveMandiriController::class, 'show'])->name('approve_mandiri.show');
            Route::post('/approved/{id}', [App\Http\Controllers\ApproveMandiriController::class, 'approved'])->name('approve_mandiri.approved');
            Route::post('/rejected/{id}', [App\Http\Controllers\ApproveMandiriController::class, 'rejected'])->name('approve_mandiri.rejected');
        });
    });

    Route::prefix('/pengajuan/surat')->group(function () {
        Route::get('/', [App\Http\Controllers\KonfirmasiMandiriController::class, 'index'])->name('mandiri.index');
        Route::post('/show', [App\Http\Controllers\KonfirmasiMandiriController::class, 'show'])->name('mandiri.show');
        Route::post('/store', [App\Http\Controllers\KonfirmasiMandiriController::class, 'store'])->name('mandiri.store');
        Route::get('/detail/{id}', [App\Http\Controllers\KonfirmasiMandiriController::class, 'detail'])->name('mandiri.detail');
        Route::post('/update/{id}', [App\Http\Controllers\KonfirmasiMandiriController::class, 'update'])->name('mandiri.update');
        Route::get('/edit/{id}', [App\Http\Controllers\KonfirmasiMandiriController::class, 'edit'])->name('mandiri.edit');
        Route::post('/status/{id}', [App\Http\Controllers\KonfirmasiMandiriController::class, 'status'])->name('mandiri.status');
    });

    Route::prefix('/data-mahasiswa-magang')->group(function () {
        Route::get('/', [App\Http\Controllers\DataMahasiswaMagangController::class, 'index'])->name('data-magang.index');
        Route::get('/show', [App\Http\Controllers\DataMahasiswaMagangController::class, 'show'])->name('data-magang.show');
        Route::post('/store', [App\Http\Controllers\DataMahasiswaMagangController::class, 'store'])->name('data-magang.store');
        Route::post('/update{id}', [App\Http\Controllers\DataMahasiswaMagangController::class, 'update'])->name('data-magang.update');
        Route::get('/edit{id}', [App\Http\Controllers\DataMahasiswaMagangController::class, 'edit'])->name('data-magang.edit');
        Route::post('/status/{id}', [App\Http\Controllers\DataMahasiswaMagangController::class, 'status'])->name('data-magang.status');
        Route::get('/doc/{file}', [App\Http\Controllers\DataMahasiswaMagangController::class, 'doc'])->name('data-magang.doc');
    });

    Route::prefix('/apply-lowongan')->group(function () {
        Route::get('/', [App\Http\Controllers\ApplyLowonganFakultasController::class, 'index'])->name('lowongan.user.index');
        Route::get('/detail/{id}', [App\Http\Controllers\ApplyLowonganFakultasController::class, 'show'])->name('lowongan.detail.index');
        Route::get('/lamar/{id}', [App\Http\Controllers\ApplyLowonganFakultasController::class, 'lamar'])->name('detail.lamar');
        Route::get('/persentase/{id}', [App\Http\Controllers\ApplyLowonganFakultasController::class, 'persentase'])->name('persentase.index');
        Route::post('/apply/{id}', [App\Http\Controllers\ApplyLowonganFakultasController::class, 'apply'])->name('apply.store');
    });

    // Route::prefix('/apply')->group(function () {
    //     Route::get('/', [App\Http\Controllers\DetailLowonganController::class, 'index'])->name('detail-lowongan.index');
    // });
});

Route::get('/pengaturan', function () {
    return view('pengaturan_akun.pengaturan');
});

Route::get('/magang_fakultas', function () {
    return view('program_magang.magang');
});

Route::get('/informasi/magang', function () {
    return view('program_magang.informasi_magang');
});

Route::get('/lowongan-magang-tersimpan', function () {
    return view('program_magang.lowongan_magang_tersimpan');
});

Route::get('/lowongan-pekerjaan-tersimpan', function () {
    return view('program_magang.lowongan_pekerjaan_tersimpan');
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



Route::get('/detail/lowongan/magang', function () {
    return view('program_magang.detail_lowongan');
});
Route::get('/anggota/tim', function () {
    return view('company.anggota_tim.index');
});

Route::get('/detail/lowongan/magang', function () {
    return view('program_magang.detail_lowongan');
});
Route::get('/konfigurasi', function () {
    return view('konfigurasi.konfigurasi', ['active_menu' => 'konfigurasi']);
});

Route::get('/kegiatan_saya/lamaran_saya/status', function () {
    return view('kegiatan_saya.lamaran_saya.status_lamaran');
});
Route::get('/detail_perusahaan', function () {
    return view('landingpage.detail_perusahaan');
});

Route::get('/detail_perusahaan', function () {
    return view('perusahaan.detail_perusahaan');
});
Route::get('/daftar_perusahaan', function () {
    return view('perusahaan.daftar_perusahaan');
});
Route::get('/lowongan/magang', function () {
    return view('perusahaan.lowongan');
});

Route::get('/pratinjau/diri', function () {
    return view('apply.pratinjau');
});

Route::get('/logbook', function () {
    return view('logbook.logbook', ['active_menu' => 'logbook']);
});

Route::get('/logbook-detail', function () {
    return view('logbook.logbook_detail', ['active_menu' => 'logbook']);
});

Route::get('/cv', function () {
    return view('mahasiswa.cv', ['active_menu' => 'CV Mahasiswa']);
});



Route::get('/logbook/mahasiswa', function () {
    return view('company.logbook_mahasiswa.logbook');
});

Route::get('/logbook/detail', function () {
    return view('company.logbook_mahasiswa.detail_logbook');
});

Route::get('/kelola-pengguna', function () {
    return view('admin.kelola-pengguna.index');
});

Route::get('/aboutus/talentern', function () {
    return view('landingpage.about_us_talentern');
});

Route::get('/aboutus/techno', function () {
    return view('landingpage.about_us_techno');
});

Route::get('/aboutus/lkmfit', function () {
    return view('landingpage.about_us_lkm');
});

Route::get('/nilai/magang', function () {
    return view('kegiatan_saya.nilai_magang.nilai');
});

Route::get('/pengajuan/magang', function () {
    return view('pengajuan_magang.mandiri.tambah');
});

Route::get('/kelola/mahasiswa', function () {
    return view('kelola_mahasiswa.index');
});

Route::prefix('/input/nilai/akademik')->group(function () {
    Route::get('/', [App\Http\Controllers\InputNilaiAkademikController::class, 'index'])->name('kelola_mahasiswa_akademik.index');
    Route::get('/show/{scored_by}', [App\Http\Controllers\KomponenPenilaianController::class, 'show'])->name('komponen-penilaian.show');
    Route::post('/store', [App\Http\Controllers\InputNilaiAkademikController::class, 'store'])->name('kelola_mahasiswa_akademik.store');
    Route::post('/update{id}', [App\Http\Controllers\InputNilaiAkademikController::class, 'update'])->name('kelola_mahasiswa_akademik.update');
    Route::get('/edit{id}', [App\Http\Controllers\InputNilaiAkademikController::class, 'edit'])->name('kelola_mahasiswa_akademik.edit');
    Route::post('/status/{id}', [App\Http\Controllers\InputNilaiAkademikController::class, 'status'])->name('kelola_mahasiswa_akademik.status');
});

Route::get('/view/logbook', function () {
    return view('kelola_mahasiswa.kelola_mahasiswa_akademik.view_logbook');
});

Route::get('/kelola/mahasiswa/magang', function () {
    return view('kelola_mahasiswa.kelola_mahasiswa_lapangan.index');
});

Route::get('/kelola/mahasiswa-magang/input', function () {
    return view('kelola_mahasiswa.kelola_mahasiswa_lapangan.modal');
});

Route::get('/logbook/mahasiswa', function () {
    return view('kelola_mahasiswa.kelola_mahasiswa_lapangan.logbook');
});

Route::get('/verifikasi/akun', function () {
    return view('partials_auth.verifikasi_akun');
});

Route::get('/status/magang', function () {
    return view('kegiatan_saya.status_magang.index');
});

Route::get('/berkas/akhir', function () {
    return view('kegiatan_saya.berkas_akhir.index');
});

Route::get('/logbook-mahasiswa/magang-fakultas', function () {
    return view('logbook_mahasiswa.magang_fakultas.index');
});

Route::get('/detail-logbook-mahasiswa/magang-fakultas', function () {
    return view('logbook_mahasiswa.magang_fakultas.detail_logbook');
});

Route::get('/view-logbook-mahasiswa/magang-fakultas', function () {
    return view('logbook_mahasiswa.magang_fakultas.view_logbook');
});

Route::get('/logbook-mahasiswa/magang-mandiri', function () {
    return view('logbook_mahasiswa.magang_mandiri.index');
});

Route::get('/detail-logbook-mahasiswa/magang-mandiri', function () {
    return view('logbook_mahasiswa.magang_mandiri.detail_logbook');
});

Route::get('/view-logbook-mahasiswa/magang-mandiri', function () {
    return view('logbook_mahasiswa.magang_mandiri.view_logbook');
});

Route::get('/nilai-mahasiswa/magang-fakultas', function () {
    return view('nilai_mahasiswa.magang_fakultas.index');
});

Route::get('/detail-nilai-mahasiswa/magang-fakultas', function () {
    return view('nilai_mahasiswa.magang_fakultas.nilai');
});

Route::get('/nilai-mahasiswa/magang-mandiri', function () {
    return view('nilai_mahasiswa.magang_mandiri.index');
});

Route::get('/detail-nilai-mahasiswa/magang-mandiri', function () {
    return view('nilai_mahasiswa.magang_mandiri.nilai');
});

Route::get('/dashboard/admin', function () {
    return view('dashboard.admin.index');
});

Route::get('/dashboard/company', function () {
    return view('dashboard.company.index');
});

Route::get('/tambah/jenis-magang', function () {
    return view('masters.jenis_magang.modal');
});


// Route::get('kirim-email', 'App\Http\Controllers\MailController@index');

Route::post('submit-contact', [ContactController::class, 'store'])->name('submit-contact');

Route::get('/test', function () {
    return view('auth.message-verify-email');
});