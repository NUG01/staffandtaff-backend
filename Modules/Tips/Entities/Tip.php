<?php

namespace Modules\Tips\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Tips\Observers\TipObserver;

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
    protected $observers = [
        Tip::class => [TipObserver::class],
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

}
