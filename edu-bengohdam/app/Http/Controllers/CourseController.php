<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //display all courses
    public function index(Request $request)
    {
        // initialize the query
        $query = Course::where('isAvailable', 1);

        // search feature
        if ($request->search) {
            $query->where('courseName', 'like', '%' . $request->search . '%');
        }

        // handle sorting and filtering logic
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'recent':
                    // sort by the most recently created courses
                    $query->orderBy('created_at', 'desc');
                    break;

                case 'basic_knowledge':
                    // filter for 'Beginner' level courses (assuming 'Beginner' = Basic Knowledge)
                    $query->where('courseLevel', 'Beginner');
                    break;

                case 'short_term':
                    // filter specifically for courses with a '4 Weeks' duration
                    $query->where(function($q) {
                        $q->where('courseDuration', 'like', '1 Week%')
                        ->orWhere('courseDuration', 'like', '2 Week%')
                        ->orWhere('courseDuration', 'like', '3 Week%');
                    });
                    break;

                default:
                    $query->orderBy('courseName', 'asc');
                    break;
            }
        } else {
            // if no sort is selected
            $query->latest();
        }

        // paginate the results
        $courses = $query->paginate(5);

        // return the view with the collection
        return view('learner.view_all_course', compact('courses'));
    }

    //show single course details
    public function show($id)
    {
        $course = Course::findOrFail($id);

        return view('learner.course_details', compact('courses'));
    }
}