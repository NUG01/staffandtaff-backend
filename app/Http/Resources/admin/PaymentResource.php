<?php

namespace App\Http\Resources\admin;

use App\Models\User;
use Carbon\Carbon;
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
            'ends_at' => $this->ends_at == null ? 'not yet' : (Carbon::createFromFormat('Y-m-d H:i:s', $this->ends_at))->format('Y-m-d'),
            'quantity' => $this->quantity,
        ];
    }
}
