<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        // User should be authenticated to access this controller
        $this->middleware('auth');
    }

    public function __invoke()
    {
        // Gets the ids of the following Users
        $ids = auth()->user()->followings->pluck('id')->toArray();

        // Gets the Posts of the following Users
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);

        // Redirects to the Home page
        return view('home', [
            'posts' => $posts,
        ]);
    }
}
