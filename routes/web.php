<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AuthController;


Route::get('/', fn () => view('home'))->name('home');
Route::get('/about', fn () => view('about'))->name('about');
Route::get('/menu', fn () => view('menu'))->name('menu');
Route::get('/reward', fn () => view('reward'))->name('reward');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('food')->group(function () {
    Route::get('/breakfast', fn () => view('food.breakfast'))->name('food.breakfast');
    Route::get('/lunch', fn () => view('food.lunch'))->name('food.lunch');
});

Route::prefix('drinks')->group(function () {
    Route::get('/cold-coffe', fn () => view('drinks.cold-coffe'))->name('drinks.cold-coffe');
    Route::get('/cold-tea', fn () => view('drinks.cold-tea'))->name('drinks.cold-tea');
    Route::get('/hot-chocolate', fn () => view('drinks.hot-chocolate'))->name('drinks.hot-chocolate');
    Route::get('/hot-coffe', fn () => view('drinks.hot-coffe'))->name('drinks.hot-coffe');
    Route::get('/hot-tea', fn () => view('drinks.hot-tea'))->name('drinks.hot-tea');
});

Route::prefix('desert')->group(function () {
    Route::get('/bakery', fn () => view('desert.bakery'))->name('desert.bakery');
    Route::get('/treats', fn () => view('desert.treats'))->name('desert.treats');


});
