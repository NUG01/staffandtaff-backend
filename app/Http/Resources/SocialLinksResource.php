<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SocialLinksResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'website' => $this->website,
            'instagram' => $this->instagram,
            'linkedin' => $this->linkedin,
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'pinterest' => $this->pinterest,
            'youtube' => $this->youtube,
            'tik_tok' => $this->tik_tok,
        ];
    }
}
