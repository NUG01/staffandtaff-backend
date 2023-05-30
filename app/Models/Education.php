<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Education extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',

    ];

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }


    public function seekerInfo(): BelongsTo
    {
        return $this->BelongsTo(SeekerInformation::class);
    }
}
