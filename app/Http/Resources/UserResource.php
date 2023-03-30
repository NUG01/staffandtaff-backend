<?php

namespace App\Http\Resources;

use App\Enum\Role;
use App\Models\Establishment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $roles = match ($request->user()->role_id) {
            Role::ADMIN->value => "Administrator",
            Role::RECRUITER->value => "Recruiter",
            Role::SEEKER->value => "Seeker",
            default => "Guest",
        };

        $query = match ($request->user()->role_id) {
            Role::RECRUITER->value => EstablishmentResource::collection(Establishment::whereIn('id', $this->type)->get()),
            default => null,
        };

        return [
            'id' => $this->id,
            'email' => $this->email,
            'verified' => boolval($this->email_verified_at),
            'type' => $query,
            'role' => $roles,
        ];
    }
}
