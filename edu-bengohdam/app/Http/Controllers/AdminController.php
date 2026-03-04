<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Course;

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
        $courses = Course::with('modules.lectures.sections')->get();

        $totalCourses = $courses->count();
        $totalModules = $courses->sum(fn($course) => $course->modules->count());
        $coursesTaken = 0; // update later from enrolment table
        $modulesCompleted = 0; // update later from progress table

        return view('admin.course_module_management', compact(
            'courses',
            'totalCourses',
            'totalModules',
            'coursesTaken',
            'modulesCompleted'
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

    public function reports()
    {
        return view('admin.reports');
    }

    public function settings()
    {
        return view('admin.admin_settings');
    }

    public function helpSupport()
    {
        return view('admin.admin_help_support');
    }
}
