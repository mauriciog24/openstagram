<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function store()
    {
        // Logout the User
        auth()->logout();

        // Redirects to the Login page
        return redirect()->route('login');
    }
}
