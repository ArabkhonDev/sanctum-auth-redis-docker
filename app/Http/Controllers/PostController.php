<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
        // Cache::store('redis')->put('test_key', 'Hello, Redis!', 60);
        // $value = Cache::store('redis')->get('test_key');
        // dd($value);
        $posts = Cache::store('redis')->remember('posts', 60, function () {
            return Post::latest()->get();
        });

        return response()->json([
            'data'=> $posts,
        ]);
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
        $post = Post::create($request->all());

        Cache::store('redis')->forget('posts'); // Postlar keshi tozalanadi

        return response()->json($post);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Cache::store('redis')->remember("post_{$id}", 30, function () use ($id) {
            return Post::findOrFail($id);
        });

        return response()->json($post);
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
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
