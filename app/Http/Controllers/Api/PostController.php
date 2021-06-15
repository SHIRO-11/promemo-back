<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Log;
use Auth;

class PostController extends Controller
{
    public function index()
    {
        return Post::all();
    }

    public function store(Request $request)
    {
        Log::debug($request);

        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = Auth::guard('sanctum')->user()->id;
        $post->save();

        $post->categories()->sync($request->categories);

        return response()->json([
            'post'=>$post
        ]);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);

        return response()->json([
            'post' => $post
        ]);
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return response()->json([
            'post' => $post,
            'categories'=>$post->categories()->pluck('categories.id')
        ]);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();

        $post->categories()->sync($request->categories);

        return $post;
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return $post;
    }
}
