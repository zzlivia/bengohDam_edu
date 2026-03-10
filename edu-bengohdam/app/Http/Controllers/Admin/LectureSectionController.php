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

    public function storeLecture(Request $request)
    {
        DB::beginTransaction();

        try {
            // create the base Lecture
            $lecture = new Lecture(); //name of model
            $lecture->moduleID = $request->moduleID;
            $lecture->lectName = $request->lectName;
            $lecture->lect_duration = $request->lect_duration;
            $lecture->save();

            // create the parent, Learning Material record
            $material = new LearningMaterials(); //name of model
            $material->lectID = $lecture->id;
            $material->learningMaterialTitle = $request->lectName;
            $material->learningMaterialType = 'composite'; 
            $material->save();

            // handle video (if URL/Path provided)
            if ($request->video_path) {
                VideoLearning::create([
                    'videoLearningName' => $request->lectName . " Video",
                    'videoLearningPath' => $request->video_path,
                    'learningMaterialID' => $material->id
                ]);
            }

            // 4. Handle PDF (if file uploaded)
            if ($request->hasFile('pdf_file')) {
                $path = $request->file('pdf_file')->store('course_pdfs', 'public');
                PdfLearning::create([
                    'pdfLearningName' => $request->lectName . " PDF",
                    'pdfLearningPath' => $path,
                    'learningMaterialID' => $material->id
                ]);
            }

            // 5. Save the "Lesson Overview" Text into Lecture Sections
            LectureSection::create([
                'lectID' => $lecture->id,
                'section_title' => 'Lesson Overview',
                'section_type' => 'text',
                'section_content' => $request->lesson_content, // The long text from your screenshot
                'section_order' => 1
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Lecture created successfully!');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
