<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controller\HomeController;
use Illuminate\Support\Facades\Auth;

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
//     return view('welcome');
// });

Route::redirect('/', '/login');

Route::get('/redirects',[App\Http\Controllers\HomeController::class,"index"]);


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/ruangans', [App\Http\Controllers\RuanganController::class,"index"])->middleware('auth');
Route::resource('ruangans', App\Http\Controllers\RuanganController::class)->middleware('auth');
Route::get('/ruangan', [App\Http\Controllers\RuanganController::class,"search"])->name('keterangan');

Route::get('/penggunaans', [App\Http\Controllers\PenggunaanController::class,"index"])->middleware('auth');
Route::get('/penggunaans/create/{ruangan}', [App\Http\Controllers\PenggunaanController::class,"create"])->middleware('auth');
Route::resource('penggunaans', App\Http\Controllers\PenggunaanController::class)->middleware('auth');
Route::get('/penggunaan', [App\Http\Controllers\PenggunaanController::class,"search"])->name('keterangan');
Route::get('/pengguna', [App\Http\Controllers\PenggunaanController::class,"report"])->name('report');
Route::get('/gunakan', [App\Http\Controllers\PenggunaanController::class,"tampil"])->name('tampil');
Route::get('/report', [App\Http\Controllers\PenggunaanController::class, "PenggunaanReport"]);

Route::get('/peminjamans', [App\Http\Controllers\PeminjamanController::class,"index"])->middleware('auth');
Route::get('/peminjamans/create/{ruangan}', [App\Http\Controllers\PeminjamanController::class,"create"])->middleware('auth');
Route::resource('peminjamans', App\Http\Controllers\PeminjamanController::class)->middleware('auth');
Route::get('/peminjaman', [App\Http\Controllers\PeminjamanController::class,"search"])->name('keterangan');
Route::get('/peminjam', [App\Http\Controllers\PeminjamanController::class,"report"])->name('report');
Route::get('/pinjam', [App\Http\Controllers\PeminjamanController::class,"tampil"])->name('tampil');
Route::get('/report', [App\Http\Controllers\PeminjamanController::class, "PeminjamanReport"]);

Route::get('/users', [App\Http\Controllers\UserController::class,"index"])->middleware('auth');
Route::resource('users', App\Http\Controllers\UserController::class)->middleware('auth');
Route::get('/user', [App\Http\Controllers\UserController::class,"search"])->name('keterangan');
Route::get('/use', [App\Http\Controllers\UserController::class,"tampil"])->name('user');

// Route::get('/lappenggunaans', [App\Http\Controllers\LapPenggunaanController::class,"index"])->middleware('auth');
// Route::resource('lappenggunaans', App\Http\Controllers\LapPenggunaanController::class)->middleware('auth');

// Route::get('/lappeminjamans', [App\Http\Controllers\LapPeminjamanController::class,"index"]);
// Route::resource('lappeminjamans', App\Http\Controllers\LapPeminjamanController::class)->middleware('auth');
