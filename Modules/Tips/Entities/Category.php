<?php

namespace Modules\Tips\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Tips\Observers\CategoryObserver;

class Category extends Model
{
    use HasFactory;

    protected $table = 'tip_categories';

    protected $fillable = [
        'name',
        'slug',
    ];

    public $timestamps = false;

    protected $observers = [
        Category::class => [CategoryObserver::class],
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
