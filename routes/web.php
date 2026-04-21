<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ManfaatController;
use App\Http\Controllers\ChatbotRuleController;
use App\Http\Controllers\MessageController;
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

// endpoint chatbot (API)
Route::post('/chatbot', [ChatbotRuleController::class, 'chat']);
Route::get('/chatbot/messages', [MessageController::class, 'show']);
Route::post('/chatbot/reply', [MessageController::class, 'reply']);
Route::get('/chatbot/list', [MessageController::class, 'list']);

// admin akses
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login', [AdminAuthController::class, 'login'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'authenticate']);

    Route::middleware('admin')->group(function () {

        Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard');

        // Pesan
        // Message
        Route::get('/pesan', [MessageController::class, 'index'])->name('pesan');
        Route::get('/pesan/{client_id}', [MessageController::class, 'show']);
        Route::post('/pesan/reply', [MessageController::class, 'reply']);
        Route::delete('/pesan/delete-all-message', [MessageController::class, 'deleteAllMessage'])
            ->name('pesan.deleteAllMessage');

        // Chatbot
        Route::post('/pesan/rule', [ChatbotRuleController::class, 'store'])->name('pesan.store');
        Route::delete('/pesan/rule/delete-all', [ChatbotRuleController::class, 'deleteAll'])
            ->name('pesan.deleteAll');
        Route::put('/pesan/rule/{id}', [ChatbotRuleController::class, 'update'])->name('pesan.update');
        Route::delete('/pesan/rule/{id}', [ChatbotRuleController::class, 'destroy'])->name('pesan.destroy');

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
