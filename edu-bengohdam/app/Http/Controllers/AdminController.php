<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function dashboard()
    {
        return view('admin.admin_dashboard');
    }
    public function userManagement()
    {
        $users = User::all();

        $totalUsers = $users->count();
        $engagedThisWeek = $users->count();

        return view('admin.user_management', compact(
            'users',
            'totalUsers',
            'engagedThisWeek'
        ));
    }

    public function courseModuleManagement()
    {
        // Replace later with real Course model
        $totalCourses = 4;
        $totalModules = 15;
        $coursesTaken = 5;
        $modulesCompleted = 5;

        $courses = [
            ['name' => 'Course Name 1'],
            ['name' => 'Course Name 1'],
            ['name' => 'Course Name 1'],
            ['name' => 'Course Name 1'],
            ['name' => 'Course Name 1'],
        ];

        return view('admin.course_module_management', compact(
            'totalCourses',
            'totalModules',
            'coursesTaken',
            'modulesCompleted',
            'courses'
        ));
    }

    public function progress()
    {
        return view('admin.progress');
    }

    public function announcements()
    {
        return view('admin.announcements');
    }
}
