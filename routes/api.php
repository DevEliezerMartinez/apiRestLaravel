<?php

use App\Http\Controllers\API\V1\ProductController;
use App\Http\Controllers\AuthController;
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

// Auth
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Public
Route::get('products', [ProductController::class, 'index']);

//Protected routes
Route::middleware(['auth:sanctum'])->group(function () {

    // Auth
    Route::post('me', [AuthController::class, 'me']);
    Route::get('logout', [AuthController::class, 'logout']);

    // Products
    Route::get('products', [ProductController::class, 'index']);
    Route::post('products', [ProductController::class, 'create']);
    Route::get('products/{id}', [ProductController::class, 'get']);
    Route::put('products/{id}', [ProductController::class, 'update']);
    Route::delete('products/{id}', [ProductController::class, 'delete']);

});