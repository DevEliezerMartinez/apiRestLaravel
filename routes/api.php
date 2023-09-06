<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Public routes
Route::post('register', [AuthController::class, 'registerUser']);
Route::post('login', [AuthController::class, 'loginUser']);
Route::get('products', [ProductController::class, 'index']);

//Protected routes
Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('account', [AuthController::class, 'getInformationUser']);
    Route::post('newProduct', [ProductController::class, 'AddProduct']);
    Route::get('logout', [AuthController::class, 'logoutUser']);
    Route::put('modifyProduct', [ProductController::class, 'modifyProduct']);
    Route::delete('deleteProduct', [ProductController::class, 'deleteProduct']);
});