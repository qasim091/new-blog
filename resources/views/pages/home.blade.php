@extends('layouts2.app')

@section('title', "$page->page_name")

@section('content')
<div class="min-h-screen">
    <!-- Hero Section -->
    @php
    $setting = App\Models\WebSetting::first();
@endphp
    <section class="hero-gradient py-20 md:py-32 relative overflow-hidden">
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto text-center space-y-8 animate-fade-in">
                <div class="inline-flex items-center gap-2 glass-strong px-5 py-2.5 rounded-full shadow-[var(--shadow-subtle)] animate-scale-in">
                    <svg class="w-4 h-4 text-primary animate-glow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                    </svg>
                    <span class="text-sm font-semibold bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">
                        Welcome to ModernBlog
                    </span>
                </div>

                <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold leading-tight tracking-tight">
                    Share Your <span class="gradient-text-accent">Story</span>
                    <br />
                    with the World
                </h1>

                <p class="text-xl md:text-2xl text-muted-foreground max-w-2xl mx-auto leading-relaxed">
                    Discover insightful articles, tutorials, and thoughts from passionate writers across technology, design, and business.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center pt-4">
                    <a href="{{ route('bloglist') }}" class="btn-gradient text-white shadow-[var(--shadow-hover)] hover:shadow-[var(--shadow-elevated)] hover:scale-105 transition-bounce px-8 py-3 text-base font-semibold rounded-lg inline-flex items-center justify-center">
                        Explore Articles
                        <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                    <a href="{{ route('about') }}" class="glass-strong border-2 hover:bg-background/50 transition-bounce hover:scale-105 px-8 py-3 text-base font-semibold rounded-lg inline-flex items-center justify-center">
                        Learn More
                    </a>
                </div>
            </div>
        </div>

        <!-- Floating decorations with glow -->
        <div class="absolute top-20 left-10 w-32 h-32 bg-primary/30 rounded-full blur-3xl animate-float animate-glow"></div>
        <div class="absolute bottom-20 right-10 w-40 h-40 bg-accent/25 rounded-full blur-3xl animate-float animate-glow" style="animation-delay: 1s"></div>
        <div class="absolute top-40 right-20 w-24 h-24 bg-secondary/20 rounded-full blur-3xl animate-float" style="animation-delay: 2s"></div>
    </section>

    <!-- Featured Post -->
    @if($featuredPost)
    <section class="container mx-auto px-4 -mt-16 relative z-20">
        <div class="glass-card p-8 md:p-12 group relative overflow-hidden shadow-[var(--shadow-elevated)]">
            <div class="absolute inset-0 bg-gradient-to-br from-primary/5 via-transparent to-accent/5 opacity-0 group-hover:opacity-100 transition-smooth pointer-events-none"></div>

            <div class="flex items-center gap-2 mb-6 relative z-10">
                <svg class="w-5 h-5 text-primary animate-glow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
                <span class="font-bold text-primary text-lg">Featured Article</span>
            </div>

            <div class="grid md:grid-cols-2 gap-8 items-center relative z-10">
                <div class="order-2 md:order-1 space-y-5">
                    <span class="inline-block glass-strong px-4 py-2 rounded-full text-sm font-bold shadow-[var(--shadow-subtle)]">
                        {{ $featuredPost->category->name }}
                    </span>

                    <a href="{{ route('blog.show', $featuredPost->slug) }}">
                        <h2 class="text-3xl md:text-5xl font-bold group-hover:gradient-text-accent transition-smooth leading-tight">
                            {{ $featuredPost->title }}
                        </h2>
                    </a>

                    <p class="text-muted-foreground text-lg md:text-xl leading-relaxed">{{ $featuredPost->excerpt }}</p>

                    <div class="flex items-center gap-4 text-sm pt-2">
                        @if($setting->site_author)
                        <div class="flex items-center gap-2">
                            <img src="{{ asset('storage/user_profile_photos/'.$setting->site_author_image) }}" alt="{{ $setting->site_author }}" class="w-10 h-10 rounded-full ring-2 ring-border">
                            <span class="font-semibold">{{ $setting->site_author }}</span>
                        </div>
                        @endif
                        <span class="text-muted-foreground font-medium">{{ $featuredPost->read_time }}</span>
                    </div>

                    <a href="{{ route('blog.show', $featuredPost->slug) }}" class="inline-block pt-2">
                        <button class="btn-gradient text-white shadow-[var(--shadow-hover)] hover:shadow-[var(--shadow-elevated)] hover:scale-105 transition-bounce text-base font-semibold px-6 py-3 rounded-lg inline-flex items-center">
                            Read Full Article
                            <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </button>
                    </a>
                </div>

                <div class="order-1 md:order-2">
                    <a href="{{ route('blog.show', $featuredPost->slug) }}">
                        <div class="relative overflow-hidden rounded-2xl shadow-[var(--shadow-hover)] group-hover:shadow-[var(--shadow-elevated)] transition-smooth">
                            <img src="{{ asset('storage/'. $featuredPost->image ) }}" alt="{{ $featuredPost->title }}" class="w-full h-80 object-cover transition-smooth group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-background/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-smooth"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Advertisement -->
    <section class="container mx-auto px-4 py-12">
        <div class="max-w-4xl mx-auto">
            <p class="text-sm text-muted-foreground text-center mb-2 font-medium">Advertisement</p>
            <div class="glass-card p-4 rounded-2xl flex items-center justify-center min-h-[120px] bg-gradient-to-r from-violet-50 to-fuchsia-50 dark:from-violet-950 dark:to-fuchsia-950">
                <!-- Demo Advertisement - Replace with actual AdSense code -->
                <div class="text-center py-8 px-6">
                    <div class="text-4xl mb-2">✨</div>
                    <p class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-1">Featured Advertisement</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Horizontal Banner - 728 x 90</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories -->
    <section class="container mx-auto px-4 py-20">
        <h2 class="text-4xl md:text-5xl font-bold mb-12 text-center">
            Popular <span class="gradient-text">Categories</span>
        </h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($categories as $index => $category)
            <a href="{{ route('blog.category', $category->slug) }}" class="glass-card p-8 text-center group hover:scale-105 transition-bounce" style="animation-delay: {{ $index * 0.1 }}s">
                <div class="{{ $category->color }} w-16 h-16 rounded-2xl mx-auto mb-4 opacity-20 group-hover:opacity-40 transition-smooth shadow-[var(--shadow-subtle)]"></div>
                <h3 class="font-bold text-lg mb-1 group-hover:gradient-text transition-smooth">{{ $category->name }}</h3>
                <p class="text-sm text-muted-foreground font-medium">{{ $category->count }} articles</p>
            </a>
            @endforeach
        </div>
    </section>

    <!-- Advertisement -->
    <section class="container mx-auto px-4 pb-12">
        <div class="max-w-4xl mx-auto">
            <p class="text-sm text-muted-foreground text-center mb-2 font-medium">Advertisement</p>
            <div class="glass-card p-4 rounded-2xl flex items-center justify-center min-h-[250px] bg-gradient-to-br from-amber-50 to-orange-50 dark:from-amber-950 dark:to-orange-950">
                <!-- Demo Advertisement - Replace with actual AdSense code -->
                <div class="text-center py-12 px-8">
                    <div class="text-5xl mb-3">🎨</div>
                    <p class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-2">Premium Placement</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Large Rectangle - 336 x 280</p>
                    <p class="text-xs text-gray-500 dark:text-gray-500 mt-2">High engagement zone</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Posts -->
    <section class="container mx-auto px-4 pb-20">
        <div class="flex items-center justify-between mb-12">
            <h2 class="text-4xl md:text-5xl font-bold">
                Latest <span class="gradient-text">Articles</span>
            </h2>
            <a href="{{ route('bloglist') }}" class="group hover:text-primary transition-smooth font-semibold inline-flex items-center">
                View All
                <svg class="ml-2 h-5 w-5 transition-smooth group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </a>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($recentposts as $index => $post)
            <div class="animate-scale-in" style="animation-delay: {{ $index * 0.1 }}s">
                @include('partials.blog-card', ['post' => $post])
            </div>
            @endforeach
        </div>
    </section>
</div>
@endsection
