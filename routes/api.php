<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JWTAuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('auth')->group(function () {

    Route::post('login', [JWTAuthController::class, 'login']);
});

Route::middleware(['auth:api'])->prefix('auth')->group(function () {

    Route::post('refresh', [JWTAuthController::class, 'refresh'])->name('refresh');
    Route::post('me', [JWTAuthController::class, 'me'])->name('me');
});
