<?php

namespace Modules\Tips\Http\Controllers\api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Tips\Entities\Category;
use Modules\Tips\Http\Requests\CategoryRequest;
use Modules\Tips\Transformers\CategoryResource;

class CategoryController extends Controller
{
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return CategoryResource::collection(Category::all());
    }

    public function store(CategoryRequest $request): CategoryResource
    {
        return CategoryResource::make(Category::create([
            'name' => $request->name,
            'slug' => str_slug($request->name, '_'),
        ]));
    }

    public function update(Category $category, CategoryRequest $request): CategoryResource
    {
        return CategoryResource::make($category->update([
            'name' => $request->name,
            'slug' => str_slug($request->name, '_'),
        ]));
    }

    public function destroy(Category $category): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $category->delete();
        return CategoryResource::collection(Category::all());
    }
}
