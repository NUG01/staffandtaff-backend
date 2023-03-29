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
        'establishment_id',
    ];

    public function establishemnt(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(SocialLinks::class);
    }
}
