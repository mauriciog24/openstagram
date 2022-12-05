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
        $this->middleware('auth');
    }

    public function index()
    {
        return view('profile.index');
    }

    public function store(Request $request)
    {
        $request->request->add(['username' => Str::slug($request->username)]);

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

        $user->save();

        return redirect()->route('posts.index', $user->username);
    }
}
