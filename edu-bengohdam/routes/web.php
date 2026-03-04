<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CommunityStoryController;
use App\Http\Controllers\Admin\CommunityStoryController as AdminCommunityStoryController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\AdminController;

//public routes
Route::get('/', fn () => view('learner.homepage'));
Route::get('/homepage', fn () => view('learner.homepage'))->name('learner.homepage');

//authentication
Route::get('/login', [AuthenticationController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthenticationController::class, 'login']);
Route::get('/register', [AuthenticationController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');

//courses
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');
Route::get('/courses/{id}/learn', [CourseController::class, 'startLearning'])->name('courses.learn');

//mcqs
Route::get('/module/{id}/quiz', [CourseController::class, 'showQuiz'])->name('module.quiz');
Route::get('/module/{id}/questions', [CourseController::class, 'showModuleQuestions'])->name('module.questions');
Route::post('/module/{id}/questions', [CourseController::class, 'submitModuleQuestions'])->name('module.questions.submit');

//public community stories
Route::get('/community-stories', [CommunityStoryController::class, 'index'])->name('community.stories');

//admin authentication
Route::get('/admin/signin', [AuthController::class, 'showLogin'])
    ->name('admin.login');

Route::post('/admin/signin', [AuthController::class, 'login'])
    ->name('admin.login.submit');

//admin user management
Route::get('/admin/user-management', [AdminController::class, 'userManagement'])->name('admin.user.management');

//admin course/module management
Route::get('/admin/course-module-management',
    [App\Http\Controllers\AdminController::class, 'courseModuleManagement'])
    ->name('admin.course.module')
    ->middleware('auth');

//admin protected route
Route::prefix('admin')
    ->middleware('auth:admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.admin_dashboard');
        })->name('dashboard');

        Route::get('/stories', [AdminCommunityStoryController::class, 'index'])->name('stories.index');
        Route::get('/stories/create', [AdminCommunityStoryController::class, 'create'])->name('stories.create');
        Route::post('/stories', [AdminCommunityStoryController::class, 'store'])->name('stories.store');
        Route::get('/stories/{id}/edit', [AdminCommunityStoryController::class, 'edit'])->name('stories.edit');
        Route::put('/stories/{id}', [AdminCommunityStoryController::class, 'update'])->name('stories.update');
        Route::delete('/stories/{id}', [AdminCommunityStoryController::class, 'destroy'])->name('stories.destroy');

});