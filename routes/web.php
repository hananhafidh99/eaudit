<?php

use App\Http\Controllers\AdminTL\FE\DashboardAminTLController;
use App\Http\Controllers\FE\DashboardTLController;
use App\Http\Controllers\FE\UserController as FEUserController;
// use App\Http\Controllers\ObrikTL\DashboardObrikTLController;
// use App\Http\Controllers\PemeriksaTL\DashboardPemeriksaTLController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('login');
});
// Route::get('/', [UserController::class, 'index']);
Route::post('login', [FEUserController::class, 'login']);
Route::get('/logout', [FEUserController::class, 'logout']);

Route::get('/adminTL', [DashboardAminTLController::class, 'index']);
Route::get('/adminTL/pkpt', [DashboardAminTLController::class, 'pkpt']);
Route::get('/adminTL/rekom', [DashboardAminTLController::class, 'rekom']);
Route::get('/adminTL/temuanrekom', [DashboardAminTLController::class, 'temurekom']);
Route::post('/adminTL/arsip/cari', [DashboardAminTLController::class, 'arsipCari']);

Route::get('adminTL/pkpt_tambah/{id}', [DashboardAminTLController::class, 'pkptcreate']);
Route::post('adminTL/pkpt_baru/{id}', [DashboardAminTLController::class, 'pkptstore']);
Route::get('adminTL/pkpt_edit/{id}/edit', [DashboardAminTLController::class, 'pkptedit']);
Route::put('adminTL/pkpt/{id}', [DashboardAminTLController::class, 'pkptupdate']);

Route::get('adminTL/rekom_edit/{id}/edit', [DashboardAminTLController::class, 'rekomEdit']);

Route::post('adminTL/rekom', [DashboardAminTLController::class, 'rekomStore']);

Route::post('adminTL/temuan', [DashboardAminTLController::class, 'temuanStore']);
Route::get('adminTL/temuan_rekom_edit/{id}/edit', [DashboardAminTLController::class, 'temuanrekomEdit']);

// Routes for rekomendasi CRUD
Route::post('adminTL/rekomendasi/update', [DashboardAminTLController::class, 'updateRekomendasi']);
Route::delete('adminTL/rekomendasi/{id}', [DashboardAminTLController::class, 'deleteRekomendasi']);

// Routes for temuan CRUD - Delete entire temuan with all recommendations
Route::delete('adminTL/temuan/{kode_temuan}/delete-all', [DashboardAminTLController::class, 'deleteTemuanWithAllRekomendasi']);

Route::post('adminTL/rekom/datadukung', [DashboardAminTLController::class, 'datadukungrekomStore']);
// Route::get('adminTL/rekom/datadukung/{id}/edit', [DashboardAminTLController::class, 'datadukungrekomEdit']);

Route::get('adminTL/temuan_rekom/{id}', [DashboardAminTLController::class, 'temuanrekomEdit']);

Route::get('/adminTL/datadukung/rekom', [DashboardAminTLController::class, 'indexdatadukungrekom']);
Route::get('adminTL/datadukung/rekom/{id}', [DashboardAminTLController::class, 'datadukungrekomEdit']);

// Route::get('/PemeriksaTL', [DashboardPemeriksaTLController::class, 'index']);
// Route::get('/Obrik', [DashboardObrikTLController::class, 'index']);
