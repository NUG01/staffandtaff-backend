<?php

namespace App\Models;

use App\Enums\BlogType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $guarded = ['id'];



    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }
}