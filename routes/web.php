<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\BarberController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/login', [PageController::class, 'showLogin'])->name('login.show');
Route::get('/register', [PageController::class, 'showRegister'])->name('register.show');
Route::post('/register', [PageController::class, 'register'])->name('register');
Route::post('/login', [PageController::class, 'login'])->name('login');
Route::post('/logout', [PageController::class, 'logout'])->name('logout');
Route::get('/barber/info', [BarberController::class, 'ShowBarberInfo'])->name('barber.info')->middleware('auth');
Route::post('/barber/info', [BarberController::class, 'storeBarberInfo'])->name('barber.store')->middleware('auth');
Route::get('/barber/dashboard', [BarberController::class, 'dashboard'])->name('barber.dashboard')->middleware('auth');