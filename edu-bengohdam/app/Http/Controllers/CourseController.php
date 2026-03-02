<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // display all courses
    public function index(Request $request)
    {
        $query = Course::where('isAvailable', 1);

        // SEARCH
        if ($request->filled('search')) {
            $query->where('courseName', 'like', '%' . $request->search . '%');
        }

        // sorting/filtering
        switch ($request->sort) {

            case 'latest':
                $query->orderBy('created_at', 'desc');
                break;

            case 'updated':
                $query->orderBy('updated_at', 'desc');
                break;

            case 'short':
                // short learning duration <= 4 weeks
                $query->where('courseDuration', '<=', 4)
                      ->orderBy('courseDuration', 'asc');
                break;

            case 'beginner':
                $query->where('courseLevel', 'Beginner');
                break;

            default:
                // default sort
                $query->orderBy('created_at', 'desc');
                break;
        }

        $courses = $query->paginate(5)->withQueryString();

        return view('learner.view_all_course', compact('courses'));
    }


    // show single course details
    public function show($id)
    {
        $course = Course::findOrFail($id);

        return view('learner.course_details', compact('course'));
    }
}