<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CourseController;

//root homepage
Route::get('/', function () {return view('learner.homepage');});

//homepage
Route::get('/homepage', function () {return view('learner.homepage');})->name('learner.homepage');

//authentication
Route::get('/login', [AuthenticationController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthenticationController::class, 'login']);

Route::get('/register', [AuthenticationController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthenticationController::class, 'register']);

Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');

//admin section
Route::get('/admin/dashboard', function () {return view('admin.dashboard');})->middleware('auth:admin')->name('admin.dashboard');

//course section
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index'); //show all courses
Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show'); //show a course
Route::get('/courses/{id}/learn', [CourseController::class, 'startLearning'])->name('courses.learn'); //show page of modules

//question section
Route::get('/module/{id}/quiz', [CourseController::class, 'showQuiz'])->name('module.quiz');