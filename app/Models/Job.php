<?php

namespace App\Models;

use App\Observers\JobObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'ads';

    protected $fillable = [
        'position',
        'salary',
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
}
