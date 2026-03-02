<?php

use App\Http\Controllers\AuthenticationController;

Route::get('/login', [AuthenticationController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthenticationController::class, 'login']);
Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');