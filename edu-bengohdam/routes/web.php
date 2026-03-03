<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CourseController;
//use App\Http\Controllers\CommunityStoryController;
use App\Http\Controllers\Admin\CommunityStoryController;

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

//display module questions page
Route::get('/module/{id}/questions', [CourseController::class, 'showModuleQuestions'])->name('module.questions');

//submit module questions
Route::post('/module/{id}/questions', [CourseController::class, 'submitModuleQuestions'])->name('module.questions.submit');

//to view community stories
Route::get('/community-stories', [CommunityStoryController::class, 'index'])->name('community.stories');

//admin insert community stories
Route::prefix('admin')->group(function () {
    Route::get('/stories/create', [CommunityStoryController::class, 'create'])->name('admin.stories.create');
    Route::post('/stories/store', [CommunityStoryController::class, 'store'])->name('admin.stories.store');
});