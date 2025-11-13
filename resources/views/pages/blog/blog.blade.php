@extends('layouts2.app')

@section('title', "$page->page_name")

@section('content')
    <div class="min-h-screen py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-7xl mx-auto">
                <!-- Header -->
                <div class="mb-12 text-center animate-fade-in">
                    @php
                        $titleParts = explode(' ', $page->title);
                    @endphp

                    <h1 class="text-5xl md:text-6xl font-bold mb-6">
                        {{ $titleParts[0] ?? '' }}
                        <span class="gradient-text">{{ $titleParts[1] ?? '' }}</span>
                    </h1>
                    <p class="text-xl text-muted-foreground max-w-2xl mx-auto">
                        {{ $page->meta_desc }}
                    </p>
                </div>

                <!-- Search Bar -->
                <div class="mb-8 max-w-2xl mx-auto">
                    <form action="{{ route('bloglist') }}" method="GET" class="relative">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search articles..."
                            class="w-full glass-strong px-6 py-4 rounded-2xl border-2 focus:border-primary focus:outline-none transition-smooth">
                        <button type="submit"
                            class="absolute right-4 top-1/2 -translate-y-1/2 btn-gradient text-white px-6 py-2 rounded-lg font-semibold">
                            Search
                        </button>
                    </form>
                </div>


                <!-- Categories Filter -->
                <div class="mb-12 flex flex-wrap gap-4 justify-center">
                    <!-- All Posts -->
                    <a href="{{ route('bloglist') }}"
                        class="glass-strong px-6 py-2 rounded-full font-semibold hover:scale-105 transition-bounce
              {{ request()->routeIs('bloglist') ? 'bg-primary text-white' : '' }}">
                        All Posts
                    </a>

                    <!-- Categories -->
@foreach ($categories as $cat)
    <a href="{{ route('blog.category', $cat->slug) }}"
       class="glass-strong px-6 py-2 rounded-full font-semibold hover:scale-105 transition-bounce
              {{ request()->is('blog/category/' . $cat->slug) ? 'bg-primary text-white' : '' }}">
        {{ $cat->name }}
    </a>
@endforeach
                </div>

                <!-- Dynamic Category Buttons -->
                @if($categoryButtons->count() > 0)
                <div class="mb-8 space-y-4">
                    <div class="flex flex-wrap justify-center gap-4">
                        @foreach($categoryButtons as $button)
                            <a href="{{ $button->url }}" 
                               class="glass-strong px-8 py-6 rounded-full text-lg font-semibold hover:scale-105 transition-bounce {{ $button->bg_color }} {{ $button->text_color }}">
                                {{ $button->title }}
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif



                <!-- Blog Posts Grid -->
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    @forelse($blogs as $index => $post)
                        <div class="animate-scale-in">
                            @include('partials.blog-card', ['post' => $post])
                        </div>

                        <!-- Advertisement after 3rd blog post -->
                        @if($index == 2 && $adsAfter3rd->count() > 0)
                            @foreach($adsAfter3rd as $ad)
                            <div class="animate-scale-in">
                                <div class="text-center mb-2">
                                    <span class="text-xs text-muted-foreground font-medium">Advertisement</span>
                                </div>
                                <div class="glass-card overflow-hidden">
                                    <div class="relative overflow-hidden">
                                        <div class="w-full h-56 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-700 flex items-center justify-center">
                                            {!! $ad->ad_code !!}
                                        </div>
                                    </div>
                                    <div class="p-6">
                                        <div class="h-[120px] flex items-center justify-center text-center">
                                            <p class="text-sm text-muted-foreground">Ad content area</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif

                        <!-- Advertisement after 7th blog post -->
                        @if($index == 6 && $adsAfter7th->count() > 0)
                            @foreach($adsAfter7th as $ad)
                            <div class="animate-scale-in">
                                <div class="text-center mb-2">
                                    <span class="text-xs text-muted-foreground font-medium">Advertisement</span>
                                </div>
                                <div class="glass-card overflow-hidden">
                                    <div class="relative overflow-hidden">
                                        <div class="w-full h-56 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-700 flex items-center justify-center">
                                            {!! $ad->ad_code !!}
                                        </div>
                                    </div>
                                    <div class="p-6">
                                        <div class="h-[120px] flex items-center justify-center text-center">
                                            <p class="text-sm text-muted-foreground">Ad content area</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    @empty
                        <div class="col-span-full text-center py-12">
                            <p class="text-muted-foreground text-xl">No posts found.</p>
                        </div>
                    @endforelse
                </div>


                <!-- Pagination -->
                @if ($blogs->hasPages())
                    <div class="flex justify-center">
                        {{ $blogs->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
