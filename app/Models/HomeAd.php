<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeAd extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'ad_code',
        'is_active',
        'order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get active ads for a specific position
     */
    public static function getActiveAdsByPosition($position)
    {
        return self::where('position', $position)
            ->where('is_active', true)
            ->orderBy('order', 'asc')
            ->get();
    }

    /**
     * Position options for dropdown
     */
    public static function positionOptions()
    {
        return [
            'after_featured' => 'Home: After Featured Post',
            'before_latest' => 'Home: Before Latest Posts',
            'home_after_3rd' => 'Home: After 3rd Article',
            'home_after_7th' => 'Home: After 7th Article',
            'blog_after_3rd' => 'Blog List: After 3rd Post',
            'blog_after_7th' => 'Blog List: After 7th Post',
            'blog_before_pagination' => 'Blog List: Before Pagination',
            'blog_detail_after_first_paragraph' => 'Blog Detail: After Two Paragraphs',
            'blog_detail_middle_content' => 'Blog Detail: Middle of Content',
            'blog_detail_before_last_2_tags' => 'Blog Detail: Before Last 2 Tags in Description',
        ];
    }
}
