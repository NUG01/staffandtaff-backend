<?php

namespace Modules\Tips\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Tips\Entities\Category;

class TipResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'tip_title' => $this->title,
            'tip_slug' => $this->slug,
            'tip_description' => $this->description,
            'tip_category' => CategoryResource::collection(Category::where('id', $this->category)->get()),
            'tip_target_audience' => config('targetaudience.selector')[$this->target_audience],
            'tip_cover_image' => $this->cover_image,
            'tip_cta' => config('targetaudience.items')[$this->target_audience],
            'tip_created_at' => $this->created_at->format('d/m/Y'),
        ];
    }
}
