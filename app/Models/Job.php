<?php

namespace App\Models;

use App\Observers\JobObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'jobs';

    protected $fillable = [
        'position',
        'salary',
        'salary_type',
        'currency',
        'type_of_contract',
        'type_of_attendance',
        'period_type',
        'period',
        'availability',
        'description',
        'start_date',
        'end_date',
    ];

    protected $observers = [
        Job::class => [JobObserver::class],
    ];

    protected $dates = [
        'start_date',
        'end_date',
    ];

    public function scopeSelectDistanceTo($query, $coords)
    {

        $query->select('*');

        $query->selectRaw('ST_Distance(
                ST_SRID(Point(longitude, latitude), 4326),
                ST_SRID(Point(?, ?), 4326)
            ) as distance', $coords);
    }
    public function scopeWithinDistanceTo($query, $coords, $distance)
    {

        $query->whereRaw('ST_Distance(
                ST_SRID(Point(longitude, latitude), 4326),
                ST_SRID(Point(?, ?), 4326)
            ) <= ?', [...$coords, $distance]);
    }
}
