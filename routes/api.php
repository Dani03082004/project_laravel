<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\OrderController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user-data', function (Request $request) {
    $user = $request->user();

    return response()->json([
        'name' => $user->name,
        'email' => $user->email,
        'role_names' => $user->roles->pluck('name'),
        'properties_count' => $user->properties()->count(),
        'is_admin' => $user->hasRole('admin'),
        'is_member' => $user->hasRole('member'),
    ]);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/properties', [PropertyController::class, 'index']);
    Route::post('/properties', [PropertyController::class, 'store']);
    Route::get('/properties/{property}', [PropertyController::class, 'show']);
    Route::put('/properties/{property}', [PropertyController::class, 'update']);
    Route::delete('/properties/{property}', [PropertyController::class, 'destroy']);

    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart/add', [CartController::class, 'add']);
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove']);
    Route::delete('/cart/clear', [CartController::class, 'clear']);

    Route::post('/checkout', [OrderController::class, 'checkout']);
    Route::get('/orders', [OrderController::class, 'index']);
});
