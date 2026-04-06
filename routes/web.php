<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
})->name('landing');

Route::post('/login', function(Request $request) {
    // Simulasi login sukses
    return redirect()->route('dashboard');
})->name('login.post');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::post('/logout', function(Request $request) {
    // Simulasi logout
    return redirect()->route('landing');
})->name('logout');
