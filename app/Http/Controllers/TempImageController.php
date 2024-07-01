<?php


namespace App\Http\Controllers;

use App\Models\TempImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class TempImageController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|max:2048', // max:2048 limits file size to 2MB
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Please fix errors',
                'errors' => $validator->errors()
            ]);
        }

        try {
            // Upload image
            $path = $request->file('image')->store('images', 'public');

            // Save image info to database
            $image = new TempImage();
            $image->path = $path; // Store path to retrieve image later
            $image->name = $request->file('image')->getClientOriginalName(); // Store original file name
            $image->save();

            // Prepare response data
            $responseData = [
                'id' => $image->id,
                'name' => $image->name,
                'created_at' => $image->created_at->toDateTimeString(),
                'updated_at' => $image->updated_at->toDateTimeString(),
            ];

            return response()->json([
                'status' => true,
                'message' => 'Image uploaded successfully.',
                'image' => $responseData
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Image upload failed.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
