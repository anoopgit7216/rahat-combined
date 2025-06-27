<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});
