<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DashboardController extends Controller
{
    use AuthorizesRequests;


    public function index()
    {
        //* both lines of codes check if user is admin
        // $this->authorize('admin)

        // if(Gate::denies('admin')) {
        //     abort(403);
        // }

        return view('admin.dashboard');
    }
}
