<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstablishmentLinks extends Model
{
    use HasFactory;

    protected $table = 'establishment_links';

    protected $fillable = [
        'website',
        'instagram',
        'linkedin',
        'facebook',
        'twitter',
        'pinterest',
        'youtube',
        'tik_tok',
        'establishment_id',
    ];
}
