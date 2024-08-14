<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
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
}
