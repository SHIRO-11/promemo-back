<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use App\Models\Category;
use App\Models\CategoryOrder;
use App\Models\PostCategory;
use Log;
use Auth;

class PostController extends Controller
{

    public function index()
    {
        return Post::with("category.category_color","likes")->where("draft",false)->get();
    }

    public function store(Request $request)
    {

        $auth = Auth::guard('sanctum')->user();

        $hasPostCategoryNum = Post::where('category_id', $request->category)->where('user_id', $auth->id)->count();

        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->draft = $request->draft;
        $post->user_id = $auth->id;
        $post->category_id = $request->category;
        $post->order_number_in_category = $hasPostCategoryNum + 1;
        $post->save();

        $alreadyHasCategory = CategoryOrder::where('user_id', $auth->id)->where('category_id', $request->category)->first();
        $hasCategoryNum = CategoryOrder::where('user_id', $auth->id)->count();

        if (!$alreadyHasCategory) {
            CategoryOrder::create([
                'user_id' => $auth->id,
                'category_id' => $request->category,
                'order_number' => $hasCategoryNum + 1,
            ]);
        }

        return response()->json([
            'post' => $post
        ]);
    }

    public function show($id)
    {
        $post = Post::with('comments.user','comments.replies.user')->findOrFail($id);

        return response()->json([
            'post' => $post
        ]);
    }

    public function searchMemo(Request $request){
        $post = Post::where('title','like','%'.$request->word.'%')->orWhere('content','like','%'.$request->word.'%')->get();

        return response()->json([
            'post'=>$post,
        ]);
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return response()->json([
            'post' => $post,
            'category' => $post->category()->pluck('id')
        ]);
    }

    public function update(Request $request, $id)
    {
        $auth = Auth::guard('sanctum')->user();
        $post = Post::find($id);

        if ($post->category->id != $request->categoryId) {

            Post::where('user_id', $auth->id)->where('category_id', $post->category_id)->where('order_number_in_category', '>', $post->order_number_in_category)->where('id', '!=', $post->id)->decrement('order_number_in_category');
            $post->order_number_in_category =  Post::where('user_id', $auth->id)->where('category_id', $request->categoryId)->count() + 1;

            $alreadyHasCategory = CategoryOrder::where('user_id', $auth->id)->where('category_id', $request->categoryId)->first();
            $hasCategoryNum = CategoryOrder::where('user_id', $auth->id)->count();

            if (!$alreadyHasCategory) {
                CategoryOrder::create([
                    'user_id' => $auth->id,
                    'category_id' => $request->categoryId,
                    'order_number' => $hasCategoryNum + 1,
                ]);
            }
        }
        $post->title = $request->title;
        $post->content = $request->content;
        $post->draft = $request->draft;
        $post->category_id = $request->categoryId;
        $post->save();

        return $post;
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return $post;
    }

    public function myMemo()
    {
        $auth = Auth::user();
        $categoryId = CategoryOrder::where('user_id', $auth->id)->orderBy('order_number', 'asc')->pluck('category_id');
        $placeholder = '';
        foreach ($categoryId as $key => $value) {
            $placeholder .= ($key == 0) ? '?' : ',?';
        }

        Log::debug($categoryId);
        Log::debug($placeholder);

        $myCategory = Category::whereIn('id', $categoryId)->orderByRaw("FIELD(id, $placeholder)", $categoryId)->with(['posts' => function ($query) {
            $query->where('user_id', Auth::guard('sanctum')->user()->id)->orderBy('order_number_in_category', 'asc');
        }])->with('category_color')->get();
        return $myCategory;
    }

    public function updateOrderNumber(Request $request)
    {
        $auth = Auth::guard('sanctum')->user();

        $newIndex = $request->newIndex;
        $oldIndex = $request->oldIndex;
        $categoryFromIndex = $request->categoryFromIndex;
        $categoryToIndex = $request->categoryToindex;

        $oldCategoryId = CategoryOrder::where('user_id', $auth->id)->where('order_number', $categoryFromIndex)->value('category_id');
        $newCategoryId = CategoryOrder::where('user_id', $auth->id)->where('order_number', $categoryToIndex)->value('category_id');

        $prevPost = Post::where('user_id', $auth->id)->where('order_number_in_category', $oldIndex)->where('category_id', $oldCategoryId)->first();

        $prevPost->update([
            'order_number_in_category' => $newIndex,
            'category_id' => $newCategoryId
        ]);

        if ($categoryFromIndex == $categoryToIndex) {

            if ($oldIndex > $newIndex) {
                Post::where('user_id', $auth->id)->where('category_id', $oldCategoryId)->where('order_number_in_category', '<', $oldIndex)->where('order_number_in_category', '>=', $newIndex)->where('id', '!=', $prevPost->id)->increment('order_number_in_category');
            } else if ($oldIndex < $newIndex) {
                Post::where('user_id', $auth->id)->where('category_id', $oldCategoryId)->where('order_number_in_category', '>', $oldIndex)->where('order_number_in_category', '<=', $newIndex)->where('id', '!=', $prevPost->id)->decrement('order_number_in_category');
            }
        } else if ($categoryFromIndex != $categoryToIndex) {

            Post::where('user_id', $auth->id)->where('category_id', $newCategoryId)->where('order_number_in_category', '>=', $newIndex)->where('id', '!=', $prevPost->id)->increment('order_number_in_category');
            Post::where('user_id', $auth->id)->where('category_id', $oldCategoryId)->where('order_number_in_category', '>', $oldIndex)->where('id', '!=', $prevPost->id)->decrement('order_number_in_category');
        }

        return '成功';
    }

    public function updateCategoryOrderNumber(Request $request)
    {
        $auth = Auth::guard('sanctum')->user();
        $newIndex = $request->newIndex;
        $oldIndex = $request->oldIndex;
        $category = CategoryOrder::where('user_id', $auth->id)->where('order_number', $oldIndex)->first();
        $category->update([
            'order_number' => $newIndex
        ]);

        if ($oldIndex > $newIndex) {
            CategoryOrder::where('user_id', $auth->id)->where('order_number', '<', $oldIndex)->where('order_number', '>=', $newIndex)->where('id', '!=', $category->id)->increment('order_number');
        } else if ($oldIndex < $newIndex) {
            CategoryOrder::where('user_id', $auth->id)->where('order_number', '>', $oldIndex)->where('order_number', '<=', $newIndex)->where('id', '!=', $category->id)->decrement('order_number');
        }
        return 'あああ';
    }

    public function draft()
    {
        return Post::with("category.category_color")->where('draft',true)->where('user_id',Auth::guard('sanctum')->id())->get();
    }

    public function good(){
        return Post::with("likes")->with("category.category_color")->where("draft",false)->whereHas('likes', function($query) {
            $query->where('user_id', Auth::guard('sanctum')->id());
        })->get();
    }
}
