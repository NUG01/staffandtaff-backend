<?php

namespace Modules\Tips\Http\Controllers\api;

use App\Enum\Role;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Cache;
use Modules\Tips\Entities\Tip;
use Modules\Tips\Http\Requests\TipRequest;
use Modules\Tips\Transformers\TipResource;

class TipController extends Controller
{
    private mixed $role;

    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $this->role = Tip::where('target_audience', 0)->get();

        if (Auth()->check()) {
            $this->role = match (Auth()->user()->role_id) {
                Role::RECRUITER->value => Tip::where('target_audience', 2)->get(),
                Role::SEEKER->value => Tip::where('target_audience', 1)->get(),
                Role::ADMIN->value => Tip::all(),
            };
        }

        return TipResource::collection(Cache::remember('tips', 60 * 60 * 24, function () {
            return $this->role;
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
    public function update(Tip $tip, TipRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->authorize('administration', Auth()->user());

        $tip->update([
            'title' => $request->title,
            'slug' => str_slug($request->title, '_'),
            'description' => $request->description,
            'category' => $request->category,
            'target_audience' => $request->target_audience,
            'cover_image' => $request->cover_image,
        ]);

        return response()->json(['message' => 'Tip has been updated']);
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
