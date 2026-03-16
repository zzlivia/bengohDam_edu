<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lecture;
use App\Models\LectureSection;

class LectureSectionController extends Controller
{

    // store uploaded files
    public function store(Request $request)
    {
        $request->validate([
            'lectID' => 'required',
            'section_title' => 'required',
            'section_type' => 'required'
        ]);

        $filePath = null;

        if($request->hasFile('section_file')){
            $filePath = $request->file('section_file')->store('lecture_sections','public');
        }

        LectureSection::create([
            'lectID' => $request->lectID,
            'section_title' => $request->section_title,
            'section_type' => $request->section_type,
            'section_content' => $request->section_content,
            'section_file' => $filePath,
            'section_order' => $request->section_order ?? 1
        ]);

        return redirect()->back()->with('success','Section added successfully');
    }

    // store lecture
    public function storeLecture(Request $request)
    {
        $request->validate([
            'moduleID' => 'required',
            'lectName' => 'required',
            'lect_duration' => 'required'
        ]);

        $lecture = new Lecture();
        $lecture->moduleID = $request->moduleID;
        $lecture->lectName = $request->lectName;
        $lecture->lect_duration = $request->lect_duration;
        $lecture->save();

        return redirect()->back()->with('success','Lecture saved!');
    }
}