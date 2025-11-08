@extends('layouts2.app')

@section('title', $article->title )

@section('content')
@php
    $setting = App\Models\WebSetting::first();
@endphp
<div class="min-h-screen py-12">
    <article class="container mx-auto px-4 max-w-4xl">
        <!-- Header -->
        <div class="mb-8 animate-fade-in">
            <div class="flex items-center gap-4 mb-6">
                <a href="{{ route('blog.category', $article->category->slug) }}" class="glass-strong px-4 py-2 rounded-full text-sm font-bold hover:scale-105 transition-bounce">
                    {{ $article->category->name }}
                </a>
                <span class="text-muted-foreground">{{ $article->read_time }}</span>
                <span class="text-muted-foreground">{{ $article->views }} views</span>
            </div>

            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                {{ $article->title }}
            </h1>

            <p class="text-xl text-muted-foreground mb-8">
                {{ $article->excerpt }}
            </p>

            <!-- Author Info -->
            @if($setting->site_author)
            <div class="flex items-center gap-4 mb-8">
                <img src="{{ asset('storage/user_profile_photos/'.$setting->site_author_image) }}" alt="{{ $setting->site_author }}" class="w-16 h-16 rounded-full ring-4 ring-border">
                <div>
                    <p class="font-bold text-lg">{{ $setting->site_author }}</p>
                    <p class="text-muted-foreground">{{ $article->created_at->format('F d, Y') }}</p>
                </div>
            </div>
            @else
            <div class="mb-8">
                <p class="text-muted-foreground">{{ $article->created_at->format('F d, Y') }}</p>
            </div>
            @endif
        </div>

        <!-- Featured Image -->
        <div class="mb-12 rounded-2xl overflow-hidden shadow-[var(--shadow-elevated)]">
            <img src="{{asset('storage/'. $article->image )}}" alt="{{ $article->title }}" class="w-full h-96 object-cover">
        </div>

        <!-- Advertisement -->
        <div class="mb-12">
            <p class="text-sm text-muted-foreground text-center mb-2 font-medium">Advertisement</p>
            <div class="glass-card p-4 rounded-2xl flex items-center justify-center min-h-[120px] bg-gradient-to-r from-orange-50 to-red-50 dark:from-orange-950 dark:to-red-950">
                <!-- Demo Advertisement - Replace with actual AdSense code -->
                <div class="text-center py-8 px-6">
                    <div class="text-4xl mb-2">🎯</div>
                    <p class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-1">Advertisement</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Horizontal Banner - 728 x 90</p>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="glass-card p-8 md:p-12 mb-12 prose prose-lg max-w-none">
            {!! $article->content !!}
        </div>

        <!-- Advertisement -->
        <div class="mb-12">
            <p class="text-sm text-muted-foreground text-center mb-2 font-medium">Advertisement</p>
            <div class="glass-card p-4 rounded-2xl flex items-center justify-center min-h-[250px] bg-gradient-to-br from-indigo-50 to-pink-50 dark:from-indigo-950 dark:to-pink-950">
                <!-- Demo Advertisement - Replace with actual AdSense code -->
                <div class="text-center py-12 px-8">
                    <div class="text-5xl mb-3">💎</div>
                    <p class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-2">Premium Ad Space</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Large Rectangle - 336 x 280</p>
                    <p class="text-xs text-gray-500 dark:text-gray-500 mt-2">High visibility placement</p>
                </div>
            </div>
        </div>

        <!-- Tags -->
        {{-- @if($article->tags->count() > 0)
        <div class="mb-12">
            <h3 class="text-xl font-bold mb-4">Tags</h3>
            <div class="flex flex-wrap gap-3">
                @foreach($article->tags as $tag)
                <span class="glass-strong px-4 py-2 rounded-full text-sm font-semibold">
                    {{ $tag->name }}
                </span>
                @endforeach
            </div>
        </div>
        @endif --}}

        <!-- Author Bio -->
        @if($setting->site_author)
        <div class="glass-card p-8 mb-12">
            <div class="flex items-start gap-6">
                <img src="{{ asset('storage/user_profile_photos/'.$setting->site_author_image) }}" alt="{{ $setting->site_author }}" class="w-20 h-20 rounded-full ring-4 ring-border flex-shrink-0">
                <div>
                    <h3 class="text-2xl font-bold mb-2">About {{ $setting->site_author }}</h3>
                    <p class="text-muted-foreground leading-relaxed">{{ $setting->site_author_desc }}</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Advertisement -->
        <div class="mb-12">
            <p class="text-sm text-muted-foreground text-center mb-2 font-medium">Advertisement</p>
            <div class="glass-card p-4 rounded-2xl flex items-center justify-center min-h-[120px] bg-gradient-to-r from-emerald-50 to-cyan-50 dark:from-emerald-950 dark:to-cyan-950">
                <!-- Demo Advertisement - Replace with actual AdSense code -->
                <div class="text-center py-8 px-6">
                    <div class="text-4xl mb-2">🚀</div>
                    <p class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-1">Sponsored Content</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Responsive Banner Ad</p>
                </div>
            </div>
        </div>

        <!-- Related Posts -->
        @if($relatedPosts->count() > 0)
        <div>
            <h2 class="text-3xl font-bold mb-8">
                Related <span class="gradient-text">Articles</span>
            </h2>
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($relatedPosts as $relatedPost)
                @include('partials.blog-card', ['post' => $relatedPost])
                @endforeach
            </div>
        </div>
        @endif
    </article>
</div>
@endsection
