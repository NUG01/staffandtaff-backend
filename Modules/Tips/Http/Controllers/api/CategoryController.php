<?php

namespace Modules\Tips\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Modules\Tips\Entities\Category;
use Modules\Tips\Http\Requests\CategoryRequest;
use Modules\Tips\Transformers\CategoryResource;

class CategoryController extends Controller
{
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return CategoryResource::collection(Category::all());
    }

    /**
     * @throws AuthorizationException
     */
    public function store(CategoryRequest $request): CategoryResource
    {
        $this->authorize('administration', Auth()->user());

        return CategoryResource::make(Category::create([
            'name' => $request->name,
            'slug' => str_slug($request->name, '_'),
        ]));
    }

    /**
     * @throws AuthorizationException
     */
    public function update(Category $category, CategoryRequest $request): CategoryResource
    {
        $this->authorize('administration', Auth()->user());

        return CategoryResource::make($category->update([
            'name' => $request->name,
            'slug' => str_slug($request->name, '_'),
        ]));
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Category $category): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $this->authorize('administration', Auth()->user());

        $category->delete();
        return CategoryResource::collection(Category::all());
    }
}
