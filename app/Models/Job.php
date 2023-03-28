<?php

namespace App\Models;

use App\Observers\JobObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'country_code',
        'city_name',
        'longitude',
        'latitude',
        'establishment_id',
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


    public function establishment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Establishment::class);
    }

    public function likes(): HasMany
    {
        return $this->HasMany(Like::class);
    }
}
