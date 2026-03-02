<?php

use App\Http\Controllers\AuthenticationController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthenticationController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthenticationController::class, 'login']);
Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');

//create learner's homepage route
Route::middleware('auth')->group(function () {

    Route::get('/homepage', function () {
        return view('learner.homepage');
    })->name('learner.homepage');

});

//create admin route
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth:admin')->name('admin.dashboard');