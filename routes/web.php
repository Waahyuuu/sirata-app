<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;

// landingpage akses
Route::get('/', function () {
    return view('landing.index');
});

// admin login
Route::prefix('admin')->group(function () {

    Route::get('/login', [AdminAuthController::class, 'login']);

    Route::post('/login', [AdminAuthController::class, 'authenticate']);

    Route::get('/dashboard', [AdminAuthController::class, 'dashboard']);

    Route::post('/logout', [AdminAuthController::class, 'logout']);
});
