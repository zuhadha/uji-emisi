<?php

use App\Http\Controllers\DashboardKendaraanController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardUjiEmisiController;
use App\Http\Controllers\KendaraanUjiEmisiController;
use App\Http\Controllers\UjiEmisiController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\AlatUji;
use App\Http\Controllers\AlatUjiController;
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

// Route::get('/', function () {
//     return view('/dashboard');
// })->middleware('auth');
Route::get('/dashboard/ujiemisi/get-nopol', [KendaraanUjiEmisiController::class, 'getNopol']);
Route::get('/', [DashboardController::class, 'index'])->middleware('auth');

Route::resource('/dashboard/ujiemisi', DashboardUjiEmisiController::class)->middleware('auth');

// Route::get('/form-uji', function () {
//     return view('form-uji');
// })->middleware('auth');

// Route::get('/list-kendaraan', [KendaraanController::class,'index'])->middleware('auth');
Route::get('/insert-uji', function () {
    return view('dashboard.UjiEmisi.insert-uji', [UjiEmisiController::class, 'index']);
})->middleware('auth');

Route::get('/input-sertif', function () {
    return view('dashboard.UjiEmisi.input-sertif');
})->middleware('auth');

// Route::get('/form-kendaraan', function () {
//     return view('form-kendaraan', [KendaraanController::class,'index']);
// })->middleware('auth');
// Route::get('/dashboard/kendaraan', function () {
//     return view('form-kendaraan', [KendaraanController::class,'index']);
// })->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

// Route::get('/register', [RegisterController::class,'index'])->middleware('guest');
// Route::post('/register', [RegisterController::class,'store']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::resource('/dashboard/kendaraan', DashboardKendaraanController::class)->middleware('auth');

Route::resource('/dashboard/user', UserAdminController::class)->middleware(['auth', 'admin']);

Route::resource('/dashboard/ujiemisi', UjiEmisiController::class)->middleware('auth')->except(['show']);

Route::resource('/dashboard/ujiemisi/insert', KendaraanUjiEmisiController::class)->middleware('auth');

Route::get('/dashboard/ujiemisi/insert/create/{kendaraan_id}', [KendaraanUjiEmisiController::class, 'showCreateFormWithKendaraan'])->name('ujiemisi.insert.create');

// input no sertif baru
Route::get('/dashboard/ujiemisi/input-sertif/{ujiemisi_id}/input-nomor', [KendaraanUjiEmisiController::class, 'showInputSertifikat'])->name('ujiemisi.insert.create');
Route::put('/dashboard/ujiemisi/input-sertif/{ujiemisi_id}/input-nomor/submit-nomor', [KendaraanUjiEmisiController::class, 'inputSertifikat'])->name('ujiemisi.input.nomor');

// input no sertif edit
Route::post('/dashboard/ujiemisi/input-sertif/{ujiemisi_id}/input-nomor', [UjiEmisiController::class, 'showInputSertifikat'])->name('ujiemisi.insert.create');
Route::post('/dashboard/ujiemisi/input-sertif/input-nomor', [UjiEmisiController::class, 'inputSertifikat'])->name('ujiemisi.insert.create');

// test pdf
Route::get('/dashboard/cetak/dotmatrix', [KendaraanUjiEmisiController::class, 'cetakPdfDotMatrix']);
Route::get('/dashboard/cetak/printer', [KendaraanUjiEmisiController::class, 'cetakPdfPrinter']);

Route::get('/export', [ExportController::class, 'export'])->name('export');
Route::get('/dashboard/export/custom', [ExportController::class, 'exportCustom'])->name('custom_export');
Route::get('/dashboard/export/custom/input', [ExportController::class, 'exportCustomInput'])->name('custom_export_input');

Route::resource('/dashboard/alatuji', AlatUjiController::class)->middleware(['auth', 'admin']);
