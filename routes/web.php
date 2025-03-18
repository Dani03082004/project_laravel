<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin', function () {
    return "Ets un administrador!";
})->middleware(['role:admin'])->name('admin');

Route::get('/member', function () {
    return "Ets un membre de la gestora d'InmoGest!";
})->middleware(['role:member'])->name('member');

Route::resource('properties', PropertyController::class);
Route::middleware(['auth'])->group(function () {
    Route::resource('properties', PropertyController::class)->except(['index', 'show']);
});

require __DIR__ . '/auth.php';