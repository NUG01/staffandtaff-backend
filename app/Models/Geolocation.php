<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geolocation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

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
