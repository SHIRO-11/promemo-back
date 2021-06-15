<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Log;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        Log::debug($categories);
        return Category::all();
    }

    public function store(Request $request)
    {
        $category = new Category;
        $category->name = $request->name;
        $category->save();
        return response()->json([
            'category'=>$category
        ]);
    }

    public function show($id)
    {
        $Category = Category::findOrFail($id);

        return response()->json([
            'category' => $Category
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
}
