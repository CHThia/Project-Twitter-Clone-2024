<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Idea;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Idea $idea){

        //* Like a console log to check it is working
        // dump(request()->all());
        // dd(request()->content);

        $comment = new Comment();
        $comment-> idea_id = $idea->id;

        //* Sample to write the lines of code
        // $comment-> content = request('content')->get();
        // $comment-> content = request()->content;
        $comment-> content = request()->get('content');
        $comment->save();

        return redirect()->route('ideas.show', $idea->id)->with('success', 'Comment posted successfully.');

    }
}
