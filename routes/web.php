<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DispositionController;
use App\Http\Controllers\IncomingMailController;
use App\Http\Controllers\OutgoingMailController;
use App\Models\Disposition;

// Redirect root to login
Route::redirect('/', '/login');

// Authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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

    Route::patch('/surat-masuk/{incomingMail}/send', [IncomingMailController::class, 'send'])
        ->name('surat-masuk.send');

    Route::resource('surat-keluar', OutgoingMailController::class)
        ->parameter('surat-keluar', 'outgoingMail')
        ->names([
            'index' => 'surat-keluar.index',
            'create' => 'surat-keluar.create',
            'store' => 'surat-keluar.store',
            'show' => 'surat-keluar.show',
            'edit' => 'surat-keluar.edit',
            'update' => 'surat-keluar.update',
            'destroy' => 'surat-keluar.destroy'
        ]);
    Route::resource('disposisi', DispositionController::class)->except(['create']);
    Route::get('/disposisi/incoming/{incomingMail}', [DispositionController::class, 'create'])->name('disposisi.create');

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
