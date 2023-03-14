<?php

namespace Modules\Tips\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'tip_categories';

    protected $fillable = [
        'name',
        'slug',
    ];

    public $timestamps = false;

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
