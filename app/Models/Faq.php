<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

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
                    $query->where('category', 'like', $term)
                        ->orWhere('question', 'like', $term)
                        ->orWhere('answer', 'like', $term);
                });
            });
        }
    }
}
