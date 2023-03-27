<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialLinks extends Model
{
    use HasFactory;

    protected $table = 'social_links';

    protected $fillable = [
        'website',
        'instagram',
        'linkedin',
        'facebook',
        'twitter',
        'pinterest',
        'youtube',
        'tik_tok',
        'user_type_id',
    ];
}
