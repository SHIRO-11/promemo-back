<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Post;
use Auth;

class LikeController extends Controller{

    public function firstcheck($post) {
         
     $auth = Auth::guard('sanctum')->user();
     $likes = new Like();
     $like = Like::where('posts_id',$post)->where('user_id',$auth->id)->first();
     if($like) {
          $count = $likes->where('posts_id',$post)->where('like',1)->count();
          return response()->json([
               'like' => $like->like,
               'count' => $count
          ]);
     } else {
          $like = $likes->create([
               'user_id' => $auth->id,
               'posts_id' => $post,
               'like' => 0
          ]);
          $count = $likes->where('posts_id',$post)->where('like',1)->count();
          return response()->json([
               'like' => $like->like,
               'count' => $count
          ]);
     }
    }

    public function check($post) {
     $auth = Auth::guard('sanctum')->user();
     $likes = new Like();
     $like = Like::where('posts_id',$post)->where('user_id',$auth->id)->first();
     if($like->like == 1) {
          $like->like = 0;
          $like->save();
          $count = $likes->where('posts_id',$post)->where('like',1)->count();
          return response()->json([
               'like' => $like->like,
               'count' => $count
          ]);
     } else {
          $like->like = 1;
          $like->save();
          $count = $likes->where('posts_id',$post)->where('like',1)->count();
          return response()->json([
               'like' => $like->like,
               'count' => $count
          ]);
     };
    }
}
