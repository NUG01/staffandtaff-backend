<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdRequest;
use App\Http\Resources\AdResource;
use App\Models\Ad;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;

class AdController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return AdResource::collection(Cache::remember('ads', 60 * 60 * 24, function () {
            return Ad::all();
        }));
    }

    /**
     * @throws AuthorizationException
     */
    public function store(AdRequest $request): AdResource
    {
        $this->authorize('recruiter', Auth()->user());

        $ad = Ad::create($request->validated());
        AdResource::createImages($ad, $request);

        return AdResource::make($ad);
    }

    public function show(Ad $ad): AdResource
    {
        return AdResource::make($ad);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(Ad $ad, AdRequest $request): AdResource
    {
        $this->authorize('recruiter', Auth()->user());

        $updated = $ad->update($request->validated());

        return AdResource::make($updated);
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Ad $ad): AnonymousResourceCollection
    {
        $this->authorize('recruiter', Auth()->user());

        $ad->delete();

        return AdResource::collection(Cache::remember('ads', 60 * 60 * 24, function () {
            return Ad::all();
        }));
    }
}
