<?php

namespace App\Models;

use App\Observers\PositionObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $table = 'positions';

    protected $fillable = [
        'name',
        'slug',
        'hotel',
        'restaurant',
    ];

    protected $observers = [
        Position::class => [PositionObserver::class],
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
