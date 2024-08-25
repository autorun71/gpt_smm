<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminLoginController;

Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('login', [AdminLoginController::class, 'login']);
Route::post('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth:admin'])->group(function() {
    Route::get('dashboard', function() {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});
