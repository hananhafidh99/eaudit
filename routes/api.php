<?php

use App\Http\Controllers\Api\EselonController;
use App\Http\Controllers\Api\JabatanController;
use App\Http\Controllers\Api\JenisPengawasanController;
use App\Http\Controllers\Api\KegiatanController;
use App\Http\Controllers\Api\KelompokPenugasanController;
use App\Http\Controllers\Api\ObrikController;
use App\Http\Controllers\Api\PangkatController;
use App\Http\Controllers\Api\PegawaiController;
use App\Http\Controllers\Api\PeranController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SKPDController;
use App\Http\Controllers\Api\SuratController;
use App\Http\Controllers\Api\UserController;
use App\Models\KelompokPenugasan;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('/skpd', SKPDController::class);
Route::apiResource('k_penugasan', KelompokPenugasanController::class);
Route::apiResource('/penugasan', SuratController::class);
Route::apiResource('/eselon', EselonController::class);
Route::apiResource('/jabatan', JabatanController::class);

Route::apiResource('/jenisPengawasan', JenisPengawasanController::class);
Route::apiResource('/pangkat', PangkatController::class);
Route::apiResource('/pegawai', PegawaiController::class);
Route::apiResource('/peran', PeranController::class);
Route::apiResource('/obrik', ObrikController::class);

Route::apiResource('/user', UserController::class);

Route::post('login', [UserController::class, 'login']);
Route::apiResource('/kegiatan', KegiatanController::class);

Route::post('penugasan/store', [SuratController::class, 'storePenugasan']);
Route::put('penugasan_update', [SuratController::class, 'update']);

// update data SKPD
Route::post('/skpd/{id}', [SKPDController::class, 'update'])->name('skpd.update');

Route::get('/pegawai-edit/{id}', [PegawaiController::class, 'editPegawai']);
Route::get('/kegiatan-edit/{id}', [KegiatanController::class, 'editKegiatan']);

Route::get('/penugasan-edit/{id}', [SuratController::class, 'editPenugasan']);
Route::get('/penugasan-editbaru/{id}', [SuratController::class, 'editPenugasanbaru']);

Route::get('/penugasan-bukti/{id}', [SuratController::class, 'buktiPenugasan']);

Route::get('/penugasan-suratdinas/{id}', [SuratController::class, 'suratdinas']);

Route::get('/penugasan-berkas/{id}', [SuratController::class, 'editBerkas']);

Route::get('/penugasanArsip', [SuratController::class, 'arsip']);


Route::get('/dataPegawai', [PegawaiController::class, 'getData']);

Route::get('/dataobrik/search/{nama_obrik}', [ObrikController::class, 'search']);
Route::get('/dataobrik/search', [ObrikController::class, 'search2']);
Route::get('/datajenisPengawasan/search/{nama_jenispengawasan}', [JenisPengawasanController::class, 'search']);
Route::get('/datajenisPengawasan/search', [JenisPengawasanController::class, 'search2']);

Route::post('/dataobrikarsip/search', [SuratController::class, 'arsipobrik']);

Route::get('/penugasan-st/{id}', [SuratController::class, 'surattugas']);
