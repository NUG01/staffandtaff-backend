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

    public function store(TipRequest $request): TipResource
    {
        // Default არ ვიცი ექნება თუ არა
        $logoPath = '/logos/default.png';

        if ($request->file('cover_image')) $logoPath = $request->file('cover_image')->store('cover_images');

        $validated = $request->validated();
        $validated['cover_image'] = $logoPath;
        $validated['slug'] = str_slug($request->title, '_');

        return TipResource::make(Tip::create($validated));
    }

    public function show(Tip $tip): TipResource
    {
        return TipResource::make($tip);
    }

    public function update(Tip $tip, TipRequest $request): \Illuminate\Http\JsonResponse
    {
        $logoPath = '/logos/default.png';

        if ($request->file('cover_image')) $logoPath = $request->file('cover_image')->store('cover_images');

        $validated = $request->validated();
        $validated['cover_image'] = $logoPath;
        $validated['slug'] = str_slug($request->title, '_');

        $tip->update($validated);

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
