<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/login', [PageController::class, 'showLogin'])->name('show.login');
Route::get('/register', [PageController::class, 'showRegister'])->name('show.register');
Route::post('/register', [PageController::class, 'register'])->name('register');