<?php

namespace App\Http\Resources\admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'stripe_id' => $this->stripe_id,
            'owner' => User::where('id', $this->user_id)->value('name'),
            'plan_name' => $this->name,
            'status' => $this->stripe_status,
            'quantity' => $this->quantity,
        ];
    }
}
