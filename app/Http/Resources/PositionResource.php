<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PositionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'position_name' => $this->name,
            'position_slug' => $this->slug,
        ];
    }
}
