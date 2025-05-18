<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/properties/show', fn() => view('properties.show'))->name('properties.show');
Route::get('/properties/index', fn() => view('properties.index'))->name('properties.index');
Route::get('/properties/edit/{property}', fn() => view('properties.edit'))->name('properties.edit');
Route::get('/properties/create', fn() => view('properties.create'))->name('properties.create');
Route::get('/properties/delete/{property}', fn() => view('properties.delete'))->name('properties.delete');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
