<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function __construct()
    {
        // User should be authenticated to access this controller
        $this->middleware('auth');
    }

    public function index()
    {
        // Redirects to the Edit Profile page
        return view('profile.index');
    }

    public function store(Request $request)
    {
        // Transforms the username in order to have a valid url
        $request->request->add(['username' => Str::slug($request->username)]);

        // Form validation
        $this->validate($request, [
            'username' => [
                'required',
                'unique:users,username,' . auth()->user()->id,
                'min:3',
                'max:20',
                'not_in:register,login,logout,edit-profile,images,posts'
            ],
        ]);

        if ($request->image)
        {
            // Stores the image in public/profiles/

            $image = $request->file('image');

            $imageName = Str::uuid() . '.' . $image->extension();

            $storedImage = Image::make($image);
            $storedImage->fit(1000, 1000);

            $imagePath = public_path('profiles') . '/' . $imageName;
            $storedImage->save($imagePath);
        }

        $user = User::find(auth()->user()->id);

        $user->username = $request->username;
        $user->image = $imageName ?? auth()->user()->image ?? null;

        // Updates the User in the database
        $user->save();

        // Redirects to the User Dashboard page
        return redirect()->route('posts.index', $user->username);
    }
}
