<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Module;
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

        // FILTER: Category
        if ($request->filled('category')) {
            $query->where('courseCategory', $request->category);
        }

        // FILTER: Level
        if ($request->filled('level')) {
            $query->where('courseLevel', $request->level);
        }

        // FILTER: Duration
        if ($request->filled('duration')) {
            $query->where('courseDuration', '<=', $request->duration);
        }

        // SORTING
        switch ($request->sort) {
            case 'latest':
                $query->orderBy('created_at', 'desc');
                break;

            case 'updated':
                $query->orderBy('updated_at', 'desc');
                break;

            case 'short':
                $query->where('courseDuration', '<=', 4);
                break;

            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $courses = $query->paginate(5)->withQueryString();


        //for dropdowns

        $categories = Course::where('isAvailable', 1)
            ->whereNotNull('courseCategory')
            ->select('courseCategory')
            ->distinct()
            ->orderBy('courseCategory')
            ->pluck('courseCategory');

        $levels = Course::where('isAvailable', 1)
            ->whereNotNull('courseLevel')
            ->select('courseLevel')
            ->distinct()
            ->orderBy('courseLevel')
            ->pluck('courseLevel');

        $durations = Course::where('isAvailable', 1)
            ->whereNotNull('courseDuration')
            ->select('courseDuration')
            ->distinct()
            ->orderBy('courseDuration')
            ->pluck('courseDuration');


        return view('learner.view_all_course', compact(
            'courses',
            'categories',
            'levels',
            'durations'
        ));
    }

    // show single course details
    public function show($id)
    {
        $course = Course::with([
            'modules.lectures.materials.video',
            'modules.lectures.materials.pdf',
            'modules.enrolment',
            'modules.lectures',
            'modules.lectures.mcqs',
            'modules.lectures.mcqs.answers'
        ])->findOrFail($id);

        return view('learner.view_course', compact('course'));
    }
    
    //redirect user to start learning interface
    public function startLearning($id)
    {
        $course = Course::with([
            'modules.lectures.materials.video',
            'modules.lectures.materials.pdf'
        ])->findOrFail($id);

        return view('learner.startlearning', compact('course'));
    }
    
    //display questions
    public function showQuiz($id)
    {
        $module = \App\Models\Module::with('mcqs.answers')
                    ->findOrFail($id);

        return view('learner.module_question', compact('module'));
    }

    public function showModuleQuestions($id)
    {
        $module = Module::with('mcqs.answers')
                    ->findOrFail($id);

        return view('learner.module_question', compact('module'));
    }
    
    public function submitModuleQuestions(Request $request, $id)
    {
        $module = Module::with('mcqs.answers')->findOrFail($id);
        $score = 0;
        $total = $module->mcqs->count();
        foreach ($module->mcqs as $question) {
            $selectedAnswer = $request->input('question_' . $question->moduleQs_ID);
            if ($selectedAnswer) {
                $correctAnswer = $question->answers
                    ->where('ansCorrect', 1)
                    ->first();
                if ($correctAnswer && $correctAnswer->ansID == $selectedAnswer) {
                    $score++;
                }
            }
        }
        return back()->with('result', "You scored $score / $total");
    }
}