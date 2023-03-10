<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'children_id',
        'slug',
        'name',
    ];

    protected $casts = [
        'children_id' => 'array'
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
