<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ManfaatController;
use App\Http\Controllers\ChatbotRuleController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Admin\AdminAkunController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TestApiController;
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

Route::post('/mahasiswa/cari', [MahasiswaController::class, 'cari'])->name('mahasiswa.cari');

// endpoint chatbot (API)
Route::post('/chatbot', [ChatbotRuleController::class, 'chat']);
Route::get('/chatbot/messages', [MessageController::class, 'show']);
Route::post('/chatbot/reply', [MessageController::class, 'reply']);
Route::get('/chatbot/list', [MessageController::class, 'list']);

// admin akses
Route::prefix('admin')->name('admin.')->group(function () {

    // =========================
    // AUTH
    // =========================
    Route::get('/login', [AdminAuthController::class, 'login'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'authenticate']);

    // =========================
    // PROTECTED ROUTES (ADMIN)
    // =========================
    Route::middleware('admin')->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // =========================
        // PESAN
        // =========================
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

        // =========================
        // MAHASISWA
        // =========================
        Route::get('/mahasiswa', [MahasiswaController::class, 'adminIndex'])
            ->name('mahasiswa');

        // =========================
        // AKUN (SUPER ADMIN)
        // =========================
        Route::prefix('akun')
            ->name('akun.')
            ->middleware('protected.admin')
            ->group(function () {
                Route::get('/', [AdminAkunController::class, 'index'])->name('index');
                Route::post('/store', [AdminAkunController::class, 'store'])->name('store');
                Route::put('/update/{id}', [AdminAkunController::class, 'update'])->name('update');
                Route::delete('/destroy/{id}', [AdminAkunController::class, 'destroy'])->name('destroy');
            });

        // =========================
        // KONTEN
        // =========================
        Route::get('/konten', [AdminAuthController::class, 'konten'])->name('konten');

        // FAQ
        Route::prefix('konten/faq')->name('konten.faq.')->group(function () {
            Route::get('/', [FaqController::class, 'admin'])->name('index');
            Route::post('/', [FaqController::class, 'store'])->name('store');
            Route::put('/{faq}', [FaqController::class, 'update'])->name('update');
            Route::delete('/{faq}', [FaqController::class, 'destroy'])->name('destroy');
            Route::get('/delete-all', [FaqController::class, 'deleteAll'])->name('deleteAll');
        });

        // MANFAAT
        Route::prefix('konten/manfaat')->name('konten.manfaat.')->group(function () {
            Route::post('/', [ManfaatController::class, 'store'])->name('store');
            Route::put('/{manfaat}', [ManfaatController::class, 'update'])->name('update');
            Route::delete('/{manfaat}', [ManfaatController::class, 'destroy'])->name('destroy');
            Route::get('/delete-all', [ManfaatController::class, 'deleteAll'])->name('deleteAll');
        });

        // LINK
        Route::prefix('konten/link')->name('konten.link.')->group(function () {
            Route::post('/', [LinkController::class, 'store'])->name('store');
            Route::put('/{link}', [LinkController::class, 'update'])->name('update');
            Route::delete('/{link}', [LinkController::class, 'destroy'])->name('destroy');
            Route::get('/delete-all', [LinkController::class, 'deleteAll'])->name('deleteAll');
        });

        // =========================
        // LOGOUT
        // =========================
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});

// user akses
Route::post('/mahasiswa/cari', [MahasiswaController::class, 'cari'])
    ->name('mahasiswa.cari');

Route::post('/logout', function () {

    session()->forget('mahasiswa');

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->name('logout');

Route::middleware('mahasiswa')->group(function () {
    Route::get('/mahasiswa/dashboard', [MahasiswaController::class, 'dashboard']);
    Route::get('/mahasiswa/biodata', [MahasiswaController::class, 'biodata']);
    Route::get('/mahasiswa/hasil-studi', [MahasiswaController::class, 'hasilStudi']);
    Route::get('/mahasiswa/nilai-prestasi-akademik', [MahasiswaController::class, 'salinanNilai']);
    Route::get('/mahasiswa/jadwal', [MahasiswaController::class, 'jadwal']);
});

// Route UjiCoba API Start

Route::prefix('mahasiswa')->group(function () {
    Route::get('/{nim}/krs-aktif', [TestApiController::class, 'krsAktif']);
    Route::get('/{nim}/jadwal', [TestApiController::class, 'jadwalMahasiswa']);
    Route::get('/class', [TestApiController::class, 'allClass']);
    Route::get('/class/{id}', [TestApiController::class, 'classDetail']); // Detail satu kelas

    Route::get('/{nim}/khs/{semester}', [TestApiController::class, 'khs']);
    Route::get('/transkrip/{nim}', [TestApiController::class, 'transkrip']);
    Route::get('/{nim}/krs/{semester}', [TestApiController::class, 'krsDetail']);
    Route::get('/krs/history', [TestApiController::class, 'krsHistory']);

    Route::get('/email/{email}', [TestApiController::class, 'showByEmail'])
        ->where('email', '.*');

    Route::get('/{nim}', [TestApiController::class, 'show']);

    Route::get('/test/gpa/{nim}', [TestApiController::class, 'gpaHistory']);
});

Route::get('/token-test', [TestApiController::class, 'getTokenTest']);

// Route UjiCoba API Start
