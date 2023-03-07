<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'galleries';

    protected $fillable = [
        'name',
        'establishment_id',
    ];

    public function ad()
    {
        $this->belongsTo(Establishment::class, 'establishment_id');
    }
}
