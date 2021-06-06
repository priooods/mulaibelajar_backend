<?php

use App\Http\Controllers\KelasController;
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
    Route::post('kelas/new', [KelasController::class,'addclass']);
    Route::get('kelas/show', [KelasController::class,'showkelas']);

    Route::post('content/new', [KelasController::class,'addContent']);

    Route::post('daftar/new', [UserController::class,'daftarclass']);
});