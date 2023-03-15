<?php

namespace Modules\Tips\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Cache;
use Modules\Tips\Entities\Category;
use Modules\Tips\Http\Requests\CategoryRequest;
use Modules\Tips\Transformers\CategoryResource;

class CategoryController extends Controller
{
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return CategoryResource::collection(Cache::remember('categories', 60 * 60 * 24, function () {
            return Category::all();
        }));
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
    public function update(Category $category, CategoryRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->authorize('administration', Auth()->user());
        $category->update([
            'name' => $request->name,
            'slug' => str_slug($request->name, '_'),
        ]);
        return response()->json(['message' => 'Category has been updated']);
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
