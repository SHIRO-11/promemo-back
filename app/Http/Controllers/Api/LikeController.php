<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Like;
use Auth;

class LikeController extends Controller
{
     public function store(post $post)
     {
          $user = Auth::guard('sanctum')->user();
          if ($user->id != $post->user_id) {
               if ($post->isLiked(Auth::id())) {
                    $delete_record = $post->getLike($user->id);
                    $delete_record->delete();
               } else {
                    $like = Like::firstOrCreate(
                         array(
                              'user_id' => Auth::guard('sanctum')->user()->id,
                              'post_id' => $post->id
                         )
                    );
               }
          }
     }
}
