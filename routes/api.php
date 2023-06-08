<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PhotoController;
use Illuminate\Http\Request;
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

Route::prefix('v1')->group(function () {
    Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
    Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);

    Route::prefix('photos')->group(function () {
        Route::get('/', [App\Http\Controllers\API\PhotoController::class, 'index']);
        Route::get('/photos/{photo}', [App\Http\Controllers\API\PhotoController::class, 'show']);
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('photos', PhotoController::class)->only(['store','update', 'destroy']);

        Route::prefix('photos')->group(function () {
            Route::post('/{photo}/like', [App\Http\Controllers\API\PhotoController::class, 'like']);
            Route::post('/{photo}/unlike', [App\Http\Controllers\API\PhotoController::class, 'unlike']);
        });

        Route::post('/logout', [AuthController::class, 'logout']);
    });

    Route::fallback(function(){
        return response()->json([
            'message' => 'Not Found. If error persists, contact info@website.com'], 404);
    });
});

