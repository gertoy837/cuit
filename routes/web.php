<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CuitController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('login');
    })->name('login');

    Route::get('/register', function () {
        return view('register');
    })->name('register');

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/', [CuitController::class, 'index'])->name('home');
    Route::post('/logout', action: [AuthController::class, 'logout'])->name('logout');
    Route::post('/post', action: [CuitController::class, 'post'])->name('cuit.post');
});