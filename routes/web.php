<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DestinasiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AtraksiController;



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

Route::get('/', [DestinasiController::class, 'beranda'])
    ->name('beranda');

Route::get('/destinasi', [DestinasiController::class, 'index'])->name('destinasi');
Route::get('/destinasi/create', [DestinasiController::class, 'create'])->name('destinasi.create');
Route::post('/destinasi', [DestinasiController::class, 'store'])->name('destinasi.store');
Route::get('/destinasi/{id}/edit', [DestinasiController::class, 'edit'])->name('destinasi.edit');
Route::put('/destinasi/{id}', [DestinasiController::class, 'update'])->name('destinasi.update');
Route::delete('/destinasi/{id}', [DestinasiController::class, 'destroy'])->name('destinasi.destroy');
 
// Route {id} generik selalu PALING BAWAH:
Route::get('/destinasi/{id}', [DestinasiController::class, 'show'])->name('destinasi.detail');

Route::get('/user', [UserController::class, 'index'])->name('user');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user', [UserController::class, 'store'])->name('user.store');
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

// URUTAN YANG BENAR
Route::get('/atraksi', [AtraksiController::class, 'index'])->name('atraksi');
Route::get('/atraksi/create', [AtraksiController::class, 'create'])->name('atraksi.create'); // harus di atas
Route::post('/atraksi', [AtraksiController::class, 'store'])->name('atraksi.store');
Route::get('/atraksi/{id}/edit', [AtraksiController::class, 'edit'])->name('atraksi.edit');
Route::put('/atraksi/{id}', [AtraksiController::class, 'update'])->name('atraksi.update');
Route::delete('/atraksi/{id}', [AtraksiController::class, 'destroy'])->name('atraksi.destroy');


Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');





