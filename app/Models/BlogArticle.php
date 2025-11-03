<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogArticle extends Model
{
  use HasFactory, SoftDeletes;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'category_id',
    'author_id',
    'page_title',
    'meta_desc',
    'title',
    'slug',
    'image',
    'description',
    'status',
    'is_featured',
    'views_count',
  ];
  
  /**
   * The attributes that should be cast.
   *
   * @var array
   */
  protected $casts = [
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
    'is_featured' => 'boolean',
    'status' => 'boolean',
  ];

  /**
   * Articles relation to category
   *
   */
  public function category()
  {
    return $this->belongsTo(BlogCategory::class, 'category_id');
  }
  
  /**
   * Articles relation to author
   *
   */
  public function author()
  {
    return $this->belongsTo(User::class, 'author_id');
  }
  
  /**
   * Articles relation to tags
   *
   */
  public function tags()
  {
    return $this->belongsToMany(Tag::class, 'blog_article_tag');
  }
  
  public function comments()
  {
      return $this->morphMany(Comment::class, 'commentable');
  }
  
  public function scopeFeatured($query)
  {
    return $query->where('is_featured', true)->where('status', 'published'); // Ensure only published articles are shown
  }
  
  /**
   * Get the excerpt attribute
   */
  public function getExcerptAttribute()
  {
    return $this->meta_desc ?? substr(strip_tags($this->description), 0, 160);
  }
  
  /**
   * Get the content attribute (alias for description)
   */
  public function getContentAttribute()
  {
    return $this->description;
  }
  
  /**
   * Get the read time estimate
   */
  public function getReadTimeAttribute()
  {
    $wordCount = str_word_count(strip_tags($this->description));
    $minutes = ceil($wordCount / 200);
    return $minutes . ' min read';
  }
  
  /**
   * Get the views count
   */
  public function getViewsAttribute()
  {
    return $this->views_count ?? 0;
  }
  
  /**
   * Get the published date
   */
  public function getPublishedDateAttribute()
  {
    return $this->created_at;
  }
  
  /**
   * Get author name with fallback
   */
  public function getAuthorNameAttribute()
  {
    return $this->author ? $this->author->name : 'Anonymous';
  }
  
  /**
   * Get author avatar with fallback
   */
  public function getAuthorAvatarAttribute()
  {
    if ($this->author) {
      return $this->author->avatar;
    }
    return 'https://ui-avatars.com/api/?name=Anonymous&background=random';
  }
}
