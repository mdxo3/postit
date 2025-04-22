<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
{
    $sort = request('sort', 'desc'); // default is 'desc' (newest first)

    $posts = Post::orderBy('created_at', $sort)->get();

    return view('home', compact('posts'));
}


    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        Post::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('home')->with('success', 'Post created successfully!');
    }
}
