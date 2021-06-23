<?php

use App\Http\Controllers\KelasController;
use App\Http\Controllers\ManageKelasController;
use App\Http\Controllers\PelajaranController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('jwt.verify')->get('/', function (Request $request) {
    return $request->user();
});

Route::post('register', [UserController::class,'register']);
Route::post('login', [UserController::class,'login']);
Route::get('show', [UserController::class,'show']);
Route::get('userall', [UserController::class,'userall']);

Route::middleware('jwt.verify')->group(function () {
    Route::prefix('kelas')->group(function () {
        Route::post('add', [KelasController::class,'Add']);
        Route::get('show', [KelasController::class,'ShowAll']);
        Route::post('update', [KelasController::class,'Update']);
    });

    Route::prefix('pelajaran')->group(function () {
        Route::post('add', [PelajaranController::class,'Add']);
        Route::post('update', [PelajaranController::class,'Update']);
        Route::get('show', [PelajaranController::class,'ShowAll']);
    });

    Route::prefix('manage')->group(function () {
        Route::post('add', [ManageKelasController::class,'Add']);
        Route::get('show', [ManageKelasController::class,'ShowAll']);
        Route::post('update', [ManageKelasController::class,'Update']);
        Route::post('delete', [ManageKelasController::class,'delete']);
    });
});