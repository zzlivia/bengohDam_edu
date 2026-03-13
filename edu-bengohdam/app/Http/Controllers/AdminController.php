<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Course;
use App\Models\Module;
use App\Models\Lecture;
use App\Models\LearningMaterials;
use App\Models\VideoLearning;
use App\Models\PdfLearning;
use App\Models\LectureSection;
use App\Models\Announcements;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    // calculate the number of users in user table
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalCourses = Course::count();
        $totalModules = Module::count();
        $totalLectures = Lecture::count();

        // get latest 4 announcements
        $announcements = Announcements::orderBy('created_at', 'desc')
                        ->take(4)
                        ->get();

        return view('admin.admin_dashboard', compact(
            'totalUsers',
            'totalCourses',
            'totalModules',
            'totalLectures',
            'announcements'
        ));
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

    public function createCourseModule()
    {
        // Fetch both courses and modules
        $courses = Course::all(); 
        $modules = Module::all(); // <--- Add this line

        // Pass both variables to the view
        return view('admin.add_course_module', compact('courses', 'modules'));
    }

    public function storeCourse(Request $request)
    {
        $request->validate([
            'courseCode' => 'required',
            'courseName' => 'required',
            'courseAuthor' => 'required',
            'courseLevel' => 'required'
        ]);
        $course = new Course();
        $course->courseCode = $request->courseCode;
        $course->courseName = $request->courseName;
        $course->courseAuthor = $request->courseAuthor;
        $course->courseDesc = $request->courseDesc;
        $course->courseCategory = $request->courseCategory;
        $course->courseLevel = $request->courseLevel;
        $course->courseDuration = $request->courseDuration;
        $course->isAvailable = $request->isAvailable;
        if ($request->hasFile('courseImg')) {
            $image = $request->file('courseImg')->store('courses', 'public');
            $course->courseImg = $image;
        }
        $course->save();

        return redirect()->route('admin.course.module')
            ->with('success', 'Course added successfully!');
    }

    public function updateCourse(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $course->courseCode = $request->courseCode;
        $course->courseName = $request->courseName;
        $course->courseAuthor = $request->courseAuthor;
        $course->courseDesc = $request->courseDesc;
        $course->courseCategory = $request->courseCategory;
        $course->courseLevel = $request->courseLevel;
        $course->courseDuration = $request->courseDuration;
        $course->save();

        return redirect()->route('admin.course.module')
            ->with('success','Course updated successfully');
    }
    public function editCourse($id)
    {
        $course = Course::findOrFail($id);
        return view('admin.edit_course_module', compact('course'));
    }

    public function deleteCourse($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('admin.course.module')
            ->with('success','Course deleted successfully');
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
