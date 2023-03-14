<?php

namespace Modules\Tips\Http\Controllers\api;

use Illuminate\Routing\Controller;
use Modules\Tips\Entities\Tip;
use Modules\Tips\Http\Requests\PostRequest;
use Modules\Tips\Transformers\TipResource;

class TipController extends Controller
{
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return TipResource::collection(Tip::all());
    }

    public function store(PostRequest $request): TipResource
    {
        $post = Tip::create([
            'title' => $request->title,
            'slug' => str_slug($request->title, '_'),
            'description' => $request->description,
            'category' => $request->category,
            'target_audience' => $request->target_audience,
            'cover_image' => $request->cover_image,
        ]);

        return TipResource::make($post);
    }

    public function show(Tip $post): TipResource
    {
        return TipResource::make($post);
    }

    public function update(Tip $post, PostRequest $request): TipResource
    {
        return TipResource::make($post->update([
            'title' => $request->title,
            'slug' => str_slug($request->title, '_'),
            'description' => $request->description,
            'category' => $request->category,
            'target_audience' => $request->target_audience,
            'cover_image' => $request->cover_image,
        ]));
    }

    public function destroy(Tip $post): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $post->delete();
        return TipResource::collection(Tip::all());
    }
}
