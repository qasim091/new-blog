@extends('layouts2.app')

@section('title', 'Categories - Crystal Write Hub')

@section('content')
<div class="min-h-screen py-12">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="text-center mb-12 animate-fade-in">
            <h1 class="text-5xl md:text-6xl font-bold mb-6">
                Explore <span class="gradient-text">Categories</span>
            </h1>
            <p class="text-xl text-muted-foreground">
                Browse articles by topic
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($categories as $category)
            <a href="{{ route('blog.category', $category->slug) }}" class="glass-card p-8 group hover:scale-105 transition-bounce">
                <div class="{{ $category->color }} w-20 h-20 rounded-2xl mb-6 opacity-20 group-hover:opacity-40 transition-smooth shadow-[var(--shadow-subtle)]"></div>
                <h2 class="text-2xl font-bold mb-3 group-hover:gradient-text transition-smooth">
                    {{ $category->name }}
                </h2>
                <p class="text-muted-foreground mb-4">
                    {{ $category->blog_posts_count }} {{ Str::plural('article', $category->blog_posts_count) }}
                </p>
                <div class="flex items-center text-primary font-semibold group-hover:translate-x-2 transition-smooth">
                    View Articles
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
