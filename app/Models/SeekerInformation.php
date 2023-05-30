<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SeekerInformation extends Model
{
    use HasFactory;

    
    protected $guarded = ['id'];


    public function experiences(): HasMany
    {
        return $this->HasMany(Experience::class);
    }


    public function educations(): HasMany
    {
        return $this->HasMany(Education::class);
    }


    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }

}
