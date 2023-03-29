<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    use HasFactory;

    protected $table = 'establishments';

    protected $fillable = [
        'logo',
        'name',
        'company_name',
        'country',
        'city',
        'address',
        'industry',
        'number_of_employees',
        'description',
    ];

    public function gallery(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Gallery::class);
    }
    public function jobs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Job::class);
    }
    public function links(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(SocialLinks::class);
    }
}
