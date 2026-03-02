<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //display all courses
    public function index(Request $request)
    {
        $query = Course::where('isAvailable', 1);

        // Optional Search Feature
        if ($request->search) {
            $query->where('courseName', 'like', '%' . $request->search . '%');
        }

        $courses = $query->paginate(5);

        return view('learners.view_all_course', compact('courses'));
    }

    //show single course details
    public function show($id)
    {
        $course = Course::findOrFail($id);

        return view('learners.course_details', compact('courses'));
    }
}