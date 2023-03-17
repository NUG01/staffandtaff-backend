<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return response()->json(Blog::all());
    }
    public function getSpecificBlog(Blog $blog)
    {
        return response()->json($blog);
    }
    public function create(BlogRequest $request)
    {
        $newBlog = Blog::create([
            'type' => $request->type,
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'body' => $request->body,
        ]);

        $newBlog->categories()->attach($request->category_id);
        return response()->json(['blog' => $newBlog->load('categories')]);
    }
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return response()->noContent();
    }
}
