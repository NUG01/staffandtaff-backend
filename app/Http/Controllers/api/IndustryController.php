<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndustryRequest;
use App\Http\Resources\IndustryResource;
use App\Http\Resources\PositionResource;
use App\Models\Industry;
use App\Models\Position;
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

    public function store(IndustryRequest $request): IndustryResource
    {
        $industry = Industry::create([
            'name' => $request->name,
            'slug' => str_slug($request->name, '_'),
        ]);

        return IndustryResource::make($industry);
    }

    public function storePosition(Industry $industry, IndustryRequest $request): IndustryResource
    {
        $position = Position::create([
            'name' => $request->name,
            'slug' => str_slug($request->name, '_'),
        ]);

        IndustryResource::updateChildrenIds($industry, $position);

        return IndustryResource::make($industry);
    }

    public function show(Industry $industry): IndustryResource
    {
        return IndustryResource::make($industry);
    }

    public function update(Industry $industry, IndustryRequest $request): IndustryResource
    {
        IndustryResource::updateIndustryOrPosition($industry, $request);
        return IndustryResource::make($industry);
    }

    public function updatePosition(Position $position, IndustryRequest $request): IndustryResource
    {
        IndustryResource::updateIndustryOrPosition($position, $request);
        return IndustryResource::make($position);
    }

    public function destroy(Industry $industry): \Illuminate\Http\JsonResponse
    {
        IndustryResource::destroy($industry);
        return response()->json(['status' => 'Industry and it\'s positions has been deleted!']);
    }

    public function destroyPosition(Position $position): \Illuminate\Http\JsonResponse
    {
        $position->delete();
        return response()->json(['status' => 'Position has been deleted!']);
    }
}
