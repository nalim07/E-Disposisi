<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IncomingMailController;
use Illuminate\Support\Facades\Route;

// Redirect root to login
Route::redirect('/', '/login');

// Authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    // Incoming Mail Resource
    Route::resource('surat-masuk', IncomingMailController::class)
        ->parameter('surat-masuk', 'incomingMail') // Custom parameter name
        ->names([
            'index' => 'surat-masuk.index',
            'create' => 'surat-masuk.create',
            'store' => 'surat-masuk.store',
            'show' => 'surat-masuk.show',
            'edit' => 'surat-masuk.edit',
            'update' => 'surat-masuk.update',
            'destroy' => 'surat-masuk.destroy'
        ]);

    Route::view('/surat-keluar', 'outgoing-mails')->name('surat-keluar');
    Route::view('/disposisi', 'dispositions')->name('disposisi');
    Route::view('/arsip', 'archive')->name('arsip');
});

// Profile routes
Route::middleware('auth')->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
});

require __DIR__ . '/auth.php';
