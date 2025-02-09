<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AuthanticationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard');
});

Route::get('login', [AuthanticationController::class, 'index'])->name('login');
Route::post('auth', [AuthanticationController::class, 'login'])->name('auth');
Route::get('logout', [AuthanticationController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
});