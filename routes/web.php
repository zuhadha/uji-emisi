<?php

use App\Http\Controllers\DashboardKendaraanController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardUjiEmisiController;
use App\Http\Controllers\UjiEmisiController;
use App\Http\Controllers\UserAdminController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Models\Kendaraan;


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

Route::get('/', function () {
    return view('home');
})->middleware('auth');

Route::resource('/dashboard/ujiemisi', DashboardUjiEmisiController::class)->middleware('auth');

// Route::get('/form-uji', function () {
//     return view('form-uji');
// })->middleware('auth');

// Route::get('/list-kendaraan', [KendaraanController::class,'index'])->middleware('auth');
Route::get('/insert-uji', function () {
    return view('dashboard/ujiemisi/insert-uji', [UjiEmisiController::class,'index']);
})->middleware('auth');

// Route::get('/form-kendaraan', function () {
//     return view('form-kendaraan', [KendaraanController::class,'index']);
// })->middleware('auth');
// Route::get('/dashboard/kendaraan', function () {
//     return view('form-kendaraan', [KendaraanController::class,'index']);
// })->middleware('auth');

Route::get('/login', [LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class,'authenticate']);
Route::post('/logout', [LoginController::class,'logout']);

// Route::get('/register', [RegisterController::class,'index'])->middleware('guest');
// Route::post('/register', [RegisterController::class,'store']);

Route::get('/dashboard', [DashboardController::class,'index'])->middleware('auth');

Route::resource('/dashboard/kendaraan', DashboardKendaraanController::class)->middleware('auth');

Route::resource('/dashboard/user', UserAdminController::class)->middleware('admin');

Route::resource('/dashboard/ujiemisi', UjiEmisiController::class)->middleware('auth');