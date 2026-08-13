<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DestinasiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AtraksiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\KategoriController;

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
Route::get('/atraksi', [AtraksiController::class, 'index'])->name('atraksi');

Route::middleware('auth')->group(function () {
    Route::get('/destinasi/{id}/ulasan/create', [UlasanController::class, 'create'])->name('ulasan.create');
    Route::post('/ulasan', [UlasanController::class, 'store'])->name('ulasan.store');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])
    ->name('auth.google');
 
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])
    ->name('auth.google.callback');
 
Route::get('/auth/whatsapp', [AuthController::class, 'redirectToWhatsApp'])
    ->name('auth.whatsapp');

Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');

/*
|--------------------------------------------------------------------------
| AREA ADMIN (semua route admin digabung dalam satu grup middleware
| yang KONSISTEN, biar tidak ada alias middleware yang beda-beda)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Destinasi
    Route::get('/destinasi/create', [DestinasiController::class, 'create'])->name('destinasi.create');
    Route::post('/destinasi', [DestinasiController::class, 'store'])->name('destinasi.store');
    Route::get('/destinasi/{id}/edit', [DestinasiController::class, 'edit'])->name('destinasi.edit');
    Route::put('/destinasi/{id}', [DestinasiController::class, 'update'])->name('destinasi.update');
    Route::delete('/destinasi/{id}', [DestinasiController::class, 'destroy'])->name('destinasi.destroy');

    // User
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    // Atraksi
    Route::get('/atraksi/create', [AtraksiController::class, 'create'])->name('atraksi.create');
    Route::post('/atraksi', [AtraksiController::class, 'store'])->name('atraksi.store');
    Route::get('/atraksi/{id}/edit', [AtraksiController::class, 'edit'])->name('atraksi.edit');
    Route::put('/atraksi/{id}', [AtraksiController::class, 'update'])->name('atraksi.update');
    Route::delete('/atraksi/{id}', [AtraksiController::class, 'destroy'])->name('atraksi.destroy');

    // Pengaturan Admin (Settings)
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/settings', [SettingsController::class, 'index'])
            ->name('settings.index');

        Route::put('/settings/profile', [SettingsController::class, 'updateProfile'])
            ->name('settings.profile.update');

        Route::put('/settings/password', [SettingsController::class, 'updatePassword'])
            ->name('settings.password.update');

    });

    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
    Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
});

// Route {id} generik untuk destinasi HARUS PALING BAWAH
Route::get('/destinasi/{id}', [DestinasiController::class, 'show'])->name('destinasi.detail');