@extends('layouts2.app')

@section('title', "$page->page_name")

@section('content')
    <div class="min-h-screen py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-7xl mx-auto">
                <!-- Header -->
                <div class="mb-16 text-center animate-fade-in">
                    @php
                        $titleParts = explode(' ', $page->title);
                    @endphp

                    <h1 class="text-6xl md:text-7xl lg:text-8xl font-bold mb-8 font-['Poppins']">
                        {{ $titleParts[0] ?? 'Blog' }}
                        <span class="block bg-gradient-to-r from-sky-500 via-blue-600 to-cyan-500 bg-clip-text text-transparent">
                            {{ $titleParts[1] ?? 'Articles' }}
                        </span>
                    </h1>
                    <p class="text-2xl text-slate-600 dark:text-slate-400 max-w-3xl mx-auto leading-relaxed">
                        {{ $page->meta_desc ?? 'Discover amazing articles, tutorials, and insights from our community of writers' }}
                    </p>
                </div>

                <!-- Search Bar -->
                <div class="mb-12 max-w-3xl mx-auto">
                    <form action="{{ route('bloglist') }}" method="GET" class="relative group">
                        <div class="absolute inset-0 bg-gradient-to-r from-sky-400 to-blue-500 rounded-3xl blur opacity-25 group-hover:opacity-40 transition-opacity duration-300"></div>
                        <div class="relative bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-3xl border border-sky-200/50 dark:border-slate-600/50 p-2 shadow-xl">
                            <div class="flex items-center gap-4">
                                <div class="flex-1 relative">
                                    <svg class="absolute left-6 top-1/2 -translate-y-1/2 w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        placeholder="Search for articles, topics, or authors..."
                                        class="w-full pl-16 pr-6 py-4 bg-transparent text-lg font-medium placeholder-slate-400 focus:outline-none">
                                </div>
                                <button type="submit"
                                    class="bg-gradient-to-r from-sky-500 to-blue-600 text-white px-8 py-4 rounded-2xl font-semibold text-lg shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 flex items-center gap-2">
                                    <span>Search</span>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>


                <!-- Categories Filter -->
                <div class="mb-16">
                    <h3 class="text-2xl font-bold text-center mb-8 text-slate-700 dark:text-slate-300">Browse by Category</h3>
                    <div class="flex flex-wrap gap-4 justify-center">
                        <!-- All Posts -->
                        <a href="{{ route('bloglist') }}"
                            class="group relative px-8 py-4 rounded-2xl font-semibold text-lg transition-all duration-300 hover:scale-105 hover:-translate-y-1 {{ request()->routeIs('bloglist') ? 'bg-gradient-to-r from-sky-500 to-blue-600 text-white shadow-lg' : 'bg-white/60 dark:bg-slate-800/60 backdrop-blur-lg border border-sky-200/50 dark:border-slate-600/50 text-slate-700 dark:text-slate-300 hover:bg-white/80 dark:hover:bg-slate-800/80 hover:shadow-lg' }}">
                            <span class="relative z-10">All Posts</span>
                            @if(request()->routeIs('bloglist'))
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-cyan-600 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            @endif
                        </a>

                        <!-- Categories -->
                        @foreach ($categories as $cat)
                        <a href="{{ route('blog.category', $cat->slug) }}"
                           class="group relative px-8 py-4 rounded-2xl font-semibold text-lg transition-all duration-300 hover:scale-105 hover:-translate-y-1 {{ request()->is('blog/category/' . $cat->slug) ? 'bg-gradient-to-r from-sky-500 to-blue-600 text-white shadow-lg' : 'bg-white/60 dark:bg-slate-800/60 backdrop-blur-lg border border-sky-200/50 dark:border-slate-600/50 text-slate-700 dark:text-slate-300 hover:bg-white/80 dark:hover:bg-slate-800/80 hover:shadow-lg' }}">
                            <span class="relative z-10">{{ $cat->name }}</span>
                            @if(request()->is('blog/category/' . $cat->slug))
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-cyan-600 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            @endif
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- Dynamic Category Buttons -->
                @if($categoryButtons->count() > 0)
                <div class="mb-12">
                    <h3 class="text-2xl font-bold text-center mb-8 text-slate-700 dark:text-slate-300">Featured Topics</h3>
                    <div class="flex flex-wrap justify-center gap-6">
                        @foreach($categoryButtons as $button)
                            <a href="{{ $button->url }}" 
                               class="group bg-white/60 dark:bg-slate-800/60 backdrop-blur-lg px-10 py-6 rounded-2xl border border-sky-200/50 dark:border-slate-600/50 text-xl font-bold hover:bg-white/80 dark:hover:bg-slate-800/80 hover:shadow-xl hover:shadow-sky-500/10 transition-all duration-300 hover:scale-105 hover:-translate-y-2 {{ $button->bg_color }} {{ $button->text_color }}">
                                {{ $button->title }}
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif



                <!-- Blog Posts Grid -->
                <div class="mb-16">
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @forelse($blogs as $index => $post)
                            <div class="animate-scale-in" style="animation-delay: {{ $index * 0.1 }}s">
                                @include('partials.blog-card', ['post' => $post])
                            </div>

                            <!-- Advertisement after 3rd blog post -->
                            @if($index == 2 && $adsAfter3rd->count() > 0)
                                @foreach($adsAfter3rd as $ad)
                                <div class="animate-scale-in">
                                    <div class="text-center mb-3">
                                        <span class="text-xs text-slate-500 dark:text-slate-400 font-medium bg-slate-100 dark:bg-slate-700 px-3 py-1 rounded-full">Advertisement</span>
                                    </div>
                                    <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-lg rounded-2xl border border-sky-200/50 dark:border-slate-600/50 overflow-hidden shadow-lg">
                                        <div class="relative overflow-hidden">
                                            <div class="w-full h-56 bg-gradient-to-br from-sky-100 to-blue-100 dark:from-slate-700 dark:to-slate-600 flex items-center justify-center">
                                                {!! $ad->ad_code !!}
                                            </div>
                                        </div>
                                        <div class="p-6">
                                            <div class="h-[120px] flex items-center justify-center text-center">
                                                <p class="text-sm text-slate-500 dark:text-slate-400">Ad content area</p>
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
                                    <div class="text-center mb-3">
                                        <span class="text-xs text-slate-500 dark:text-slate-400 font-medium bg-slate-100 dark:bg-slate-700 px-3 py-1 rounded-full">Advertisement</span>
                                    </div>
                                    <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-lg rounded-2xl border border-sky-200/50 dark:border-slate-600/50 overflow-hidden shadow-lg">
                                        <div class="relative overflow-hidden">
                                            <div class="w-full h-56 bg-gradient-to-br from-sky-100 to-blue-100 dark:from-slate-700 dark:to-slate-600 flex items-center justify-center">
                                                {!! $ad->ad_code !!}
                                            </div>
                                        </div>
                                        <div class="p-6">
                                            <div class="h-[120px] flex items-center justify-center text-center">
                                                <p class="text-sm text-slate-500 dark:text-slate-400">Ad content area</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        @empty
                            <div class="col-span-full text-center py-20">
                                <div class="max-w-md mx-auto">
                                    <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-sky-400 to-blue-500 rounded-full flex items-center justify-center">
                                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-2xl font-bold text-slate-700 dark:text-slate-300 mb-4">No Articles Found</h3>
                                    <p class="text-lg text-slate-500 dark:text-slate-400 mb-8">We couldn't find any articles matching your search. Try adjusting your filters or search terms.</p>
                                    <a href="{{ route('bloglist') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-sky-500 to-blue-600 text-white px-6 py-3 rounded-2xl font-semibold hover:shadow-lg transition-all duration-300 hover:scale-105">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                        </svg>
                                        View All Articles
                                    </a>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Pagination -->
                @if ($blogs->hasPages())
                    <div class="flex justify-center">
                        <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-lg rounded-2xl border border-sky-200/50 dark:border-slate-600/50 p-4 shadow-lg">
                            {{ $blogs->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
