<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;

//homepage
Route::get('/homepage', function () {
    return view('learner.homepage');
})->name('learner.homepage');


//authentication
Route::get('/login', [AuthenticationController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthenticationController::class, 'login']);

Route::get('/register', [AuthenticationController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthenticationController::class, 'register']);

Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');


//admin section
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth:admin')->name('admin.dashboard');