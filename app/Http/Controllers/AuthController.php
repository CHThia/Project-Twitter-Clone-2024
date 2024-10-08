<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store()
    {
        $validated = request()->validate([
            'name' => 'required|min:3|max:40',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:3',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Mail::to($user->email)->send(new WelcomeEmail($user));

        return redirect()->route('dashboard')->with('success', 'Account created Successfully!');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate()
    {
        // dd(request()->all());

        $validated = request()->validate([
            'email' => 'required|email',
            'password' => 'required|min:3',
        ]);

        if (Auth::attempt($validated)) {
            request()->session()->regenerate();

            return redirect()->route('dashboard')->with('success', 'Logged in successfully.');
        }
        
        //* Refractor code to check if 1 or 2 is incorrect -- 28 Aug 2024
        return redirect()
            ->route('login')
            ->withErrors([
                'email' => 'Please check if email is correct.',
                'password' => 'Please check if password is correct.'
        ]);
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('dashboard')->with('succcess', 'Logged out successfully.');
    }
}
