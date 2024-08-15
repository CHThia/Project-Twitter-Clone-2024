<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function show(Idea $idea) {
        return view('ideas.show', compact('idea')); // compact('idea) is same as 'idea'=>$idea 
    }


    public function store() {

        // Check idea input has >= 2 chars && <= 500 chars
        request()->validate([
            'idea'=> 'required | min:2 | max:500'
        ]);

        $idea = Idea::create (
            [
                'content'=>request()->get('idea', ''),
            ]
        );
        
        return redirect()->route('dashboard')->with('success', 'Idea created successfully.');

    }

    public function destroy(Idea $idea) {
        
        $idea->delete();

        return redirect()->route('dashboard')->with('success', 'Idea deleted successfully.');

    }
}
