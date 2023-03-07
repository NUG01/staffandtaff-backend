<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\Models\Gallery;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class AdResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'ad_id' => $this->id,
            'city' => $this->city,
            'description' => $this->description,
            'type' => $this->type,
            'days' => $this->days,
            'salary_type' => $this->salary_type,
            'salary' => $this->salary,
            'categories' => CategoryResource::collection(Category::all()),
            'gallery' => [
                Gallery::where('ad_id', $this->id)->get(['id', 'name']),
            ],
        ];
    }

    public static function createImages($ad, $request)
    {
        foreach ($request->images as $image) {
            $imageName = time() . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $gallery = Gallery::create([
                'name' => $imageName,
                'ad_id' => $ad->id,
            ]);
            $gallery->move(public_path('/assets/gallery/'), $imageName);
        }
    }
}
