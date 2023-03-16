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
        'establishment_name',
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
        return $this->hasMany(Gallery::class, 'establishment_id');
    }
}
