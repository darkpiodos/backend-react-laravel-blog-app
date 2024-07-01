<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    //This method will return all blogs
    public function index(){

    }
    //This method witll return a single blog
    public function show(){

    }
    //This funtion will store a blog
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'title' => 'required|min:10',
            'author' => 'required|min:3',
            'description' => 'nullable|string',
            'shortDesc' => 'nullable|string'
        ]);

        if($validator ->fails()){
            return response()->json([
                'status'=> false,
                'message'=> 'Please fix the errors',
                'errors'=> $validator->errors()
            ],422);
        }

        $blog = new Blog();
        $blog->title =$request->title;
        $blog->author =$request->author;
        $blog->description = $request->description ?? null; // Handle nullable fields
        $blog->shortDesc = $request->shortDesc ?? null; // Handle nullable fields
        $blog->save();

        return response()->json([
            'status'=> true,
            'message'=> 'Blog added successfully',
            'data'=> $blog
        ]);

        }

    //this method will update a blog
    public function update(){

    }

    public function delete(){

    }
}
