<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Course;
use App\Models\Module;
use App\Models\Lecture;
use App\Models\Progress;
use App\Models\Announcements;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{

    // calculate the number of users in user table
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalCourses = Course::count();
        $totalModules = Module::count();
        $totalLectures = Lecture::count();

        // announcements
        $announcements = Announcements::orderBy('created_at', 'desc')
                        ->take(4)
                        ->get();

        // most taken courses
        $courseStats = DB::table('enrolmentcoursemodules')
            ->join('course', 'enrolmentcoursemodules.courseID', '=', 'course.courseID')
            ->select('course.courseName', DB::raw('COUNT(DISTINCT enrolmentcoursemodules.userID) as total'))
            ->groupBy('course.courseName')
            ->orderByDesc('total')
            ->take(5)
            ->get();

                                                            /* summary of resources */

        // recently uploaded material
        $recentMaterial = DB::table('learningmaterials')
            ->orderByDesc('created_at')
            ->first();

        // most recent uploaded PDF
        $recentPdf = DB::table('pdflearning')
            ->join('learningmaterials','pdflearning.learningMaterialID','=','learningmaterials.learningMaterialID')
            ->select('learningmaterials.learningMaterialTitle')
            ->orderByDesc('learningmaterials.created_at')
            ->first();

        // most recent video learning uploaded
        $recentVideo = DB::table('videolearning')
            ->join('learningmaterials','videolearning.learningMaterialID','=','learningmaterials.learningMaterialID')
            ->select('learningmaterials.learningMaterialTitle')
            ->orderByDesc('learningmaterials.created_at')
            ->first();

        // unused materials
        $unusedMaterials = DB::table('learningmaterials')
            ->whereNull('lectID')
            ->count();

                                                                                        /* pie chart */

        // completed modules
        $completedModules = DB::table('enrolmentcoursemodules')
            ->where('isCompleted', 1)
            ->count();

        // total pdf learning materials
        $pdfMaterials = DB::table('pdflearning')->count();

        // total video learning materials
        $videoMaterials = DB::table('videolearning')->count();

        return view('admin.admin_dashboard', compact(
            'totalUsers',
            'totalCourses',
            'totalModules',
            'totalLectures',
            'announcements',
            'courseStats',
            'completedModules',
            'pdfMaterials',
            'videoMaterials',
            'recentMaterial',
            'recentPdf',
            'recentVideo',
            'unusedMaterials'
        ));
    }

    public function userManagement(Request $request)
    {
        $search = $request->search;

        // summary cards
        $totalUsers = DB::table('user')->count();
        $newUsers = DB::table('user')
            ->whereDate('userID', '>=', now()->subDays(7)) // placeholder if no created_at
            ->count();
        $activeUsers = DB::table('enrolmentcoursemodules')
            ->where('inProgress', 1)
            ->distinct('userID')
            ->count('userID');
        // user table
        $users = DB::table('user')
            ->leftJoin('enrolmentcoursemodules', 'user.userID', '=', 'enrolmentcoursemodules.userID')
            ->when($search, function ($query, $search) {
                return $query->where('user.userName', 'like', "%$search%");
            })
            ->select(
                'user.userID',
                'user.userName as name',
                'user.userEmail as email',
                DB::raw('COUNT(CASE WHEN enrolmentcoursemodules.inProgress = 1 THEN 1 END) as engagement'),
                DB::raw('COUNT(CASE WHEN enrolmentcoursemodules.isCompleted = 1 THEN 1 END) as completedCourses')
            )
            ->groupBy('user.userID', 'user.userName', 'user.userEmail')
            ->get();

        return view('admin.user_management', compact(
            'users',
            'totalUsers',
            'newUsers',
            'activeUsers'
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
        // fetch both courses and modules
        $courses = Course::all(); 
        $modules = Module::all();

        // pass both variables to the view
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
        $totalProgress = Progress::count();

        $notStarted = Progress::where('progressStatus', 'Not Started')->count();
        $inProgress = Progress::where('progressStatus', 'In Progress')->count();
        $completed = Progress::where('progressStatus', 'Completed')->count();

        $notStartedPercent = $totalProgress > 0 ? round(($notStarted / $totalProgress) * 100) : 0;
        $inProgressPercent = $totalProgress > 0 ? round(($inProgress / $totalProgress) * 100) : 0;
        $completedPercent = $totalProgress > 0 ? round(($completed / $totalProgress) * 100) : 0;

        return view('admin.progress', compact(
            'notStartedPercent',
            'inProgressPercent',
            'completedPercent'
        ));
    }

    public function announcements()
    {
        //newest announcements always appear first
        $announcements = DB::table('announcements')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.announcements', compact('announcements')); //retrieve
    }

    public function createAnnouncement()
    {
        return view('admin.create_announcement');
    }

    public function storeAnnouncement(Request $request)
    {
        DB::table('announcements')->insert([
            'announcementTitle' => $request->announcementTitle,
            'announcementDetails' => $request->announcementDetails,
            'adminID' => Auth::id(),   // get logged in admin ID
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('admin.announcements')
            ->with('success', 'Announcement added successfully!');
    }

    public function viewAnnouncement($id)
    {
        $announcement = Announcements::where('announcementID', $id)->first();
        return view('admin.viewAnnouncement', compact('announcement'));
    }

    public function reviewAnnouncement($id)
    {
        $announcement = Announcements::where('announcementID', $id)->first();
        return view('admin.reviewAnnouncement', compact('announcement'));
    }

    public function editAnnouncement($id)
    {
        $announcement = Announcements::where('announcementID', $id)->first();
        return view('admin.editAnnouncement', compact('announcement'));
    }

    public function updateAnnouncement(Request $request, $id)
    {
        $announcement = Announcements::findOrFail($id);

        $announcement->announcementTitle = $request->announcementTitle;
        $announcement->announcementDetails = $request->announcementDetails;

        $announcement->save();

        return redirect()->route('announcements')
            ->with('success', 'Announcement updated successfully.');
    }
    
    public function reports()
    {

        // total registered users
        $totalUsers = DB::table('user')->count();

        // new users per month
        $newUsers = DB::table('user')
            ->whereMonth('created_at', now()->month)
            ->count();

        // active users (authenticated = 1)
        $activeUsers = DB::table('user')
            ->where('authenticated', 1)
            ->count();

        // inactive users
        $inactiveUsers = DB::table('user')
            ->where('authenticated', 0)
            ->count();

        // guest users by session
        $guestUsers = 0;

        // course & module
        $courseModules = DB::table('course')
            ->join('module', 'course.courseID', '=', 'module.courseID')
            ->select(
                'course.courseName',
                'module.moduleName',
                DB::raw('COUNT(enrolmentcoursemodules.userID) as enrolled'),
                DB::raw('SUM(enrolmentcoursemodules.isCompleted) as completed'),
                DB::raw('SUM(enrolmentcoursemodules.inProgress) as in_progress')
            )
            ->leftJoin('enrolmentcoursemodules', 'module.moduleID', '=', 'enrolmentcoursemodules.moduleID')
            ->groupBy('course.courseName','module.moduleName')
            ->get();

        return view('admin.reports', compact(
            'totalUsers',
            'newUsers',
            'activeUsers',
            'inactiveUsers',
            'guestUsers',
            'courseModules'
        ));
    }

    public function reportOverview()
    {

        // Total users
        $totalUsers = User::count();

        // New users (registered this month)
        $newUsers = User::whereMonth('created_at', now()->month)->count();

        // Active users (example: users that logged in)
        $activeUsers = User::where('status', 'active')->count();

        // Inactive users
        $inactiveUsers = User::where('status', 'inactive')->count();

        // Guess / unregistered access (if you track visitors)
        $guestUsers = 0;

        // Course & Module Performance
        $courseModules = DB::table('course')
            ->join('module', 'course.courseID', '=', 'module.courseID')
            ->select(
                'course.courseName',
                'module.moduleName',
                DB::raw('0 as enrolled'),
                DB::raw('0 as completed'),
                DB::raw('0 as in_progress')
            )
            ->get();

        return view('admin.reportOverview', compact(
            'totalUsers',
            'newUsers',
            'activeUsers',
            'inactiveUsers',
            'guestUsers',
            'courseModules'
        ));
    }

    public function downloadReport()
    {

        $totalUsers = DB::table('user')->count();
        // new user recent register
        $newUsers = DB::table('user')
            ->whereDate('created_at', today())
            ->count();


        // active user define by authenticated attribute
        $activeUsers = DB::table('user')
            ->where('authenticated', 1)
            ->count();

        // inactive users define by authenticated attribute
        $inactiveUsers = DB::table('user')
            ->where('authenticated', 0)
            ->count();

        // guest users store by session
        $guestUsers = 0;

        // course and module
        $courseModules = DB::table('module')
            ->join('course','module.courseID','=','course.courseID')
            ->leftJoin('enrolmentcoursemodules','module.moduleID','=','enrolmentcoursemodules.moduleID')
            ->select(
                'course.courseName',
                'module.moduleName',

                DB::raw('COUNT(enrolmentcoursemodules.userID) as enrolled'),

                DB::raw('SUM(enrolmentcoursemodules.isCompleted = 1) as completed'),

                DB::raw('SUM(enrolmentcoursemodules.inProgress = 1) as in_progress')
            )
            ->groupBy('module.moduleID','course.courseName','module.moduleName')
            ->get();

        $assessmentReport = DB::table('mcqs')
            ->join('module','mcqs.moduleID','=','module.moduleID')
            ->select(
                'module.moduleName',
                DB::raw('COUNT(mcqs.moduleQs_ID) as totalAssessment')
            )
            ->groupBy('module.moduleName')
            ->get();

        $data = compact(
            'totalUsers',
            'newUsers',
            'activeUsers',
            'inactiveUsers',
            'guestUsers',
            'courseModules',
            'assessmentReport'
        );
        $pdf = Pdf::loadView('admin.reportPDF',$data);
        return $pdf->download('system_report.pdf');
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
