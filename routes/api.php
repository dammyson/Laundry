<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ServiceController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('activities')->name('activity.')->group(function () {
    Route::get('/', [ActivityController::class,'get'])->name('list');
    Route::get('/{id}', [ActivityController::class,'show'])->name('show');
    Route::post('/', [ActivityController::class,'create'])->name('store');
    Route::post('/{id}', [ActivityController::class,'update'])->name('update');//
});

Route::prefix('services')->name('service.')->group(function () {
    Route::get('/', [ServiceController::class,'get'])->name('list');
    Route::get('/{id}', [ServiceController::class,'show'])->name('show');
    Route::post('/', [ServiceController::class,'create'])->name('store');
    Route::post('/{id}', [ServiceController::class,'update'])->name('update');//
});