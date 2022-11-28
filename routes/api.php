<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\FeedbackController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//public route
Route::post('/register', [Authcontroller::class, 'register']);
Route::post('/login', [Authcontroller::class, 'login']);
Route::post('/produk', [ProdukController::class, 'store']);
Route::get('/produk', [ProdukController::class, 'index']);
Route::get('/produk/{id}', [ProdukController::class, 'show']);
Route::put('/produk/{id}', [ProdukController::class, 'update']);
Route::delete('/produk/{id}', [ProdukController::class, 'destroy']);

//protected
Route::middleware('auth:sanctum')->group(function () {
    Route::Post('/logout', [Authcontroller::class, 'logout']);
    Route::resource('alamat', AlamatController::class)->except('create', 'edit', 'show', 'index',);
    Route::get('/alamat', [AlamatController::class, 'index']);
    Route::get('/alamat/{id}', [AlamatController::class, 'show']);
    Route::resource('feedback', FeedbackController::class)->except('create', 'edit', 'show', 'index',);
    Route::get('/feedback', [FeedbackController::class, 'index']);
    Route::get('/feedback/{id}', [FeedbackController::class, 'show']);
});
