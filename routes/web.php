<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/surat-masuk', function () {
    return view('incoming-mails');
})->middleware(['auth', 'verified'])->name('surat-masuk');

Route::get('/surat-keluar', function () {
    return view('outgoing-mails');
})->middleware(['auth', 'verified'])->name('surat-keluar');

Route::get('/disposisi', function () {
    return view('dispositions');
})->middleware(['auth', 'verified'])->name('disposisi');

Route::get('/arsip', function () {
    return view('archive');
})->middleware(['auth', 'verified'])->name('arsip');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
