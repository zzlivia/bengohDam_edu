<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CommunityStoryController;
use App\Http\Controllers\Admin\CommunityStoryController as AdminCommunityStoryController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\LectureSectionController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ModuleController;

//public routes
Route::get('/', fn () => view('learner.homepage'));
Route::get('/homepage', fn () => view('learner.homepage'))->name('learner.homepage');

//authentication
Route::get('/login', [AuthenticationController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthenticationController::class, 'login']);
Route::get('/register', [AuthenticationController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthenticationController::class, 'register'])->name('register');
Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');

//courses
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');
Route::get('/courses/{id}/learn', [CourseController::class, 'startLearning'])->name('courses.learn');

// MCQs
Route::get('/module/{id}/quiz', [CourseController::class, 'showQuiz'])
    ->name('module.quiz');

Route::get('/module/{id}/questions', [CourseController::class, 'showModuleQuestions'])
    ->name('module.questions');

Route::post('/module/{id}/questions', [CourseController::class, 'submitModuleQuestions'])
    ->name('module.questions.submit');

// course feedback
//Route::get('/course/feedback', [CourseController::class, 'courseFeedback'])->name('course.feedback');
    //show feedback page
Route::get('/course/{id}/feedback', [CourseController::class, 'courseFeedback'])
    ->name('course.feedback');
    //submit the feedback form
Route::post('/course/feedback', [CourseController::class, 'submitFeedback'])->name('course.feedback.submit');

//course assessment
Route::get('/course/{id}/assessment', [CourseController::class, 'courseAssessment'])
    ->name('course.assessment');

//course progress of a user
Route::get('/course/{course}/progress', [CourseController::class, 'progress'])
    ->name('course.progress');

//leaderboard requires user to sign in to access
Route::get('/leaderboards', [CourseController::class, 'leaderboard'])
    ->middleware('auth')
    ->name('leaderboards');

//main settings for learner
Route::get('/settings', function () {return view('settings.settings');})->name('settings');

//learner's setting
Route::prefix('settings')->name('settings.')->group(function () {

    // public settings
    Route::get('/', fn () => view('settings.settings'))->name('index');

    Route::get('/notifications', [SettingsController::class, 'notifications'])
        ->name('notifications');

    Route::post('/notifications/save', [SettingsController::class, 'saveNotifications'])
        ->name('notifications.save');

    Route::get('/preferences', [SettingsController::class, 'preferences'])
        ->name('preferences');

    Route::post('/preferences/save', [SettingsController::class, 'savePreferences'])
        ->name('preferences.save');

    // profile (login required)
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [SettingsController::class, 'profile'])
            ->name('profile');

        Route::post('/profile/update', [SettingsController::class, 'updateProfile'])
            ->name('profile.update');
    });
});

//public community stories
Route::get('/community-stories', [CommunityStoryController::class, 'index'])->name('community.stories');

//admin authentication
Route::get('/admin/signin', [AuthController::class, 'showLogin'])
    ->name('admin.login');

Route::post('/admin/signin', [AuthController::class, 'login'])
    ->name('admin.login.submit');

Route::post('/admin/logout', [AuthController::class, 'logout'])
    ->name('admin.logout');

//admin protected route
Route::prefix('admin')
    ->middleware('auth:admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        Route::get('/user-management',
            [AdminController::class, 'userManagement'])
            ->name('user.management');

        Route::get('/course-module-management',
            [AdminController::class, 'courseModuleManagement'])
            ->name('course.module');
        //create the course
        Route::get('/course-module/create',
            [AdminController::class, 'createCourseModule'])
            ->name('course.module.create');  
        //storing the course
        Route::post('/course/store', 
            [AdminController::class, 'storeCourse'])
            ->name('course.store');

        Route::get('/course/edit/{id}',
            [AdminController::class,'editCourse'])
            ->name('course.edit');

        Route::put('/course/update/{id}',
            [AdminController::class,'updateCourse'])
            ->name('course.update');

        Route::delete('/course/delete/{id}',
            [AdminController::class,'deleteCourse'])
            ->name('course.delete');

        Route::get('/module/create', 
            [ModuleController::class, 'create'])
            ->name('module.create');
            
        Route::post('/module/store', 
            [ModuleController::class, 'store'])
            ->name('module.store');

        Route::get('/progress',
            [AdminController::class, 'progress'])
            ->name('progress');

        Route::get('/announcements',
            [AdminController::class, 'announcements'])
            ->name('announcements');
        
        Route::get('/reports',
            [AdminController::class, 'reports'])
            ->name('reports');

        Route::post('/lecture-sections/store', 
            [LectureSectionController::class, 'store'])
            ->name('store');

        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');

        Route::get('help-support', [AdminController::class, 'helpSupport'])->name('help');

        Route::get('/stories', [AdminCommunityStoryController::class, 'index'])->name('stories.index');
        Route::get('/stories/create', [AdminCommunityStoryController::class, 'create'])->name('stories.create');
        Route::post('/stories', [AdminCommunityStoryController::class, 'store'])->name('stories.store');
        Route::get('/stories/{id}/edit', [AdminCommunityStoryController::class, 'edit'])->name('stories.edit');
        Route::put('/stories/{id}', [AdminCommunityStoryController::class, 'update'])->name('stories.update');
        Route::delete('/stories/{id}', [AdminCommunityStoryController::class, 'destroy'])->name('stories.destroy');
});