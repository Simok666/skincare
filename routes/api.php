<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\AdminAuthController;
use App\Http\Controllers\API\Auth\UserAuthController;
use App\Http\Controllers\API\Admin\CategoryController;

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

Route::group(['namespace' => 'Api', 'prefix' => 'v1'], function () {
    Route::post('user/login', [UserAuthController::class, 'login']);
    Route::post('admin/login', [AdminAuthController::class, 'login']);
   
});
// for user
Route::middleware(['auth:sanctum', 'type.user'])->group(function () {
    // Route::get('/users/orders', [OrderController::class, 'orders']);
});
// Only for admins
Route::middleware(['auth:sanctum', 'type.admin'])->group(function () {
    Route::group(['prefix' => 'v1'], function () {
        Route::apiResource('admin/categories', CategoryController::class);
        Route::post('admin/logout', [AdminAuthController::class, 'destory']);
    });
    
   
});
