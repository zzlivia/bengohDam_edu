<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Module;
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
}