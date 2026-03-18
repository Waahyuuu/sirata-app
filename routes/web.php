<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\MahasiswaController;


// landingpage akses
Route::get('/', function () {
    return view('landing.index');
});

// admin akses
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login', [AdminAuthController::class, 'login'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'authenticate']);

    Route::middleware('admin')->group(function () {

        Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard');

        Route::get('/pesan', fn() => view('admin.pesan'))->name('pesan');

        Route::get('/mahasiswa', fn() => view('admin.mahasiswa'))->name('mahasiswa');

        Route::get('/konten', fn() => view('admin.konten.index'))->name('konten');

        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});

// user akses
Route::middleware('mahasiswa')->group(function () {

    Route::middleware('mahasiswa')->group(function () {
        Route::get('/mahasiswa/dashboard', [MahasiswaController::class, 'dashboard']);
    });
});
