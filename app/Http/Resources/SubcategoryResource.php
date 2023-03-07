<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubcategoryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'subcategory_name' => $this->name,
            'subcategory_slug' => $this->slug,
        ];
    }
}
