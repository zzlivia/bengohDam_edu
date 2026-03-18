<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Module;
use App\Models\Progress;
use App\Models\Lecture;
use App\Models\LectureSection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)// display all courses with search, filter, sort, pagination
    {
        $query = Course::where('isAvailable', 1);
        // search
        if ($request->filled('search')) {
            $query->where('courseName', 'like', '%' . $request->search . '%');
        }
        // filter by category
        if ($request->filled('category')) {
            $query->where('courseCategory', $request->category);
        }
        // filter by level
        if ($request->filled('level')) {
            $query->where('courseLevel', $request->level);
        }
        // filter by duration
        if ($request->filled('duration')) {
            $query->where('courseDuration', '<=', $request->duration);
        }
        //sorting
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
        $courses = $query->paginate(5)->withQueryString(); //display 5 courses per page
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

    public function show($id) // show single course details with relationship
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
    
    public function startLearning($id) //redirect user to start learning interface
    {
        $course = Course::with([
            'modules.mcqs',
            'modules.lectures.sections',
            'modules.lectures.materials.video',
            'modules.lectures.materials.pdf'
        ])->findOrFail($id);

        // get first module
        $module = $course->modules->first();
        // get first lecture
        $lecture = $module ? $module->lectures->first() : null;
        // get first section
        $section = $lecture ? $lecture->sections->first() : null;

        return view('learner.startlearning', compact('course','module','lecture','section'));
    }
    
    public function showQuiz($id) //display MCQs
    {
        $module = Module::with('mcqs.answers')->findOrFail($id);
        return view('learner.module_question', compact('module'));
    }

    public function showModuleQuestions($id) //duplication as above
    {
        $module = Module::with('mcqs.answers')->findOrFail($id);
        return view('learner.module_question', compact('module'));
    }
    
    public function submitModuleQuestions(Request $request, $id) //submit mcqs answer and calculate score
    {
        $module = Module::with('mcqs.answers')->findOrFail($id);
        $score = 0;
        $total = $module->mcqs->count();
        foreach ($module->mcqs as $question) {
            $selectedAnswer = $request->input('question_' . $question->moduleQs_ID); //get selected answer from form
            if ($selectedAnswer) {
                $correctAnswer = $question->answers //find correct answer
                    ->where('ansCorrect', 1)
                    ->first();
                if ($correctAnswer && $correctAnswer->ansID == $selectedAnswer) { //compare selected answer
                    $score++;
                }
            }
        }
        return back()->with('result', "You scored $score / $total"); //return result
    }

    public function courseFeedback($id) //show feedback form
    {
        $course = Course::with([
            'modules.lectures.mcqs'
        ])->findOrFail($id);

        return view('learner.course_feedback', compact('course'));
    }

    public function submitFeedback(Request $request) //handle submission of feedback
    {
        return redirect()->back()->with('success','Thank you for your feedback!');
    }

    public function courseAssessment($id) //course assessment page
    {
        $course = Course::findOrFail($id);

        return view('learner.courseAssessment', compact('course'));
    }

    //update user progress auto when a user finishes MCQ or assessment given
    public function updateProgress($courseID, $activity)
    {
        $progressMap = [
            'MCQ1' => 20,
            'MCQ2' => 40,
            'MCQ3' => 60,
            'MCQ4' => 80,
            'ASSESSMENT' => 100
        ];
        $percentage = $progressMap[$activity] ?? 0;
        //update or create user progress record
        Progress::updateOrCreate(
            [
                'userID' => Auth::id(),
                'courseID' => $courseID,
                'progressName' => $activity
            ],
            [
                'progressStatus' => 'completed',
                'completionProgress' => $percentage
            ]
        );
    }

    public function progress($courseID) //show user's progress
    {
        $progress = Progress::where('userID', Auth::id())
                    ->where('courseID', $courseID)
                    ->get(); //return all progress records

        return view('learner.course_progress', compact('progress'));
    }
    
    public function leaderboard()   //only registered users can view top learners
    {
        $learners = DB::table('userprogress')
            ->join('users', 'userprogress.userID', '=', 'users.id')
            ->select(
                'users.name',
                DB::raw('COUNT(DISTINCT userprogress.courseID) as completed_courses')
            )
            ->where('userprogress.progressStatus', 'completed')
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('completed_courses')
            ->get();

        return view('courses.leaderboards', compact('learners'));
    }

    public function create() //allow admin to load data 
    {
        $courses = Course::all();
        $modules = Module::with('course')->get();
        $lectures = Lecture::with('module')->get();
        $sections = LectureSection::with('lecture')->orderBy('section_order')->get();

        return view('admin.add_course_module', compact(
            'courses',
            'modules',
            'lectures',
            'sections'
        ));
    }
    
    public function lectureStore(Request $request)  //store new lecture
    {
        //validate input
        $request->validate([
            'lectID' => 'required|unique:lectures,lectID',
            'moduleID' => 'required|exists:modules,moduleID',
            'lectName' => 'required|string|max:255',
            'lect_duration' => 'required|integer',
        ]);

        //create lecture
        Lecture::create([
            'lectID'        => $request->lectID,
            'moduleID'      => $request->moduleID,
            'lectName'      => $request->lectName,
            'lect_duration' => $request->lect_duration,
        ]);

        return redirect()->back()->with('success', 'Lecture added successfully!');
    }
}