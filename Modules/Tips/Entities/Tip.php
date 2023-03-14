<?php

namespace Modules\Tips\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tip extends Model
{
    use HasFactory;

    protected $table = 'tips';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'category',
        'target_audience',
        'cover_image',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

}
