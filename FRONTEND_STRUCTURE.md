# Frontend Page Structure Documentation

## Overview
This document outlines the organized frontend page structure for the Laravel blog application, following best practices for routing, controllers, and Blade templating.

## Directory Structure

```
resources/views/pages/
├── home.blade.php              # Homepage with featured posts
├── about.blade.php             # About page
├── contact.blade.php           # Contact page
├── categories.blade.php        # All categories listing
└── blog/
    ├── blog.blade.php          # Blog posts listing
    ├── blog_details.blade.php  # Single blog post detail
    └── category.blade.php      # Posts filtered by category
```

## Routes Configuration

### Main Pages Routes
```php
Route::controller(SiteController::class)->group(function () {
  Route::get('/', 'index')->name('home');
  Route::get('/about', 'about')->name('about');
  Route::get('/contact', 'contact')->name('contact');
  Route::get('/categories', 'categories')->name('categories');
});
```

### Blog Routes (SEO-Friendly with /blog prefix)
```php
Route::prefix('blog')->name('blog.')->controller(SiteController::class)->group(function () {
  Route::get('/', 'blog')->name('index');                    // /blog
  Route::get('/{slug}', 'blog_details')->name('show');       // /blog/{slug}
  Route::get('/category/{slug}', 'category')->name('category'); // /blog/category/{slug}
});
```

### Contact Form
```php
Route::post('/contact', [ContactController::class, 'send'])->name('contact.submit');
```

## URL Structure

| Page | URL | Route Name | Controller Method |
|------|-----|------------|-------------------|
| Home | `/` | `home` | `SiteController@index` |
| About | `/about` | `about` | `SiteController@about` |
| Contact | `/contact` | `contact` | `SiteController@contact` |
| Categories | `/categories` | `categories` | `SiteController@categories` |
| Blog Listing | `/blog` | `blog.index` | `SiteController@blog` |
| Blog Post | `/blog/{slug}` | `blog.show` | `SiteController@blog_details` |
| Category Posts | `/blog/category/{slug}` | `blog.category` | `SiteController@category` |

## Controller Methods

### SiteController Methods

#### `index()` - Homepage
**Returns:** `pages.home`
**Variables:**
- `$title` - Page title
- `$featuredPost` - Featured blog post (where `is_featured = true`)
- `$categories` - All active categories with article counts
- `$latestPosts` - 6 most recent blog posts

#### `blog(Request $request)` - Blog Listing
**Returns:** `pages.blog.blog`
**Variables:**
- `$title` - Page title
- `$categories` - All active categories
- `$posts` - Paginated blog posts (9 per page) with search support

**Features:**
- Search functionality (searches title and description)
- Pagination

#### `blog_details($slug)` - Single Blog Post
**Returns:** `pages.blog.blog_details`
**Variables:**
- `$title` - Post title
- `$post` - Blog post with category, author, and tags
- `$relatedPosts` - 3 related posts from same category

#### `categories()` - All Categories
**Returns:** `pages.categories`
**Variables:**
- `$title` - Page title
- `$categories` - All active categories with published article counts

#### `category($slug)` - Category Posts
**Returns:** `pages.blog.category`
**Variables:**
- `$title` - Category title
- `$category` - Category object
- `$categories` - All active categories (for filter)
- `$posts` - Paginated posts in this category (9 per page)

#### `about()` - About Page
**Returns:** `pages.about`
**Variables:**
- `$title` - Page title

#### `contact()` - Contact Page
**Returns:** `pages.contact`
**Variables:**
- `$title` - Page title

## Models

### BlogArticle
**Table:** `blog_articles`
**Key Fields:**
- `status` (boolean) - 1 = published, 0 = draft
- `is_featured` (boolean) - Featured on homepage
- `slug` (string) - SEO-friendly URL
- `category_id` - Foreign key to blog_categories
- `author_id` - Foreign key to users

**Relationships:**
- `category()` - belongsTo BlogCategory
- `author()` - belongsTo User
- `tags()` - belongsToMany Tag

**Accessors:**
- `excerpt` - Meta description or truncated content
- `content` - Alias for description field
- `read_time` - Estimated reading time
- `views` - View count
- `published_date` - Created at timestamp

### BlogCategory
**Table:** `blog_categories`
**Key Fields:**
- `status` (boolean) - 1 = active, 0 = inactive
- `slug` (string) - SEO-friendly URL
- `title` (string) - Category name

**Relationships:**
- `articles()` - hasMany BlogArticle

**Accessors:**
- `name` - Alias for title field

### User
**Table:** `users`
**Accessors:**
- `avatar` - Profile photo URL or generated avatar
- `bio` - User biography

## Database Status Values

Both `blog_articles` and `blog_categories` use **boolean status**:
- `1` = Published/Active
- `0` = Draft/Inactive

## Blade Templating

### Layout
All pages extend: `layouts2.app`

### Shared Components
- `partials.blog-card` - Blog post card component

### Required Variables by View

**home.blade.php:**
- `$featuredPost` (nullable)
- `$categories` (collection)
- `$latestPosts` (collection)

**blog.blade.php:**
- `$categories` (collection)
- `$posts` (paginated)

**blog_details.blade.php:**
- `$post` (object)
- `$relatedPosts` (collection)

**category.blade.php:**
- `$category` (object)
- `$categories` (collection)
- `$posts` (paginated)

**categories.blade.php:**
- `$categories` (collection with `blog_posts_count`)

## SEO Best Practices

1. **Slug-based URLs** - All blog posts and categories use slugs
2. **Descriptive Routes** - Clear, readable URL structure
3. **Meta Tags** - Each page has `page_title` and `meta_desc` fields
4. **Structured Data** - Ready for schema.org implementation

## Usage Examples

### Linking to Pages
```blade
{{-- Home --}}
<a href="{{ route('home') }}">Home</a>

{{-- Blog Listing --}}
<a href="{{ route('blog.index') }}">Blog</a>

{{-- Single Post --}}
<a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>

{{-- Category --}}
<a href="{{ route('blog.category', $category->slug) }}">{{ $category->name }}</a>

{{-- All Categories --}}
<a href="{{ route('categories') }}">Categories</a>
```

### Search Form
```blade
<form action="{{ route('blog.index') }}" method="GET">
    <input type="text" name="search" value="{{ request('search') }}">
    <button type="submit">Search</button>
</form>
```

## Notes

- All queries filter by `status = 1` to show only published content
- Pagination is set to 9 items per page for blog listings
- Featured posts are identified by `is_featured = true`
- Related posts are limited to 3 items from the same category
- Categories display article counts for published posts only
