<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CategoryColor;
use Log;
use Auth;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::with('category_color')->get();
    }

    public function store(Request $request)
    {
        $category = new Category;
        $category->name = $request->name;
        $category->save();
        return response()->json([
            'category' => $category
        ]);
    }

    public function show($id)
    {
        $category = Category::with('posts')->findOrFail($id);
        return response()->json([
            'category' => $category
        ]);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();
        return $category;
    }

    public function destroy($id)
    {
        $category = category::find($id);
        $category->delete();
        return $category;
    }

    public function changeCategorColor(Request $request)
    {
        $categoryColor = CategoryColor::where('category_id', $request->categoryId)->where('user_id', Auth::guard('sanctum')->id())->first();

        if ($categoryColor) {
            $categoryColor->update([
                'color_name' => $request->colorName,
            ]);
        } else {
            $categoryColor = CategoryColor::create([
                'user_id' => Auth::guard('sanctum')->id(),
                'category_id' => $request->categoryId,
                'color_name' => $request->colorName,
            ]);
        }

        return Category::with('category_color')->get();
    }
}
