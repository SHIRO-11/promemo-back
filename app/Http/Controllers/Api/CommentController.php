<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Auth;

class PostController extends Controller
{
    public function store(Request $request,$post)
    {
        $auth = Auth::guard('sanctum')->user();
        $savedata = [
            'post_id' => $post,
            'user_id' => $auth->id,
            'comment' => $request->comment,
        ];
 
        $comment = new Comment;
        $comment->fill($savedata)->save();
 
    }
}
