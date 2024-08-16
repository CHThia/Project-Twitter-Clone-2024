<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function show(Idea $idea)
    {
        //* Relationship between Idea and Comment
        // dd($idea->comments); 

        return view('ideas.show', compact('idea')); // compact('idea) is same as 'idea'=>$idea
    }

    public function store()
    {
        // Check idea input has >= 2 chars && <= 500 chars
        request()->validate([
            'content' => 'required | min:2 | max:500',
        ]);

        $idea = Idea::create([
            'content' => request()->get('content', ''),
        ]);

        return redirect()->route('dashboard')->with('success', 'Idea created successfully.');
    }

    public function destroy(Idea $idea)
    {
        $idea->delete();

        return redirect()->route('dashboard')->with('success', 'Idea deleted successfully.');
    }

    public function edit(Idea $idea)
    {
        $editing = true;

        return view('ideas.show', compact('idea', 'editing'));
    }

    public function update(Idea $idea)
    {
        request()->validate([
            'content' => 'required | min:2 | max:500',
        ]);

        $idea->content = request()->get('content', '');
        $idea->save();

        return redirect()
            ->route('ideas.show', $idea->id)
            ->with('success', 'Idea updated successfully.');
    }
}
