<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $auth = Auth::guard('sanctum')->user();

        $comment = Comment::create([
            'post_id' => $request->postId,
            'user_id' => $auth->id,
            'title' => $request->title,
            'content' => $request->content,
        ]);
        
        return response()->json([
            'comment'=>$comment,
        ]);
    }
}
