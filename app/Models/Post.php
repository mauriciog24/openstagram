<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'user_id',
    ];

    public function user()
    {
        // Returns the User associated with a Post
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }

    public function comments()
    {
        // Return the Comments associated with a Post
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        // Returns the Likes associated with a Post
        return $this->hasMany(Like::class);
    }

    public function checkLike(User $user)
    {
        // Check if a specific User already liked a Post
        return $this->likes->contains('user_id', $user->id);
    }
}
