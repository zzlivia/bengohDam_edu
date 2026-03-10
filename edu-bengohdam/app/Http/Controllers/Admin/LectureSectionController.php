<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Lecture;
use App\Models\LearningMaterials;
use App\Models\VideoLearning;
use App\Models\PdfLearning;
use App\Models\LectureSection;

class LectureSectionController extends Controller
{

    // STORE LECTURE SECTION (used when adding lesson content later)
    public function store(Request $request)
    {
        $request->validate([
            'lectID' => 'required',
            'section_title' => 'required',
            'section_type' => 'required'
        ]);

        LectureSection::create([
            'lectID' => $request->lectID,
            'section_title' => $request->section_title,
            'section_type' => $request->section_type,
            'section_content' => $request->section_content,
            'section_file' => $request->section_file,
            'section_order' => $request->section_order ?? 1
        ]);

        return redirect()->back()->with('success','Section added successfully');
    }


    // STORE LECTURE (this is what your form should call)
    public function storeLecture(Request $request)
    {
        $request->validate([
            'moduleID' => 'required',
            'lectName' => 'required',
            'lect_duration' => 'required'
        ]);

        DB::beginTransaction();

        try {

            // Create Lecture
            $lecture = new Lecture();
            $lecture->moduleID = $request->moduleID;
            $lecture->lectName = $request->lectName;
            $lecture->lect_duration = $request->lect_duration;
            $lecture->save();


            // Create Learning Material parent
            $material = new LearningMaterials();
            $material->lectID = $lecture->lectID; // use correct PK
            $material->learningMaterialTitle = $request->lectName;
            $material->learningMaterialType = 'composite';
            $material->save();


            // Optional Video
            if ($request->video_path) {
                VideoLearning::create([
                    'videoLearningName' => $request->lectName . " Video",
                    'videoLearningPath' => $request->video_path,
                    'learningMaterialID' => $material->id
                ]);
            }


            // Optional PDF
            if ($request->hasFile('pdf_file')) {

                $path = $request->file('pdf_file')->store('course_pdfs', 'public');

                PdfLearning::create([
                    'pdfLearningName' => $request->lectName . " PDF",
                    'pdfLearningPath' => $path,
                    'learningMaterialID' => $material->id
                ]);
            }


            DB::commit();

            return redirect()->back()->with('success', 'Lecture created successfully!');

        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}