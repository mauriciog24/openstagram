<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        // User should be authenticated to access this controller
        $this->middleware('auth')->except(['show', 'index']);
    }

    public function index(User $user)
    {
        // Gets the Posts paginated
        $posts = Post::where('user_id', $user->id)->latest()->paginate(20);

        // Redirects to the Dashboard page
        return view('dashboard', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    public function create()
    {
        // Redirect to the Create Post page
        return view('posts.create');
    }

    public function store(Request $request)
    {
        // Form validation
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required',
        ]);

        // Creates the Post attached to the User
        $request->user()->posts()->create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
            'user_id' => auth()->user()->id,
        ]);

        // Redirects to the User Dashboard page
        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post)
    {
        // Redirects to the Post page
        return view('posts.show', [
            'post' => $post,
            'user' => $user,
        ]);
    }

    public function destroy(Post $post)
    {
        // Verify the Delete Policy
        $this->authorize('delete', $post);
        $post->delete();

        $imagePath = public_path('uploads/' . $post->image);

        if (File::exists($imagePath))
        {
            // Delete the Image in public/uploads
            unlink($imagePath);
        }

        // Redirects to the User Dashboard page
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
