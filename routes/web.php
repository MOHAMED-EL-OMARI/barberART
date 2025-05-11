<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/login', [PageController::class, 'showLogin'])->name('login.show');
Route::get('/register', [PageController::class, 'showRegister'])->name('register.show');
Route::post('/register', [PageController::class, 'register'])->name('register');
Route::get('/login', [PageController::class, 'showLogin'])->name('login.show');
Route::post('/login', [PageController::class, 'login'])->name('login');
Route::post('/logout', [PageController::class, 'logout'])->name('logout');