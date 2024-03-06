<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\Admin\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('admin/login', [HomeController::class, 'login']);

Route::get('my-home', [HomeController::class, 'admin']);

Route::get('/', function () {
    return view('welcome');
});
