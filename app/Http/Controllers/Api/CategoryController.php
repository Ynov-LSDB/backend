<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json([
            'success' => true,
            'message' =>count($categories) . " categories found",
            'data' => $categories
        ], 200);
    }

    public function show($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Category found',
            'data' => $category
        ], 200);
    }

    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->save();

        return response()->json([
            'success' => true,
            'message' => 'Category created',
            'data' => $category
        ], 200);
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 400);
        }
        $category->delete();
        return response()->json([
            'success' => true,
            'message' => 'Category deleted'
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 400);
        }
        $category->name = $request->name;
        $category->save();
        return response()->json([
            'success' => true,
            'message' => 'Category updated',
            'data' => $category
        ], 200);
    }
}
