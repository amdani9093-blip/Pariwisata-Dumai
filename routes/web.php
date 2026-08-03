<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DestinasiController;


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

Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');





