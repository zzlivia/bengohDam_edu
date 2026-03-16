<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Module;
use App\Models\Lecture;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function create()
    {
        // Fetch all courses so the admin can link the module to one
        $courses = Course::all(); 
        
        return view('admin.modules.create_module', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'moduleName' => 'required|string|max:255',
            'courseID' => 'required|exists:course,courseID'
        ]);

        Module::create([
            'moduleName' => $request->moduleName,
            'courseID' => $request->courseID
        ]);

        return redirect()->route('admin.course.module')
            ->with('success', 'Module added successfully!');
    }

    public function courseModule()
    {
        $courses = Course::all();
        $modules = Module::with('course')->get();
        $lectures = Lecture::with('module')->get();

        return view('admin.add_course_module', compact('courses','modules','lectures'));
    }

    // module section

    public function editModule($id)
    {
        $module = Module::where('moduleID', $id)->firstOrFail();
        $courses = Course::all();

        return view('admin.editModule', compact('module','courses'));
    }

    public function deleteModule($id)
    {
        Module::where('moduleID', $id)->delete();

        return redirect()->back()->with('success','Module deleted successfully');
    }


    // lecture section

    public function editLecture($id)
    {
        $lecture = Lecture::where('lectID', $id)->firstOrFail();
        $modules = Module::all();

        return view('admin.editLecture', compact('lecture','modules'));
    }

    public function deleteLecture($id)
    {
        Lecture::where('lectID', $id)->delete();

        return redirect()->back()->with('success','Lecture deleted successfully');
    }
}