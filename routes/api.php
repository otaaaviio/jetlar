<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PetPhotoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('/v1')->group(function () {
        Route::apiResource('pets', PetController::class);
        Route::apiResource('pets.photos', PetPhotoController::class)->only(['store', 'destroy']);
        Route::apiResource('photos', PhotoController::class)->only(['show', 'store', 'destroy']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});
