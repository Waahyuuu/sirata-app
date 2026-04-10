<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ManfaatController;
use App\Models\Link;
use App\Models\Faq;
use App\Models\Manfaat;

// landingpage akses
Route::get('/', function () {
    $links = Link::latest()->get();
    $faqs = Faq::latest()->get();
    $manfaats = Manfaat::latest()->get();

    return view('index', compact('links', 'faqs', 'manfaats'));
});

// admin akses
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login', [AdminAuthController::class, 'login'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'authenticate']);

    Route::middleware('admin')->group(function () {

        Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard');

        Route::get('/pesan', fn() => view('admin.pesan'))->name('pesan');

        Route::get('/mahasiswa', fn() => view('admin.mahasiswa'))->name('mahasiswa');

        Route::get('/konten', [AdminAuthController::class, 'konten'])->name('konten');

        // konten (FAQ)
        Route::prefix('konten/faq')->name('konten.faq.')->group(function () {
            Route::get('/', [FaqController::class, 'admin'])->name('index');
            Route::post('/', [FaqController::class, 'store'])->name('store');
            Route::put('/{faq}', [FaqController::class, 'update'])->name('update');
            Route::delete('/{faq}', [FaqController::class, 'destroy'])->name('destroy');
            Route::get('/delete-all', [FaqController::class, 'deleteAll'])->name('deleteAll');
        });

        // konten (MANFAAT)
        Route::prefix('konten/manfaat')->name('konten.manfaat.')->group(function () {
            Route::post('/', [ManfaatController::class, 'store'])->name('store');
            Route::put('/{manfaat}', [ManfaatController::class, 'update'])->name('update');
            Route::delete('/{manfaat}', [ManfaatController::class, 'destroy'])->name('destroy');
            Route::get('/delete-all', [ManfaatController::class, 'deleteAll'])->name('deleteAll');
        });


        // konten (LINK)
        Route::prefix('konten/link')->name('konten.link.')->group(function () {
            Route::post('/', [LinkController::class, 'store'])->name('store');
            Route::put('/{link}', [LinkController::class, 'update'])->name('update');
            Route::delete('/{link}', [LinkController::class, 'destroy'])->name('destroy');
            Route::get('/delete-all', [LinkController::class, 'deleteAll'])->name('deleteAll');
        });

        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});

// user akses
Route::middleware('mahasiswa')->group(function () {

    Route::middleware('mahasiswa')->group(function () {
        Route::get('/mahasiswa/dashboard', [MahasiswaController::class, 'dashboard']);
    });
});
