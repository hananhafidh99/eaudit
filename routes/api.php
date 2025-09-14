<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\AdminTL\API\DashboardAminTLController;
use App\Http\Controllers\AdminTL\Api\RekomTLController;
use App\Http\Controllers\AdminTL\Api\TemuanTLController;

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
Route::apiResource('/user', UserController::class);
Route::post('login', [UserController::class, 'login']);
Route::POST('/dataobrikarsip/search', [DashboardAminTLController::class, 'arsipobrik']);
Route::get('/penugasanArsip', [DashboardAminTLController::class, 'arsip']);
Route::get('/penugasan-edit/{id}', [DashboardAminTLController::class, 'editPenugasan']);
Route::get('/pengawasan-edit/{id}', [DashboardAminTLController::class, 'editPengawasan']);

Route::apiResource('/pengawasan', DashboardAminTLController::class);
Route::apiResource('/rekom', RekomTLController::class);
Route::apiResource('/temuan', TemuanTLController::class);

Route::post('rekom/store', [DashboardAminTLController::class, 'rekom']);

