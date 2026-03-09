<?php

namespace App\Http\Controllers;

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
            'moduleID'   => 'required|unique:modules,moduleID',
            'moduleName' => 'required|string|max:255',
            'courseID'   => 'required|exists:courses,id', // or courseID depending on your PK
        ]);

        Module::create($request->all());

        return redirect()->route('admin.course.module')
                         ->with('success', 'Module created successfully!');
    }
}