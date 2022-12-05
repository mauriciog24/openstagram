<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, User $user, Post $post)
    {
        // Form validation
        $this->validate($request, [
            'comment' => 'required|max:255',
        ]);

        // Create Comment
        Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comment' => $request->comment,
        ]);

        // Redirect to the previous page with Successful message
        return back()->with('message', 'Successful comment');
    }
}
