<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $image = $request->file('file');

        // Creates a unique name for the Image
        $imageName = Str::uuid() . '.' . $image->extension();

        $storedImage = Image::make($image);
        $storedImage->fit(1000, 1000);

        // Stores the Image in public/uploads/
        $imagePath = public_path('uploads') . '/' . $imageName;
        $storedImage->save($imagePath);

        // Returns the assigned Image name
        return response()->json(['image' => $imageName]);
    }
}
