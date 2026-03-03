<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommunityStory;
use Illuminate\Http\Request;

class CommunityStoryController extends Controller
{
    public function create()
    {
        return view('admin.create_story');
    }

    public function store(Request $request)
    {
        $request->validate([
            'community_name' => 'required',
            'title' => 'required',
            'community_story' => 'required',
            'community_image' => 'nullable|image'
        ]);

        $imagePath = null;

        if ($request->hasFile('community_image')) {
            $imagePath = $request->file('community_image')
                ->store('community_stories', 'public');
        }

        CommunityStory::create([
            'community_name' => $request->name,
            'title' => $request->title,
            'community_story' => $request->story,
            'community_image' => $imagePath
        ]);

        return redirect()->back()->with('success', 'Story added successfully!');
    }
}