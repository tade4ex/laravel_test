<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProductController;
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

Route::fallback(function () {
    abort(404, 'API resource not found');
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')
    ->controller(ProductController::class)
    ->prefix('products')
    ->group(function () {
        Route::get('', 'index');
    });
