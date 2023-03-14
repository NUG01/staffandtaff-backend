<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndustryRequest;
use App\Http\Resources\IndustryResource;
use App\Http\Resources\PositionResource;
use App\Models\Industry;
use App\Models\Position;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;

class IndustryController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return IndustryResource::collection(Cache::remember('industries', 60 * 60 * 24, function () {
            return Industry::all();
        }));
    }

    public function positionsList(): AnonymousResourceCollection
    {
        return PositionResource::collection(Cache::remember('positions', 60 * 60 * 24, function () {
            return Position::all();
        }));
    }

    /**
     * @throws AuthorizationException
     */
    public function store(IndustryRequest $request): IndustryResource
    {
        $this->authorize('administration', Auth()->user());

        $industry = Industry::create([
            'name' => $request->name,
            'slug' => str_slug($request->name, '_'),
        ]);

        return IndustryResource::make($industry);
    }

    /**
     * @throws AuthorizationException
     */
    public function storePosition(Industry $industry, IndustryRequest $request): IndustryResource
    {
        $this->authorize('administration', Auth()->user());

        $position = Position::create([
            'name' => $request->name,
            'slug' => str_slug($request->name, '_'),
        ]);

        IndustryResource::updateChildrenIds($industry, $position);

        return IndustryResource::make($industry);
    }

    /**
     * @throws AuthorizationException
     */
    public function show(Industry $industry): IndustryResource
    {
        $this->authorize('administration', Auth()->user());

        return IndustryResource::make($industry);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(Industry $industry, IndustryRequest $request): IndustryResource
    {
        $this->authorize('administration', Auth()->user());

        IndustryResource::updateIndustryOrPosition($industry, $request);
        return IndustryResource::make($industry);
    }

    /**
     * @throws AuthorizationException
     */
    public function updatePosition(Position $position, IndustryRequest $request): IndustryResource
    {
        $this->authorize('administration', Auth()->user());

        IndustryResource::updateIndustryOrPosition($position, $request);
        return IndustryResource::make($position);
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Industry $industry): \Illuminate\Http\JsonResponse
    {
        $this->authorize('administration', Auth()->user());

        IndustryResource::destroy($industry);
        return response()->json(['status' => 'Industry and it\'s positions has been deleted!']);
    }

    /**
     * @throws AuthorizationException
     */
    public function destroyPosition(Position $position): \Illuminate\Http\JsonResponse
    {
        $this->authorize('administration', Auth()->user());

        $position->delete();
        return response()->json(['status' => 'Position has been deleted!']);
    }
}
