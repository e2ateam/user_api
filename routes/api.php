<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/user', [AuthController::class, 'index'])->name('user.index');
Route::put('/user', [AuthController::class, 'update'])->name('user.update');
