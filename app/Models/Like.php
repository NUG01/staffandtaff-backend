<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    use HasFactory;

    protected $gaurded = ['id'];

    public function job(): BelongsTo
    {
        return $this->HasMBelongsToany(Job::class);
    }
    public function user(): BelongsTo
    {
        return $this->HasMBelongsToany(User::class);
    }
}
