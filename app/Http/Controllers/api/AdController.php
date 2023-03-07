<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdRequest;
use App\Http\Resources\AdResource;
use App\Models\Ad;
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

    public function store(AdRequest $request): AdResource
    {
        $ad = Ad::create($request->validated());
        AdResource::createImages($ad, $request);

        return AdResource::make($ad);
    }

    public function show(Ad $ad): AdResource
    {
        return AdResource::make($ad);
    }

    public function update(Ad $ad, AdRequest $request): AdResource
    {
        $updated = $ad->update($request->validated());

        return AdResource::make($updated);
    }

    public function destroy(Ad $ad): AnonymousResourceCollection
    {
        $ad->delete();

        return AdResource::collection(Cache::remember('ads', 60 * 60 * 24, function () {
            return Ad::all();
        }));
    }
}
