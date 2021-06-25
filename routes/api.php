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
Route::get('me', [UserController::class,'me']);
Route::get('all', [UserController::class,'all']);
Route::post('delete', [UserController::class,'delete']);
Route::post('update', [UserController::class,'update']);

Route::middleware('jwt.verify')->group(function () {
    Route::prefix('kelas')->group(function () {
        Route::post('add', [KelasController::class,'add']);
        Route::get('all', [KelasController::class,'all']);
        Route::post('update', [KelasController::class,'update']);
        Route::post('delete', [KelasController::class,'delete']);
    });

    Route::prefix('pelajaran')->group(function () {
        Route::post('add', [PelajaranController::class,'add']);
        Route::get('all', [PelajaranController::class,'all']);
        Route::post('update', [PelajaranController::class,'update']);
        Route::post('delete', [PelajaranController::class,'delete']);
    });

    Route::prefix('manage')->group(function () {
        Route::post('add', [ManageKelasController::class,'add']);
        Route::get('all', [ManageKelasController::class,'all']);
        Route::post('update', [ManageKelasController::class,'update']);
        Route::post('delete', [ManageKelasController::class,'delete']);
        Route::post('detail', [ManageKelasController::class,'detail']);
    });
});