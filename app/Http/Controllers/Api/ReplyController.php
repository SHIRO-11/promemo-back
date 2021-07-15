<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reply;
use Auth;

class ReplyController extends Controller
{
    public function store(Request $request){
        $auth = Auth::guard('sanctum')->user();

        $reply = Reply::create([
            'comment_id' => $request->commentId,
            'user_id' => $auth->id,
            'title' => $request->title,
            'content' => $request->content,
        ]);

        $reply = Reply::with('user')->find($reply->id);
        
        return response()->json([
            'reply'=>$reply,
        ]);
    }
}
