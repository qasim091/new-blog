<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebSetting;
use App\Models\Page;
// use App\Models\Tags;
use App\Models\User;
use App\Models\Comment;
use App\Models\BlogArticle;
use App\Models\Slider;
use App\Models\Banner;
use App\Models\HomePageCategory;
use App\Models\BlogCategory;
use App\Models\DynamicCategory;
use App\Models\HomePageCategoryHighlight;
use App\Models\HomeAd;
use Illuminate\Support\Facades\Auth;
//For Schema
use Spatie\SchemaOrg\Schema;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOTools; // Complete SEO tool for flexibility

class WebsiteController extends Controller
{
/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/
public function home()
{

    $page = Page::where('slug', 'home')->first();
    $setting = WebSetting::first();

    $site_name = config('seotools.opengraph.defaults.site_name', config('app.name'));
    $meta_title = $page->page_name ?? "$site_name - Home";
    $meta_desc = $page->meta_desc ?? "Welcome to $site_name – Your source for quality articles and blog posts.";
    $meta_image = asset('storage/blog/article/best-real-estate-seo-tips-for-2025.jpg');
    $currentUrl = url()->current();

    // ========== SEO ==========
    // SEOTools::setTitle($meta_title);
    SEOTools::setDescription($meta_desc);
    SEOTools::setCanonical($currentUrl);

    SEOTools::opengraph()
        ->setTitle($meta_title)
        ->setDescription($meta_desc)
        ->setUrl($currentUrl)
        ->setSiteName($site_name)
        ->addImage($meta_image)
        ->addProperty('updated_time', now()->toIso8601String());

    SEOTools::twitter()
        ->setTitle($meta_title)
        ->setDescription($meta_desc)
        ->setImage($meta_image)
        ->setUrl($currentUrl)
        ->setType('summary_large_image');


    // ========== JSON-LD SCHEMA ==========
    $schemaMarkup = json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => $site_name,
        'url' => url('/'),
        'description' => $meta_desc,
        'inLanguage' => 'en-US',
        'publisher' => [
            '@type' => 'Organization',
            'name' => $site_name,
            'logo' => [
                '@type' => 'ImageObject',
                'url' => asset('storage/settings/logo.png'),
                'width' => 300,
                'height' => 80,
            ],
        ],
        // 'potentialAction' => [
        //     '@type' => 'SearchAction',
        //     'target' => route('blog.search') . '?q={search_term_string}',
        //     'query-input' => 'required name=search_term_string',
        // ],
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    // Get featured post
    $featuredPost = BlogArticle::where('status', 1)
      ->where('is_featured', true)
      ->with(['category', 'author'])
      ->latest()
      ->first();
    $webPageSchemaMarkup = json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'WebPage',
        '@id' => $currentUrl . '#webpage',
        'mainEntityOfPage' => [
            '@type' => 'WebPage',
            '@id' => $currentUrl,
        ],
        'name' => $meta_title,
        'headline' => $meta_title,
        'url' => $currentUrl,
        'description' => $meta_desc,
        'inLanguage' => 'en-US',
        'datePublished' => now()->toDateString(),
        'dateModified' => now()->toDateString(),
        'image' => [
            '@type' => 'ImageObject',
            'url' => $meta_image,
            'width' => 1200,
            'height' => 600,
        ],
        'publisher' => [
            '@type' => 'Organization',
            'name' => $site_name,
            'logo' => [
                '@type' => 'ImageObject',
                'url' => asset('storage/settings/logo.png'),
                'width' => 300,
                'height' => 80,
            ],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

    $organizationSchemaMarkup = json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => $site_name,
        'url' => url('/'),
        'logo' => [
            '@type' => 'ImageObject',
            'url' => asset('storage/settings/logo.png'),
            'width' => 300,
            'height' => 80,
        ],
        'sameAs' => array_filter([
            $setting->site_fb ?? null,
            $setting->site_twitter ?? null,
            $setting->site_instagram ?? null,
        ]),
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

    $breadcrumbsMarkup = json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [[
            '@type' => 'ListItem',
            'position' => 1,
            'name' => 'Home',
            'item' => url('/'),
        ]],
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

    // ========== Page Data ==========
$categories = BlogCategory::withCount(['articles' => fn ($q) => $q->where('status', '1')])
    ->where('status', '1')
    ->orderBy('updated_at', 'desc') // changed from views_count to updated_at
    ->take(4)
    ->get();

$blogs = BlogArticle::with(['author', 'category'])
    ->where('status', '1')
    ->whereHas('category', fn ($q) => $q->where('status', '1'))
    ->orderBy('updated_at', 'desc') // changed from views_count to updated_at
    ->paginate(10);

$recentposts = BlogArticle::where('status', '1')
    ->with(['category', 'author'])
    ->orderBy('updated_at', 'desc')
    ->paginate(9); // 9 posts per page to work well with 3-column grid
    $banner = Banner::first() ?? new Banner(['image' => 'default-banner.jpg']);

    // Get active home page ads
    $adsAfter3rd = HomeAd::getActiveAdsByPosition('home_after_3rd');
    $adsAfter7th = HomeAd::getActiveAdsByPosition('home_after_7th');

    return view('pages.home', compact(
        'schemaMarkup',
        'webPageSchemaMarkup',
        'organizationSchemaMarkup',
        'breadcrumbsMarkup',
        'banner',
        'page',
        'setting',
        'categories',
        'blogs',
        'recentposts',
        'featuredPost',
        'adsAfter3rd',
        'adsAfter7th'
    ));
}





/*
|--------------------------------------------------------------------------
| Contact
|--------------------------------------------------------------------------
*/
public function contact()
{
    $page = Page::where('slug', 'contact-us')->firstOrFail();
    $setting = WebSetting::first();

    $site_name = config('seotools.opengraph.defaults.site_name', config('app.name'));
    $meta_title = $page->page_name ?? "$site_name - Contact Us";
    $meta_desc = $page->meta_desc ?? "Get in touch with $site_name for inquiries, support, or collaborations.";
    $meta_image = asset('storage/settings/' . ($setting->site_logo ?? 'logo.png'));
    $current_url = url()->current();
    $twitter_handle = '@EstateGuideBlog'; // ✅ Update with your real handle or leave empty if you don’t have

    // === SEO Meta Tags ===
    // SEOTools::setTitle($meta_title);
    SEOTools::setDescription($meta_desc);
    SEOTools::setCanonical($current_url);

    // === OpenGraph Tags ===
    SEOTools::opengraph()
        ->setTitle($meta_title)
        ->setDescription($meta_desc)
        ->setUrl($current_url)
        ->addImage([
            'url' => $meta_image,
            'width' => 300,
            'height' => 80
        ])
        ->setSiteName($site_name)
        ->addProperty('type', 'website'); // ✅ Use 'website' for Contact page

    // === Twitter Tags ===
    SEOTools::twitter()
        ->setTitle($meta_title)
        ->setDescription($meta_desc)
        ->setUrl($current_url)
        ->setImage($meta_image)
        ->setSite($twitter_handle);

    // === JSON-LD Schema.org Markup ===
    $schema = [
        "@context" => "https://schema.org",
        "@type" => "ContactPage",
        "name" => $meta_title,
        "description" => $meta_desc,
        "url" => $current_url,
        "inLanguage" => "en-US",
        "dateModified" => now()->toIso8601String(),
        "mainEntityOfPage" => [
            "@type" => "WebPage",
            "@id" => $current_url
        ],
        "publisher" => [
            "@type" => "Organization",
            "name" => $site_name,
            "logo" => [
                "@type" => "ImageObject",
                "url" => $meta_image,
                "width" => 300,
                "height" => 80
            ]
        ],
        // ✅ This is your contact form schema
        "potentialAction" => [
            "@type" => "CommunicateAction",
            "name" => "Contact Form Submission",
            "target" => [
                "@type" => "EntryPoint",
                "urlTemplate" => $current_url . "#contact-form", // adjust ID if needed
                "inLanguage" => "en-US",
                "actionPlatform" => [
                    "http://schema.org/DesktopWebPlatform",
                    "http://schema.org/MobileWebPlatform"
                ]
            ]
        ]
    ];

    $schemaMarkup = json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

    return view('pages.contact', compact('page', 'setting', 'schemaMarkup'));
}


public function about()
{

    $page = Page::where('slug', 'about-us')->firstOrFail();
    $setting = WebSetting::first();

    $site_name = config('seotools.opengraph.defaults.site_name', config('app.name'));
    $meta_title = $page->page_name ?? "$site_name - About Us";
    $meta_desc = $page->meta_desc ?? "Learn more about $site_name — our mission, team, and values.";
    $meta_image = asset('storage/settings/' . ($setting->site_logo ?? 'logo.png'));
  $current_url = url()->current();
    // === SEO Meta Tags ===
    // SEOTools::setTitle($meta_title);
    SEOTools::setDescription($meta_desc);
    // === OpenGraph Tags ===
    SEOTools::opengraph()
        ->setTitle($meta_title)
        ->setDescription($meta_desc)
        ->setUrl($current_url)
        ->addImage($meta_image)
        ->setSiteName($site_name)
        ->addProperty('type', 'website'); // or "AboutPage" if more suitable

    // === Twitter Cards ===
    SEOTools::twitter()
        ->setTitle($meta_title)
        ->setDescription($meta_desc)
        ->setUrl($current_url)
        ->setImage($meta_image)
        ->setSite('@' . str_replace(' ', '', $site_name)); // Make sure your brand has a real Twitter handle

    // === Schema.org JSON-LD (AboutPage) ===
    $schema = [
        "@context" => "https://schema.org",
        "@type" => "AboutPage",
        "name" => $meta_title,
        "description" => $meta_desc,
        "url" => $current_url,
        "inLanguage" => "en-US",
        "datePublished" => "2025-04-14T08:50:45+00:00", // Optional: Set if known
        "dateModified" => now()->toIso8601String(), // dynamically sets modified date
        "mainEntityOfPage" => [
            "@type" => "WebPage",
            "@id" => $current_url
        ],
        "publisher" => [
            "@type" => "Organization",
            "name" => $site_name,
            "logo" => [
                "@type" => "ImageObject",
                "url" => $meta_image,
                "width" => 300,
                "height" => 80
            ]
        ]
    ];

    $schemaMarkup = json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

    return view('pages.about', compact('page', 'setting', 'schemaMarkup'));
}


/*
|--------------------------------------------------------------------------
| Disclaimer
|--------------------------------------------------------------------------
*/
public function disclaimer()
{
    $page = Page::where('slug', 'disclaimer')->firstOrFail();
    $setting = WebSetting::first();

    $site_name = config('seotools.opengraph.defaults.site_name', config('app.name'));
    $meta_title = $page->page_name ?? "$site_name - Disclaimer";
    $meta_desc = $page->meta_desc ?? "Read the disclaimer of $site_name covering content usage, accuracy, and liability limits.";
    $meta_image = asset('storage/settings/' . ($setting->site_logo ?? 'logo.png'));
    $current_url = url()->current();

    // === SEO Meta Tags ===
    // SEOTools::setTitle($meta_title);
    SEOTools::setDescription($meta_desc);
    SEOTools::setCanonical($current_url);

    // === Open Graph ===
    SEOTools::opengraph()
        ->setTitle($meta_title)
        ->setDescription($meta_desc)
        ->setUrl($current_url)
        ->addImage($meta_image)
        ->setSiteName($site_name)
        ->addProperty('type', 'WebPage');

    // === Twitter Card ===
    SEOTools::twitter()
        ->setTitle($meta_title)
        ->setDescription($meta_desc)
        ->setUrl($current_url)
        ->setImage($meta_image)
        ->setSite('@' . preg_replace('/\s+/', '', $site_name));

    // === JSON-LD Schema ===
    $schema = [
        "@context" => "https://schema.org",
        "@type" => "WebPage",
        "name" => $meta_title,
        "description" => $meta_desc,
        "url" => $current_url,
        "inLanguage" => "en-US",
        "datePublished" => optional($page->created_at)->toIso8601String(),
        "dateModified" => optional($page->updated_at)->toIso8601String(),
        "mainEntityOfPage" => [
            "@type" => "WebPage",
            "@id" => $current_url
        ],
        "about" => [
            "@type" => "Thing",
            "name" => "Website Disclaimer Policy"
        ],
        "publisher" => [
            "@type" => "Organization",
            "name" => $site_name,
            "logo" => [
                "@type" => "ImageObject",
                "url" => $meta_image,
                "width" => 300,
                "height" => 80
            ]
        ]
    ];

    $schemaMarkup = json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

    return view('pages.disclaimer', compact('page', 'setting', 'schemaMarkup'));
}



/*
|--------------------------------------------------------------------------
| About Us
|--------------------------------------------------------------------------
*/
public function write()
{
    $page = Page::where('slug', 'write-for-us')->first();
    $setting = WebSetting::first();
    return view('pages.writeforus', compact('page','setting'));
}
/*
|--------------------------------------------------------------------------
| Author
|--------------------------------------------------------------------------
*/
public function authors(Request $request, $slug = null)
{
    $page = Page::where('slug', 'authors')->first();
    $setting = WebSetting::first();
    $recentposts = BlogArticle::where('status', '1')
        ->whereHas('category', function ($query) {
            $query->where('status', '1'); // Ensure the category is approved
        })
        ->orderby('created_at', 'desc')
        ->take(4)
        ->get();

    if ($slug) {
        // Fetch the author by slug
        $author = User::where('slug', $slug)->firstOrFail();

        // Fetch articles by the specific author, ensuring both article and category are approved
        $blogs = BlogArticle::where('author_id', $author->id)
            ->where('status', '1') // Ensure the article is 1
            ->whereHas('category', function ($query) {
                $query->where('status', '1'); // Ensure the category is 1
            })
            ->with('author')
            ->paginate(10);
    } else {
        // Fetch all 1 articles, ensuring both article and category are 1
        $blogs = BlogArticle::where('status', '1') // Ensure the article is 1
            ->whereHas('category', function ($query) {
                $query->where('status', '1'); // Ensure the category is approved
            })
            ->with('author')
            ->paginate(10);
        $author = null; // No specific author is selected
    }

    return view('pages.authors', compact('page', 'setting', 'blogs', 'recentposts', 'author'));
}



/*
|--------------------------------------------------------------------------
| Blog List
|--------------------------------------------------------------------------
*/
public function bloglist(Request $request, $categorySlug = null)
{
    $page = Page::where('slug', 'blog-listing')->first();
    $setting = WebSetting::first();
    $site_name = config('seotools.opengraph.defaults.site_name', config('app.name'));
    if ($categorySlug) {
        $category = BlogCategory::where('slug', $categorySlug)
            ->where('status', 1)
            ->first();

        if ($category) {
            $blogs = BlogArticle::where('category_id', $category->id)
                ->where('status', 1)
                ->orderBy('updated_at', 'desc') // newest first
                ->paginate(10);
        } else {
            $blogs = collect();
        }
    } else {
        $blogs = BlogArticle::where('status', 1)
            ->whereHas('category', function ($query) {
                $query->where('status', 1);
            })
            ->orderBy('updated_at', 'desc') // newest first
            ->paginate(10);
    }

    // Attach instructor data
    foreach ($blogs as $bc) {
        $bc->instructor = User::find($bc->author_id);
    }

    // $tags = Tags::all();
    $categories = BlogCategory::orderby('views_count', 'desc')->take(7)->get();
    $recentposts = BlogArticle::orderby('created_at', 'desc')->take(4)->get();

    // SEO Meta Info
    $meta_title = $page->page_name ?? "Latest Blog Articles - EstateGuideBlog";
    $meta_desc = $page->meta_desc ?? "Browse fresh articles on real estate, finance, health, and more. Updated weekly on EstateGuideBlog.";

    // SEOTools::setTitle($meta_title);
    SEOTools::setDescription($meta_desc);
    SEOTools::setCanonical(url()->current());

    // Open Graph
    SEOTools::opengraph()->setTitle($meta_title);
    SEOTools::opengraph()->setDescription($meta_desc);
    SEOTools::opengraph()->setUrl(url()->current());
    SEOTools::opengraph()->addImage(asset('storage/' . ($page->image ?? 'default.png')));
    SEOTools::opengraph()->addProperty('type', 'website');
    SEOTools::opengraph()->addProperty('site_name', 'EstateGuideBlog');

    // Twitter Card
    SEOTools::twitter()->setTitle($meta_title);
    SEOTools::twitter()->setDescription($meta_desc);
    SEOTools::twitter()->setUrl(url()->current());
    SEOTools::twitter()->setImage(asset('storage/' . ($page->image ?? 'default.png')));
    SEOTools::twitter()->setSite('@YourTwitterHandle'); // Replace with real handle
    SEOTools::twitter()->setType('summary_large_image');


    // Schema: Blog List
    $schema = [
    "@context" => "https://schema.org",
    "@type" => "ItemList",
    "itemListOrder" => "http://schema.org/ItemListOrderDescending",
    "itemListElement" => []
];

foreach ($blogs as $index => $blog) {
    $schema['itemListElement'][] = array_filter([
        "@type" => "ListItem",
        "position" => $index + 1,
        "url" => route('blog.show', $blog->slug),
        "name" => $blog->title,
        "description" => $blog->meta_desc ?? $blog->excerpt,
        "image" => $blog->image ? asset('storage/' . $blog->image) : null,
        "item" => [
            "@type" => "Article",
            "headline" => $blog->title,
            "description" => $blog->meta_desc ?? $blog->excerpt,
            "datePublished" => $blog->created_at->toIso8601String(),
            "author" => [
                "@type" => "Person",
                "name" => $blog->instructor->name ?? "Admin"
            ]
        ]
    ]);
}

// ✅ Add mainEntity here (AFTER foreach)
$schema['mainEntity'] = [
    "@type" => "ItemList",
    "itemListOrder" => "http://schema.org/ItemListOrderDescending",
    "numberOfItems" => $blogs->count(),
];

// ✅ Now encode it to JSON
$schemaMarkup = json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);


    // Schema: Breadcrumbs
    $breadcrumbs = [
        "@context" => "https://schema.org",
        "@type" => "BreadcrumbList",
        "itemListElement" => [
            [
                "@type" => "ListItem",
                "position" => 1,
                "name" => "Home",
                "item" => route('home')
            ],
            [
                "@type" => "ListItem",
                "position" => 2,
                "name" => "Blog",
                "item" => route('bloglist')
            ]
        ]
    ];

    if ($categorySlug && isset($category)) {
        $breadcrumbs['itemListElement'][] = [
            "@type" => "ListItem",
            "position" => 3,
            "name" => $category->title,
            "item" => route('bloglist', $category->slug)
        ];
    }

    $breadcrumbsMarkup = json_encode($breadcrumbs, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

    // Get active blog page ads
    $adsAfter3rd = HomeAd::getActiveAdsByPosition('blog_after_3rd');
    $adsAfter7th = HomeAd::getActiveAdsByPosition('blog_after_7th');
    
    // Get category buttons - filter by current category if viewing a specific category
    if ($categorySlug && isset($category)) {
        // Show buttons that are linked to the current category
        $categoryButtons = \App\Models\BlogCategoryButton::active()
            ->where('category_id', $category->id)
            ->ordered()
            ->get();
    } else {
        // On main blog page, show buttons that are not linked to any specific category
        $categoryButtons = \App\Models\BlogCategoryButton::active()
            ->whereNull('category_id')
            ->ordered()
            ->get();
    }
    
    $currentCategory = $categorySlug && isset($category) ? $category : null;
    
    return view("pages.blog.blog", compact(
        'page', 'setting', 'blogs', 'categories', 'recentposts', 'schemaMarkup', 'breadcrumbsMarkup',
        'adsAfter3rd', 'adsAfter7th', 'categoryButtons', 'currentCategory'
    ));
}

/*
|--------------------------------------------------------------------------
| Blog Catgegories
|--------------------------------------------------------------------------
*/
public function categorylist(Request $request, $categorySlug = null)
{
    $page = Page::where('slug', 'categories-listing')->firstOrFail();
    $setting = WebSetting::first();
    $site_name = config('seotools.opengraph.defaults.site_name', config('app.name'));
    $site_logo = asset('storage/settings/' . ($setting->site_logo ?? 'default.png'));
    $current_url = url()->current();

    // Fetch categories
$categories = BlogCategory::where('status', '1')
    ->withCount(['articles' => function ($query) {
        $query->where('status', '1');
    }])
    ->orderBy('updated_at', 'desc') // added
    ->take(6)
    ->get();

    // Set defaults
    $meta_title = $page->meta_title ?? "Browse Blog Categories - $site_name";
    $meta_desc = $page->meta_desc ?? "Explore our blog categories at $site_name — full of helpful guides, industry news, and tips.";

    $category = null;
    $categoryArticles = null;

    // Category-specific content
if ($categorySlug) {
    $category = BlogCategory::where('slug', $categorySlug)->firstOrFail();

    $meta_title = $category->meta_title ?? "{$category->name} - Blog Category | $site_name";
    $meta_desc = $category->meta_desc ?? "Discover articles under the category {$category->name} at $site_name.";
    $current_url = url()->current();

    $categoryArticles = BlogArticle::where('status', '1')
        ->where('category_id', $category->id)
        ->with(['author', 'category'])
        ->orderByDesc('updated_at') // changed from created_at
        ->paginate(10);
}

// All articles fallback
$allArticles = BlogArticle::where('status', '1')
    ->with(['author', 'category'])
    ->orderByDesc('updated_at') // changed from created_at
    ->paginate(10);


    // === SEO Meta ===
    // SEOTools::setTitle($meta_title);
    SEOTools::setDescription($meta_desc);
    SEOTools::setCanonical($current_url);

    // === OpenGraph ===
    SEOTools::opengraph()
        ->setTitle($meta_title)
        ->setDescription($meta_desc)
        ->setUrl($current_url)
        ->addImage([
            'url' => $site_logo,
            'width' => 300,
            'height' => 80
        ])
        ->setSiteName($site_name)
        ->addProperty('type', 'CollectionPage');

    // === Twitter Card ===
    SEOTools::twitter()
        ->setTitle($meta_title)
        ->setDescription($meta_desc)
        ->setSite('@EstateGuideBlog') // ✅ Replace with your real Twitter handle
        ->setImage($site_logo)
        ->setType('summary_large_image');

    // === Schema.org (CollectionPage or BlogCategory Page) ===
    $schemaData = [
        "@context" => "https://schema.org",
        "@type" => "CollectionPage",
        "name" => $meta_title,
        "description" => $meta_desc,
        "url" => $current_url,
        "inLanguage" => "en-US",
        "mainEntityOfPage" => [
            "@type" => "WebPage",
            "@id" => $current_url
        ],
        "publisher" => [
            "@type" => "Organization",
            "name" => $site_name,
            "logo" => [
                "@type" => "ImageObject",
                "url" => $site_logo,
                "width" => 300,
                "height" => 80
            ]
        ]
    ];

    $schemaMarkup = json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

    return view('pages.categories', compact(
        'page',
        'setting',
        'categories',
        'allArticles',
        'categoryArticles',
        'categorySlug',
        'meta_title',
        'meta_desc',
        'schemaMarkup'
    ));
}


/*
|--------------------------------------------------------------------------
| Blog Show
|--------------------------------------------------------------------------
*/
public function blogshow(BlogArticle $articleArticle, $slug)
{
    $setting = WebSetting::first();
    $article = BlogArticle::where('slug', $slug)->firstOrFail();

    $page = ['page_name' => $article->page_title];
    $meta_title = $article->title ?? "Welcome to Our Main article";
    $meta_desc = $article->meta_desc ?? "Description of the main article";
    $instructor = User::find($article->author_id);
    $site_name = config('seotools.opengraph.defaults.site_name', config('app.name'));
    // $tags = Tags::all();
    $categories = BlogCategory::orderby('views_count', 'desc')->where('status','1')->take(7)->get();
    $recentposts = BlogArticle::orderby('updated_at', 'desc')->where('status','1')->take(4)->get();

    // $comments = $article->comments()
    //     ->whereNull('parent_id')
    //     ->where('is_approved', true)
    //     ->with(['replies' => function ($query) {
    //         $query->where('is_approved', true);
    //     }])
    //     ->get();

    // Get related posts from same category
    $relatedPosts = BlogArticle::where('category_id', $article->category_id)
      ->where('id', '!=', $article->id)
      ->where('status', 1)
      ->with(['category', 'author'])
      ->latest()
      ->take(3)
      ->get();

    // ------------------------------
    // ✅ SEO Meta and Open Graph
    // ------------------------------
    // SEOTools::setTitle($meta_title);
    SEOTools::setDescription($meta_desc);
    SEOTools::setCanonical(url()->current());

    SEOTools::opengraph()->setTitle($meta_title);
    SEOTools::opengraph()->setDescription($meta_desc);
    SEOTools::opengraph()->setUrl(url()->current());
    SEOTools::opengraph()->addProperty('type', 'article');
    SEOTools::opengraph()->addImage(asset('storage/' . ($article->image ?? 'default.png')));

    SEOTools::twitter()->setTitle($meta_title);
    SEOTools::twitter()->setDescription($meta_desc);
    SEOTools::twitter()->setImage(asset('storage/' . ($article->image ?? 'default.png')));
    SEOTools::twitter()->setUrl(url()->current());
    SEOTools::twitter()->setSite('@YourTwitterHandle'); // Replace with real handle
    SEOTools::twitter()->setType('summary_large_image');

    // ------------------------------
    // ✅ Article Schema JSON-LD
    // ------------------------------
    $schemaData = [
        "@context" => "https://schema.org",
        "@type" => "NewsArticle", // ✅ More specific than Article
        "headline" => $article->title,
        "description" => $meta_desc,
        "mainEntityOfPage" => [
            "@type" => "WebPage",
            "@id" => url()->current()
        ],
        "url" => url()->current(),
        "image" => asset('storage/' . ($article->image ?? 'default.png')),
        "datePublished" => $article->created_at->toIso8601String(),
        "dateModified" => $article->updated_at->toIso8601String(),
        "articleBody" => strip_tags($article->description), // ✅ Add full body text
        "author" => [
            "@type" => "Person",
            "name" => $instructor->name ?? 'Admin',
            // "sameAs" => [
            //     $instructor->twitter ? "https://twitter.com/{$instructor->twitter}" : null,
            //     $instructor->insta ? "https://instagram.com/{$instructor->insta}" : null,
            //     // Add more social links if available
            // ]
        ],
        "publisher" => [
            "@type" => "Organization",
            "@id" => route('home') . '#organization', // ✅ Added @id
            "name" => $site_name,
            "logo" => [
                "@type" => "ImageObject",
                "url" => asset('storage/settings/' . ($setting->site_logo ?? 'default.png'))
            ]
        ],
        "articleSection" => $article->category->name ?? "Blog",
    ];

    // Remove null values (for example, missing social URLs)
    // $schemaData['author']['sameAs'] = array_values(array_filter($schemaData['author']['sameAs']));

    $schemaMarkup = json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

    // ------------------------------
    // ✅ Breadcrumb Schema JSON-LD
    // ------------------------------
    $breadcrumbs = [
        "@context" => "https://schema.org",
        "@type" => "BreadcrumbList",
        "itemListElement" => [
            [
                "@type" => "ListItem",
                "position" => 1,
                "name" => "Home",
                "item" => route('home')
            ],
            [
                "@type" => "ListItem",
                "position" => 2,
                "name" => "Blog",
                "item" => route('bloglist')
            ],
            [
                "@type" => "ListItem",
                "position" => 3,
                "name" => $article->title,
                "item" => url()->current()
            ]
        ]
    ];

    $breadcrumbsMarkup = json_encode($breadcrumbs, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

    // Get active blog detail page ads
    $adsAfterFirstParagraph = HomeAd::getActiveAdsByPosition('blog_detail_after_first_paragraph');
    $adsMiddleContent = HomeAd::getActiveAdsByPosition('blog_detail_middle_content');
    $adsBeforeLast2Tags = HomeAd::getActiveAdsByPosition('blog_detail_before_last_2_tags');

    return view("pages.blog.blog_details", compact(
        'instructor',
        'page',
        'relatedPosts',
        'setting',
        'article',
        // 'tags',
        'categories',
        'recentposts',
        // 'comments',
        'schemaMarkup',
        'breadcrumbsMarkup',
        'adsAfterFirstParagraph',
        'adsMiddleContent',
        'adsBeforeLast2Tags'
    ));
}



/*
|--------------------------------------------------------------------------
| Search
|--------------------------------------------------------------------------
*/

public function search(Request $request)
{
    $page = Page::where('slug', 'search')->first();
    $setting = WebSetting::first();
    $query = $request->input('query');

    if (!$query) {
        return redirect()->back()->with('error', 'Please enter a search term.');
    }

    // Search for approved blogs with the query in title or description
    $blogs = BlogArticle::with('category')
        ->where('approval', 'Approved')
        ->where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('title', 'LIKE', "%{$query}%")
                         ->orWhere('description', 'LIKE', "%{$query}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(3);

    return view('pages.search', compact('page', 'setting', 'blogs', 'query'));
}

/*
|--------------------------------------------------------------------------
| Error 404
|--------------------------------------------------------------------------
*/

public function error(Request $request)
{
    $page = Page::where('slug', '404')->first();
    $setting = WebSetting::first();
    return view('pages.404', compact('page', 'setting'));
}
/*
|--------------------------------------------------------------------------
| Privacy Policy
|--------------------------------------------------------------------------
*/

public function privacy(Request $request)
{
    $page = Page::where('slug', 'privacy-policy')->firstOrFail();
    $setting = WebSetting::first();

    $site_name = config('seotools.opengraph.defaults.site_name', config('app.name'));
    $meta_title = $page->page_name ?? "$site_name - Privacy Policy";
    $meta_desc = $page->meta_desc ?? "Read the privacy policy of $site_name to understand how we collect, use, store, and protect your data.";
    $meta_image = asset('storage/settings/' . ($setting->site_logo ?? 'logo.png'));
    $current_url = url()->current();
    $twitter_handle = '@EstateGuideBlog'; // ✅ Replace with actual if available

    // === SEO Meta Tags ===
    // SEOTools::setTitle($meta_title);
    SEOTools::setDescription($meta_desc);
    SEOTools::setCanonical($current_url);

    // === OpenGraph Tags ===
    SEOTools::opengraph()
        ->setTitle($meta_title)
        ->setDescription($meta_desc)
        ->setUrl($current_url)
        ->addImage([
            'url' => $meta_image,
            'width' => 300,
            'height' => 80
        ])
        ->setSiteName($site_name)
        ->addProperty('type', 'WebPage');

    // === Twitter Card Tags ===
    SEOTools::twitter()
        ->setTitle($meta_title)
        ->setDescription($meta_desc)
        ->setUrl($current_url)
        ->setImage($meta_image)
        ->setSite($twitter_handle);

    // === JSON-LD Schema.org Markup ===
    $schema = [
        "@context" => "https://schema.org",
        "@type" => "WebPage",
        "name" => $meta_title,
        "description" => $meta_desc,
        "url" => $current_url,
        "inLanguage" => "en-US",
        "dateModified" => now()->toIso8601String(),
        "mainEntity" => [
            "@type" => "CreativeWork",
            "name" => "Privacy Policy",
            "description" => "This page outlines how $site_name collects, uses, stores, and protects user data in compliance with data protection laws."
        ],
        "mainEntityOfPage" => [
            "@type" => "WebPage",
            "@id" => $current_url
        ],
        "publisher" => [
            "@type" => "Organization",
            "name" => $site_name,
            "logo" => [
                "@type" => "ImageObject",
                "url" => $meta_image,
                "width" => 300,
                "height" => 80
            ]
        ]
    ];

    $schemaMarkup = json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

    return view('pages.privacy-policy', compact('page', 'setting', 'schemaMarkup'));
}



public function newone(Request $request)
{
    return view('pages.author_dashboard.dashboard');
}
/*
|--------------------------------------------------------------------------
| Terms Conditions
|--------------------------------------------------------------------------
*/

public function termsconditions(Request $request)
{
    $page = Page::where('slug', 'terms-and-conditions')->first();
    $setting = WebSetting::first();

    $site_name = config('seotools.opengraph.defaults.site_name', config('app.name'));
    $meta_title = $page->page_name ?? "$site_name - Terms & Conditions";
    $meta_desc = $page->meta_desc ?? "Review the terms and conditions of using $site_name, including user obligations and legal rights.";
    $meta_image = asset('storage/settings/' . ($setting->site_logo ?? 'logo.png'));
    $twitter_handle = $setting->site_twitter ?? '@YourSiteHandle'; // <- Adjust manually

    // === SEO Meta Tags ===
    // SEOTools::setTitle($meta_title);
    SEOTools::setDescription($meta_desc);
    SEOTools::setCanonical(url()->current());
    // === OpenGraph Meta ===
    SEOTools::opengraph()
        ->setTitle($meta_title)
        ->setDescription($meta_desc)
        ->setUrl(url()->current())
        ->setType('website')
        ->addImage($meta_image)
        ->setSiteName($site_name);

    // === Twitter Cards ===
    SEOTools::twitter()
        ->setTitle($meta_title)
        ->setDescription($meta_desc)
        ->setUrl(url()->current())
        ->setImage($meta_image)
        ->setSite($twitter_handle);

    // === Schema.org WebPage (Main) ===
$schema = [
    "@context" => "https://schema.org",
    "@type" => "WebPage",
    "name" => $meta_title,
    "description" => $meta_desc,
    "url" => url()->current(),
    "inLanguage" => "en-US",
    "datePublished" => optional($page->created_at)->toIso8601String(),
    "dateModified" => optional($page->updated_at)->toIso8601String(),
    "mainEntityOfPage" => [
        "@type" => "WebPage",
        "@id" => url()->current()
    ]
];

    $schemaMarkup = json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

    // === Schema.org WebPage (CreativeWork Extension) ===
    $webPageSchema = [
        "@context" => "https://schema.org",
        "@type" => "CreativeWork",
        "name" => "Terms and Conditions",
        "description" => "This page explains the terms and conditions for using $site_name, including your rights and responsibilities.",
        "inLanguage" => "en-US",
        "url" => url()->current()
    ];
    $webPageSchemaMarkup = json_encode($webPageSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

    // === Schema.org Organization Logo ===
    $organizationSchema = [
        "@context" => "https://schema.org",
        "@type" => "Organization",
        "name" => $site_name,
        "url" => url('/'),
        "logo" => [
            "@type" => "ImageObject",
            "url" => $meta_image,
            "width" => 300,
            "height" => 80
        ]
    ];
    $organizationSchemaMarkup = json_encode($organizationSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

    // === Schema.org BreadcrumbList ===
    $breadcrumbs = [
        "@context" => "https://schema.org",
        "@type" => "BreadcrumbList",
        "itemListElement" => [
            [
                "@type" => "ListItem",
                "position" => 1,
                "name" => "Home",
                "item" => url('/')
            ],
            [
                "@type" => "ListItem",
                "position" => 2,
                "name" => "Terms & Conditions",
                "item" => url()->current()
            ]
        ]
    ];
    $breadcrumbsMarkup = json_encode($breadcrumbs, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

    return view('pages.terms-and-conditions', compact(
        'page',
        'setting',
        'schemaMarkup',
        'webPageSchemaMarkup',
        'organizationSchemaMarkup',
        'breadcrumbsMarkup'
    ));
}





}
