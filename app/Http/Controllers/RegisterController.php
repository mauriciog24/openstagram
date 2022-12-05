<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        // Redirects to the Register page
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Transforms the username in order to have a valid url
        $request->request->add(['username' => Str::slug($request->username)]);

        // Form validation
        $this->validate($request, [
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6',
        ]);

        // Creates the User in the database
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Authenticate the User
        auth()->attempt($request->only('email', 'password'));

        // Redirects to the User Dashboard page
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
