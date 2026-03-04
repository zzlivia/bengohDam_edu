<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LectureSection;
use Illuminate\Http\Request;

class LectureSectionController extends Controller
{
    public function store(Request $request)
    {
        LectureSection::create([
            'lectID' => $request->lectID,
            'section_title' => $request->section_title,
            'section_type' => $request->section_type,
            'section_content' => $request->section_content,
            'section_file' => $request->section_file,
            'section_order' => $request->section_order
        ]);

        return redirect()->back()->with('success','Section added successfully');
    }
}
