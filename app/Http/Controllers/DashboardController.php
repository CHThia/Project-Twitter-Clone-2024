<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use App\Models\Idea;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        //*For preview of email tempate (NOTE - Need to login to see)
        // return new WelcomeEmail(auth()->user());

        $ideas = Idea::orderBy('created_at', 'DESC');
        
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
