<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Fe\SKPDController;
use App\Http\Controllers\Fe\UserController;
use App\Http\Controllers\Fe\ObrikController;
use App\Http\Controllers\Fe\PeranController;
use App\Http\Controllers\Fe\SuratController;
use App\Http\Controllers\Fe\EselonController;
use App\Http\Controllers\Fe\JabatanController;
use App\Http\Controllers\Fe\PangkatController;
use App\Http\Controllers\Fe\PegawaiController;
use App\Http\Controllers\Fe\KegiatanController;
use App\Http\Controllers\Fe\JenisPengawasanController;
use App\Http\Controllers\Fe\KelompokPenugasanController;
use App\Http\Controllers\Fe\TabelKendaliController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/ps', function () {
    return Hash::make("admin");
});

Route::get('/', function () {
    return view('login');
});
Route::resource('skpd', SKPDController::class);

Route::post('/skpd_edit', [SKPDController::class, 'update']);

// Route::POST('/skpd/{id}', [SKPDController::class,'update'])->name('skpd.update');
Route::resource('pangkat', PangkatController::class);

Route::post('login', [UserController::class, 'login']);

// Route untuk adminTL - redirect ke dashboard admin
Route::get('adminTL', function () {
    return redirect('skpd');
});

// Route untuk level user lain
Route::get('PemeriksaTL', function () {
    return redirect('skpd');
});

Route::get('divisionHead', function () {
    return redirect('obrik');
});

// Route::resource('eselon' , EselonController::class);

Route::get('eselon', [EselonController::class, 'index']);
Route::get('eselon_baru', [EselonController::class, 'create']);
Route::post('eselon', [EselonController::class, 'store']);
Route::get('eselon/{id}/edit', [EselonController::class, 'edit']);
Route::put('eselon/{id}', [EselonController::class, 'update']);
Route::delete('eselon/{id}/hapus', [EselonController::class, 'destroy']);
Route::get('eselon/export/', [EselonController::class, 'export']);


Route::get('jabatan', [JabatanController::class, 'index']);
Route::get('jabatan_baru', [JabatanController::class, 'create']);
Route::post('jabatan', [JabatanController::class, 'store']);
Route::get('jabatan/{id}/edit', [JabatanController::class, 'edit']);
Route::put('jabatan/{id}', [JabatanController::class, 'update']);
Route::delete('jabatan/{id}/hapus', [JabatanController::class, 'destroy']);

Route::get('pangkat', [PangkatController::class, 'index']);
Route::get('pangkat_baru', [PangkatController::class, 'create']);
Route::post('pangkat', [PangkatController::class, 'store']);
Route::get('pangkat/{id}/edit', [PangkatController::class, 'edit']);
Route::put('pangkat/{id}', [PangkatController::class, 'update']);
Route::delete('pangkat/{id}/hapus', [PangkatController::class, 'destroy']);

Route::get('/jenisPengawasan/', [JenisPengawasanController::class, 'index']);
// Route::get('/jenisPengawasan_cari', [JenisPengawasanController::class, 'cari']);
Route::get('/jenisPengawasan_baru', [JenisPengawasanController::class, 'create']);
Route::post('/jenisPengawasan', [JenisPengawasanController::class, 'store']);
Route::get('jenisPengawasan/{id}/edit', [JenisPengawasanController::class, 'edit']);
Route::put('jenisPengawasan/{id}', [JenisPengawasanController::class, 'update']);
Route::delete('jenisPengawasan/{id}/hapus', [JenisPengawasanController::class, 'destroy']);
Route::get('jenisPengawasan/export/', [JenisPengawasanController::class, 'export']);

Route::get('/peran', [PeranController::class, 'index']);
// Route::get('/jenisPengawasan_cari', [JenisPengawasanController::class, 'cari']);
Route::get('/peran_baru', [PeranController::class, 'create']);
Route::post('/peran', [PeranController::class, 'store']);
Route::get('peran/{id}/edit', [PeranController::class, 'edit']);
Route::put('peran/{id}', [PeranController::class, 'update']);
Route::delete('peran/{id}/hapus', [PeranController::class, 'destroy']);

Route::get('/pegawai', [PegawaiController::class, 'index']);
Route::get('/pegawai_baru', [PegawaiController::class, 'create']);
Route::post('/pegawai_baru', [PegawaiController::class, 'store']);
Route::get('pegawai/{id}/edit', [PegawaiController::class, 'edit']);
Route::put('pegawai_baru/{id}', [PegawaiController::class, 'update']);
Route::delete('pegawai/{id}/hapus', [PegawaiController::class, 'destroy']);
Route::get('/logout', [UserController::class, 'logout']);

