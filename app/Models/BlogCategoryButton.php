<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlogCategoryButton extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'url',
        'bg_color',
        'text_color',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function getUrlAttribute($value)
    {
        if ($value) {
            return $value;
        }
        
        if ($this->category_id) {
            return route('blog.category', $this->category->slug);
        }
        
        return '#';
    }
}
