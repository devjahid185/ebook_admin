<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryApiController extends Controller
{
    // Show all categories
    public function index()
    {
        $categories = Category::orderBy('position', 'asc')
            ->where('is_active', true)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }

    // Show single category by slug
    public function show($slug)
    {
        $category = Category::where('slug', $slug)
            ->where('is_active', true)
            ->first();

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $category
        ]);
    }
}
