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
            Role::ADMIN->value => null,
            Role::RECRUITER->value => EstablishmentResource::collection(Establishment::where('id', $this->type)->get()),
            Role::SEEKER->value => null,
            default => null,
        };

        return [
            'id' => $this->id,
            'email' => $this->email,
            'type' => $query,
            'role' => $roles,
        ];
    }
}
