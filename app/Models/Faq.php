<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mews\Purifier\Casts\CleanHtml;
use Mews\Purifier\Casts\CleanHtmlInput;
use Mews\Purifier\Casts\CleanHtmlOutput;

class Faq extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        // 'bio'            => CleanHtml::class, // cleans both when getting and setting the value
        // 'description'    => CleanHtmlInput::class, // cleans when setting the value
        'answer'        => CleanHtmlOutput::class, // cleans when getting the value
    ];


    public function category(): Attribute
    {
        return new Attribute(
            fn ($value) => strtoupper($value),
            fn ($value) => strtolower($value)
        );
    }

    public function scopeFilter($query, $terms = null)
    {
        if (request('search') ?? false) {
            collect(explode(' ', $terms))->filter()->each(function ($term) use ($query) {
                $term = '%' . $term . '%';
                $query->where(function ($query) use ($term) {
                    $query->orWhere('category', 'like', $term)
                        ->orWhere('question', 'like', $term)
                        ->orWhere('answer', 'like', $term);
                });
            });
        }
    }
}
