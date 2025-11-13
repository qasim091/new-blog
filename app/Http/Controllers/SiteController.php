<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogArticle;
use App\Models\BlogCategory;
use App\Models\User;
use App\Models\HomeAd;

class SiteController extends Controller
{
  /**
   * Load main site index page
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $title = "Welcome to my App";

    // Get featured post
    $featuredPost = BlogArticle::where('status', 1)
      ->where('is_featured', true)
      ->with(['category', 'author'])
      ->latest()
      ->first();

    // Get categories with article count
    $categories = BlogCategory::where('status', 1)
      ->withCount('articles')
      ->get()
      ->map(function($category) {
        $category->count = $category->articles_count;
        $category->color = 'bg-gradient-to-br from-primary/20 to-accent/20';
        return $category;
      });

    // Get latest posts with pagination
    $recentposts = BlogArticle::where('status', 1)
      ->with(['category', 'author'])
      ->latest()
      ->paginate(9); // 9 posts per page to work well with 3-column grid

    // Get active home page ads
    $adsAfter3rd = HomeAd::getActiveAdsByPosition('home_after_3rd');
    $adsAfter7th = HomeAd::getActiveAdsByPosition('home_after_7th');

    return view('pages.home', compact('title', 'featuredPost', 'categories', 'recentposts', 'adsAfter3rd', 'adsAfter7th'));
  }
  public function blog(Request $request)
  {
    $title = "Blog";

    // Get all categories
    $categories = BlogCategory::where('status', 1)->get();

    // Get posts with search and pagination
    $posts = BlogArticle::where('status', 1)
      ->with(['category', 'author'])
      ->when($request->search, function($query, $search) {
        $query->where('title', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
      })
      ->latest()
      ->paginate(9);

    // Get active blog page ads
    $adsAfter3rd = HomeAd::getActiveAdsByPosition('blog_after_3rd');
    $adsAfter7th = HomeAd::getActiveAdsByPosition('blog_after_7th');

    return view('pages.blog.blog', compact('title', 'categories', 'posts', 'adsAfter3rd', 'adsAfter7th'));
  }

  public function blog_details($slug)
  {
    // Get the post by slug
    $post = BlogArticle::where('slug', $slug)
      ->where('status', 1)
      ->with(['category', 'author', 'tags'])
      ->firstOrFail();

    // Get related posts from same category
    $relatedPosts = BlogArticle::where('category_id', $post->category_id)
      ->where('id', '!=', $post->id)
      ->where('status', 1)
      ->with(['category', 'author'])
      ->latest()
      ->take(3)
      ->get();

    $title = $post->title;

    return view('pages.blog.blog_details', compact('title', 'post', 'relatedPosts'));
  }

  /**
   * Display all categories
   */
  public function categories()
  {
    $title = "Browse Categories";

    // Get all categories with article count
    $categories = BlogCategory::where('status', 1)
      ->withCount(['articles as blog_posts_count' => function($query) {
        $query->where('status', 1);
      }])
      ->get()
      ->map(function($category) {
        $category->color = 'bg-gradient-to-br from-primary/20 to-accent/20';
        return $category;
      });

    return view('pages.categories', compact('title', 'categories'));
  }

  /**
   * Display posts by category
   */
  public function category($slug)
  {
    // Get the category
    $category = BlogCategory::where('slug', $slug)
      ->where('status', 1)
      ->firstOrFail();

    // Get all categories for filter
    $categories = BlogCategory::where('status', 1)->get();

    // Get posts in this category
    $posts = BlogArticle::where('category_id', $category->id)
      ->where('status', 1)
      ->with(['category', 'author'])
      ->latest()
      ->paginate(9);

    $title = $category->title;

    return view('pages.blog.category', compact('title', 'categories', 'posts', 'category'));
  }
  /**
   * Display about page
   */
  public function about()
  {
    $title = "About Us";
    return view('pages.about', compact('title'));
  }

  /**
   * Display contact page
   */
  public function contact()
  {
    $title = "Contact Us";
    return view('pages.contact', compact('title'));
  }
}
