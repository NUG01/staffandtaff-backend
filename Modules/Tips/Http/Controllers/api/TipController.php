<?php

namespace Modules\Tips\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Cache;
use Modules\Tips\Entities\Tip;
use Modules\Tips\Http\Requests\TipRequest;
use Modules\Tips\Transformers\TipResource;

class TipController extends Controller
{
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return TipResource::collection(Cache::remember('tips', 60 * 60 * 24, function () {
            return Tip::all();
        }));
    }

    /**
     * @throws AuthorizationException
     */
    public function store(TipRequest $request): TipResource
    {
        $this->authorize('administration', Auth()->user());

        $tip = Tip::create([
            'title' => $request->title,
            'slug' => str_slug($request->title, '_'),
            'description' => $request->description,
            'category' => $request->category,
            'target_audience' => $request->target_audience,
            'cover_image' => $request->cover_image,
        ]);

        return TipResource::make($tip);
    }

    public function show(Tip $tip): TipResource
    {
        return TipResource::make($tip);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(Tip $tip, TipRequest $request): TipResource
    {
        $this->authorize('administration', Auth()->user());


        return TipResource::make($tip->update([
            'title' => $request->title,
            'slug' => str_slug($request->title, '_'),
            'description' => $request->description,
            'category' => $request->category,
            'target_audience' => $request->target_audience,
            'cover_image' => $request->cover_image,
        ]));
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Tip $tip): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $this->authorize('administration', Auth()->user());

        $tip->delete();
        return TipResource::collection(Tip::all());
    }
}
