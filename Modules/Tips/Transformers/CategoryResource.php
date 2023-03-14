<?php

namespace Modules\Tips\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
          'category_name' => $this->name,
          'category_slug' => $this->slug,
        ];
    }
}
