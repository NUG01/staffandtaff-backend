<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return CategoryResource::collection(Cache::remember('categories', 60 * 60 * 24, function () {
            return Category::all();
        }));
    }

    public function store(CategoryRequest $request): CategoryResource
    {
        $category = Category::create([
            'name' => $request->name,
            'slug' => str_slug($request->name, '_'),
        ]);

        return CategoryResource::make($category);
    }

    public function storeSubcategory(Category $category, CategoryRequest $request): CategoryResource
    {
        $subcategory = Subcategory::create([
            'name' => $request->name,
            'slug' => str_slug($request->name, '_'),
        ]);

        CategoryResource::updateChildrenIds($category, $subcategory);

        return CategoryResource::make($category);
    }

    public function show(Category $category): CategoryResource
    {
        return CategoryResource::make($category);
    }

    public function update(Category $category, CategoryRequest $request): CategoryResource
    {
        CategoryResource::updateCategoryOrSubcategory($category, $request);
        return CategoryResource::make($category);
    }

    public function updateSubcategory(Subcategory $subcategory, CategoryRequest $request): CategoryResource
    {
        CategoryResource::updateCategoryOrSubcategory($subcategory, $request);
        return CategoryResource::make($subcategory);
    }

    public function destroy(Category $category): \Illuminate\Http\JsonResponse
    {
        CategoryResource::destroy($category);
        return response()->json(['status' => 'category and subcategories has been deleted!']);
    }

    public function destroySubcategory(Subcategory $subcategory): \Illuminate\Http\JsonResponse
    {
        $subcategory->delete();
        return response()->json(['status' => 'Subcategory has been deleted!']);
    }
}
