<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'link',
    ];
    
    /**
     * Relationship to blog articles
     */
    public function blogArticles()
    {
        return $this->belongsToMany(BlogArticle::class, 'blog_article_tag');
    }
    
    /**
     * Get the name attribute (alias for title)
     */
    public function getNameAttribute()
    {
        return $this->title;
    }
}
