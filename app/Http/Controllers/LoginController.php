<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        // Redirects to the Login page
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // Form validation
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Try to authenticate the User
        if (!auth()->attempt($request->only('email', 'password'), $request->remember))
        {
            return back()->with('message', 'Bad credentials');
        }

        // Redirects to the User Dashboard page
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
