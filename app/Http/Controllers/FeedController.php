<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $followingIDs = auth()->user()->followings()->pluck('user_id');

        // dd($followingIDs);
        
        //* orderBy('created_at', 'DESC') = latest() 
        $ideas = Idea::whereIn('user_id', $followingIDs)->latest();

        
        //Search on specific text when there is a search request
        if(request()->has('search')) {
            $ideas = $ideas->where('content', 'like' , '%'. request()->get('search', '') . '%');
        }

        return view('dashboard', 
            [ 
                'ideas'=> $ideas->paginate(5)
            ]
        );
    }
}
