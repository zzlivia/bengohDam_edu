<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommunityStory;
use Illuminate\Http\Request;

class CommunityStoryController extends Controller
{
    // show all stories for admin view
    public function index()
    {
        $stories = CommunityStory::latest()->get();
        return view('admin.story_index', compact('stories'));
    }

    // show create form
    public function create()
    {
        return view('admin.create_story');
    }

    // store new story
    public function store(Request $request)
    {
        $request->validate([
            'community_name'   => 'required|string|max:255',
            'title'            => 'required|string|max:255',
            'community_story'  => 'required',
            'community_image'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $imagePath = null;

        if ($request->hasFile('community_image')) {
            $imagePath = $request->file('community_image')
                ->store('community_stories', 'public');
        }

        CommunityStory::create([
            'community_name'  => $request->community_name,
            'title'           => $request->title,
            'community_story' => $request->community_story,
            'community_image' => $imagePath,
        ]);

        return redirect()->route('admin.stories.index')
            ->with('success', 'Story added successfully!');
    }

    // show edit form
    public function edit($id)
    {
        $story = CommunityStory::findOrFail($id);
        return view('admin.edit_story', compact('story'));
    }

    // update story
    public function update(Request $request, $id)
    {
        $story = CommunityStory::findOrFail($id);

        $request->validate([
            'community_name'   => 'required|string|max:255',
            'title'            => 'required|string|max:255',
            'community_story'  => 'required',
            'community_image'  => 'nullable|image'
        ]);

        if ($request->hasFile('community_image')) {
            $imagePath = $request->file('community_image')
                ->store('community_stories', 'public');

            $story->community_image = $imagePath;
        }

        $story->update([
            'community_name'  => $request->community_name,
            'title'           => $request->title,
            'community_story' => $request->community_story,
        ]);

        return redirect()->route('admin.stories.index')
            ->with('success', 'Story updated successfully!');
    }

    // delete story
    public function destroy($id)
    {
        $story = CommunityStory::findOrFail($id);
        $story->delete();

        return redirect()->route('admin.stories.index')
            ->with('success', 'Story deleted successfully!');
    }
}