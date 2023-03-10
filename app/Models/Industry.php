<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    use HasFactory;

    protected $table = 'industries';

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