Route::get('/obrik', [ObrikController::class, 'index']);
Route::get('/obrik_baru', [ObrikController::class, 'create']);
Route::post('/obrik_baru', [ObrikController::class, 'store']);
Route::get('obrik/{id}/edit', [ObrikController::class, 'edit']);
Route::put('obrik/{id}', [ObrikController::class, 'update']);
Route::delete('obrik/{id}/hapus', [ObrikController::class, 'destroy']);


Route::get('search_obrik', [ObrikController::class, 'SearchObrik']);

// // Route::get('/jenisPengawasan_cari', [JenisPengawasanController::class, 'cari']);
// Route::get('/jenisPengawasan_baru', [JenisPengawasanController::class, 'create']);
// Route::post('/jenisPengawasan', [JenisPengawasanController::class, 'store']);
// Route::get('jenisPengawasan/{id}/edit', [JenisPengawasanController::class, 'edit']);
// Route::put('jenisPengawasan/{id}', [JenisPengawasanController::class, 'update']);
// Route::delete('jenisPengawasan/{id}/hapus', [JenisPengawasanController::class, 'destroy']);

Route::get('/perjalanan_DalamKota', [SuratController::class, 'index']);
Route::post('/perjalananDalam', [SuratController::class, 'store']);
Route::get('/perjalananDalam_create', [SuratController::class, 'CreateperjalananDalam']);
Route::get('perjalananDalam/{id}/edit', [SuratController::class, 'edit'])->name('surat.edit');
Route::put('perjalananDalam/{id}', [SuratController::class, 'update'])->name('perjalanan/edit');
Route::delete('perjalananDalam/{id}/hapus', [SuratController::class, 'hapus']);

Route::post('/ubahtahun', [UserController::class, 'ubahtahun']);

Route::get('/kegiatan', [KegiatanController::class, 'index']);
Route::get('/kegiatan_baru', [KegiatanController::class, 'create']);
Route::post('/kegiatan_baru', [KegiatanController::class, 'store']);
Route::get('kegiatan/{id}/edit', [KegiatanController::class, 'edit']);
Route::put('kegiatan/{id}', [KegiatanController::class, 'update']);
Route::delete('obrik/{id}/hapus', [ObrikController::class, 'destroy']);

Route::get('/surat_dalamKota', [SuratController::class, 'index']);
Route::post('/perjalananDalam_kota', [SuratController::class, 'store']);
Route::get('/surat_dalamKota_create', [SuratController::class, 'create']);
Route::get('surat_dalamKota/{id}/edit', [SuratController::class, 'edit'])->name('surat.edit');
Route::post('surat_dalamKota/{id}', [SuratController::class, 'update'])->name('perjalanan/edit');
// Route::delete('perjalananDalam/{id}/hapus', [SuratController::class, 'hapus']);

Route::get('surat_dalamKota/ST/{id}', [SuratController::class, 'suratTugas']);
Route::get('surat_dalamKota/suratDinas/{id}', [SuratController::class, 'suratDinas']);
Route::get('surat_dalamKota/sppd/{id}', [SuratController::class, 'sppd']);

Route::get('surat_dalamKota/buktipenerimaan/{id}', [SuratController::class, 'buktipenerimaan']);
Route::get('surat_dalamKota/SD/{id}', [SuratController::class, 'suratdinas']);

Route::get('/arsip', [SuratController::class, 'Arsip'])->name('arsip');
Route::post('/arsip/cari', [SuratController::class, 'arsipCari']);
Route::get('users/export/', [UserController::class, 'export']);

Route::get('pegawai/export/', [PegawaiController::class, 'export']);

Route::get('k_penugasan', [KelompokPenugasanController::class, 'index']);
Route::get('k_penugasan_baru', [KelompokPenugasanController::class, 'create']);
Route::post('k_penugasan', [KelompokPenugasanController::class, 'store']);
Route::get('k_penugasan/{id}/edit', [KelompokPenugasanController::class, 'edit']);
Route::put('k_penugasan/{id}', [KelompokPenugasanController::class, 'update']);
Route::delete('k_penugasan/{id}/hapus', [KelompokPenugasanController::class, 'destroy']);

Route::get('tabel_kendali', [TabelKendaliController::class, 'index']);
Route::get('/tabelkendali_baru', [TabelKendaliController::class, 'create']);
Route::post('/tabelkendali_baru', [TabelKendaliController::class, 'store']);
Route::delete('tabel_kendali/{id}/hapus', [TabelKendaliController::class, 'destroy']);
