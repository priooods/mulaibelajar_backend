<?php

use App\Http\Controllers\AfiliateController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\IntensifController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\ManageKelasController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PaketPelajaranController;
use App\Http\Controllers\PelajaranController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\SilabusController;
use App\Http\Controllers\SubpelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;
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
Route::middleware('jwt.verify')->group(function () {
    Route::get('me', [UserController::class,'me']);
    Route::get('logout', [UserController::class,'logout']);
    Route::get('all', [UserController::class,'all']);
    Route::post('delete', [UserController::class,'delete']);
    Route::post('update', [UserController::class,'update']);
    
});
Route::post('register', [UserController::class,'register']);
Route::post('login', [UserController::class,'login']);
Route::prefix('pelajaran')->group(function () {
    Route::post('add', [PelajaranController::class,'add']);
    Route::get('all', [PelajaranController::class,'all']);
    Route::post('find', [PelajaranController::class,'findtype']);
    Route::post('tingkat', [PelajaranController::class,'findtingkat']);
    Route::post('detail', [PelajaranController::class,'detail']);
    Route::post('update', [PelajaranController::class,'update']);
    Route::post('delete', [PelajaranController::class,'delete']);
    Route::post('harga/add', [PelajaranController::class,'hargaadd']);
});
Route::prefix('kelas')->group(function () {
    Route::post('add', [KelasController::class,'add']);
    Route::get('all', [KelasController::class,'all']);
    Route::post('update', [KelasController::class,'update']);
    Route::post('delete', [KelasController::class,'delete']);
});
Route::prefix('paket')->group(function () {
    Route::post('add', [PaketController::class,'add']);
    Route::get('all', [PaketController::class,'all']);
    Route::post('update', [PaketController::class,'update']);
    Route::post('delete', [PaketController::class,'delete']);
    Route::post('detail', [PaketController::class,'detail']);
});
Route::prefix('voucher')->group(function () {
    Route::post('add', [VoucherController::class,'add']);
    Route::get('all', [VoucherController::class,'all']);
    Route::post('update', [VoucherController::class,'update']);
    Route::post('delete', [VoucherController::class,'delete']);
    Route::post('detail', [VoucherController::class,'detail']);
});
Route::prefix('silabus')->group(function () {
    Route::post('add', [SilabusController::class,'add']);
    Route::get('all', [SilabusController::class,'all']);
});
Route::prefix('afiliate')->group(function () {
    Route::post('add', [AfiliateController::class,'add']);
    Route::get('find', [AfiliateController::class,'find']);
    Route::post('delete', [AfiliateController::class,'destroy']);
});

