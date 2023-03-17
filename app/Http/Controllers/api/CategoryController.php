<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::all());
    }
    public function create(Request $request)
    {

        $newCategory = Category::create([
            'name' => $request->category_name,
        ]);
        return response()->json($newCategory);
    }
    public function destroy(Category $category)
    {

        $category->delete();
        return response()->noContent();
    }
}
