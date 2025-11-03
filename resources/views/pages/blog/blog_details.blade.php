@extends('layouts2.app')

@section('title', $post->title . ' - Crystal Write Hub')

@section('content')
<div class="min-h-screen py-12">
    <article class="container mx-auto px-4 max-w-4xl">
        <!-- Header -->
        <div class="mb-8 animate-fade-in">
            <div class="flex items-center gap-4 mb-6">
                <a href="{{ route('blog.category', $post->category->slug) }}" class="glass-strong px-4 py-2 rounded-full text-sm font-bold hover:scale-105 transition-bounce">
                    {{ $post->category->name }}
                </a>
                <span class="text-muted-foreground">{{ $post->read_time }}</span>
                <span class="text-muted-foreground">{{ $post->views }} views</span>
            </div>

            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                {{ $post->title }}
            </h1>

            <p class="text-xl text-muted-foreground mb-8">
                {{ $post->excerpt }}
            </p>

            <!-- Author Info -->
            @if($post->author)
            <div class="flex items-center gap-4 mb-8">
                <img src="{{ $post->author->avatar }}" alt="{{ $post->author->name }}" class="w-16 h-16 rounded-full ring-4 ring-border">
                <div>
                    <p class="font-bold text-lg">{{ $post->author->name }}</p>
                    <p class="text-muted-foreground">{{ $post->published_date->format('F d, Y') }}</p>
                </div>
            </div>
            @else
            <div class="mb-8">
                <p class="text-muted-foreground">{{ $post->published_date->format('F d, Y') }}</p>
            </div>
            @endif
        </div>

        <!-- Featured Image -->
        <div class="mb-12 rounded-2xl overflow-hidden shadow-[var(--shadow-elevated)]">
            <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-full h-96 object-cover">
        </div>

        <!-- Content -->
        <div class="glass-card p-8 md:p-12 mb-12 prose prose-lg max-w-none">
            {!! $post->content !!}
        </div>

        <!-- Tags -->
        @if($post->tags->count() > 0)
        <div class="mb-12">
            <h3 class="text-xl font-bold mb-4">Tags</h3>
            <div class="flex flex-wrap gap-3">
                @foreach($post->tags as $tag)
                <span class="glass-strong px-4 py-2 rounded-full text-sm font-semibold">
                    {{ $tag->name }}
                </span>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Author Bio -->
        @if($post->author)
        <div class="glass-card p-8 mb-12">
            <div class="flex items-start gap-6">
                <img src="{{ $post->author->avatar }}" alt="{{ $post->author->name }}" class="w-20 h-20 rounded-full ring-4 ring-border flex-shrink-0">
                <div>
                    <h3 class="text-2xl font-bold mb-2">About {{ $post->author->name }}</h3>
                    <p class="text-muted-foreground leading-relaxed">{{ $post->author->bio }}</p>
                </div>
            </div>
        </div>
        @endif

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
