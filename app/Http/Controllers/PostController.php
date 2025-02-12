<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // create a resource and return it
        $posts = Post::orderBy('created_at', 'DESC')->get();
        return PostResource::collection($posts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // when I have user login working
        // I can use that for user_id
        $data = $request->validate([
          'title' => ['required', 'string'],
          'body' => ['required', 'string'],
          'user_id' => ['required', 'numeric'],
        ]);

        Post::create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
      return PostResource::make($post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
    }
}
