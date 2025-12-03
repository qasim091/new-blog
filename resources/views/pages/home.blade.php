@extends('layouts2.app')

@section('title', "$page->page_name")

@section('content')
<div class="min-h-screen">
    <!-- Hero Section -->
    @php
    $setting = App\Models\WebSetting::first();
@endphp
    <section class="relative py-24 md:py-32 lg:py-40 overflow-hidden">
        <!-- Animated background -->
        <div class="absolute inset-0 bg-gradient-to-br from-sky-100/50 via-blue-50/30 to-cyan-100/50 dark:from-slate-800/50 dark:via-blue-900/30 dark:to-slate-700/50"></div>

        <!-- Floating elements -->
        <div class="absolute top-20 left-10 w-32 h-32 bg-sky-400/20 rounded-full blur-3xl animate-float animate-glow"></div>
        <div class="absolute bottom-20 right-10 w-40 h-40 bg-blue-400/15 rounded-full blur-3xl animate-float animate-glow" style="animation-delay: 1s"></div>
        <div class="absolute top-40 right-20 w-24 h-24 bg-cyan-400/20 rounded-full blur-3xl animate-float" style="animation-delay: 2s"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-5xl mx-auto text-center space-y-10 animate-fade-in">
                <!-- Badge -->
                <div class="inline-flex items-center gap-3 bg-white/80 dark:bg-slate-800/80 backdrop-blur-md px-6 py-3 rounded-full shadow-lg border border-sky-200/50 dark:border-slate-600/50 animate-scale-in">
                    <div class="w-2 h-2 bg-sky-500 rounded-full animate-pulse"></div>
                    <span class="text-sm font-semibold bg-gradient-to-r from-sky-600 to-blue-600 bg-clip-text text-transparent">
                        Welcome to DailyPkBlog
                    </span>
                </div>

                <!-- Main heading -->
                <h1 class="text-6xl md:text-7xl lg:text-8xl font-bold leading-tight tracking-tight font-['Poppins']">
                    Discover Amazing
                    <span class="block bg-gradient-to-r from-sky-500 via-blue-600 to-cyan-500 bg-clip-text text-transparent animate-glow">
                        Stories
                    </span>
                    <span class="block text-slate-700 dark:text-slate-300">in the Sky</span>
                </h1>

                <!-- Subtitle -->
                <p class="text-xl md:text-2xl text-slate-600 dark:text-slate-400 max-w-3xl mx-auto leading-relaxed font-medium">
                    Explore insightful articles, cutting-edge tutorials, and inspiring thoughts from passionate writers across technology, design, and innovation.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-6 justify-center pt-8">
                    <a href="{{ route('bloglist') }}" class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-sky-500 to-blue-600 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 hover:-translate-y-1">
                        <span class="relative z-10">Explore Articles</span>
                        <svg class="ml-3 h-5 w-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-cyan-600 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </a>
                    <a href="{{ route('about') }}" class="group inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-sky-700 dark:text-sky-300 bg-white/80 dark:bg-slate-800/80 backdrop-blur-md border-2 border-sky-200 dark:border-slate-600 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 hover:-translate-y-1 hover:border-sky-300 dark:hover:border-slate-500">
                        Learn More
                        <svg class="ml-3 h-5 w-5 transition-transform group-hover:rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </a>
                </div>

                <!-- Stats -->
                {{-- <div class="grid grid-cols-3 gap-8 pt-16 max-w-2xl mx-auto">
                    <div class="text-center animate-slide-up" style="animation-delay: 0.2s">
                        <div class="text-3xl md:text-4xl font-bold text-sky-600 dark:text-sky-400">50+</div>
                        <div class="text-sm text-slate-600 dark:text-slate-400 font-medium">Articles</div>
                    </div>
                    <div class="text-center animate-slide-up" style="animation-delay: 0.4s">
                        <div class="text-3xl md:text-4xl font-bold text-blue-600 dark:text-blue-400">10K+</div>
                        <div class="text-sm text-slate-600 dark:text-slate-400 font-medium">Readers</div>
                    </div>
                    <div class="text-center animate-slide-up" style="animation-delay: 0.6s">
                        <div class="text-3xl md:text-4xl font-bold text-cyan-600 dark:text-cyan-400">5+</div>
                        <div class="text-sm text-slate-600 dark:text-slate-400 font-medium">Categories</div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>

    <!-- Featured Post -->
    @if($featuredPost)
    <section class="container mx-auto px-4 py-20 relative z-20">
        <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl p-8 md:p-12 rounded-3xl shadow-2xl border border-sky-200/50 dark:border-slate-600/50 group hover:shadow-sky-500/10 transition-all duration-500 hover:-translate-y-2">
            <!-- Featured badge -->
            <div class="flex items-center gap-3 mb-8">
                <div class="w-8 h-8 bg-gradient-to-r from-sky-500 to-blue-600 rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                    </svg>
                </div>
                <span class="text-xl font-bold bg-gradient-to-r from-sky-600 to-blue-600 bg-clip-text text-transparent">Featured Article</span>
            </div>

            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <!-- Category -->
                    <span class="inline-block bg-gradient-to-r from-sky-100 to-blue-100 dark:from-sky-900/50 dark:to-blue-900/50 text-sky-700 dark:text-sky-300 px-4 py-2 rounded-full text-sm font-semibold border border-sky-200 dark:border-sky-700">
                        {{ $featuredPost->category->name }}
                    </span>

                    <!-- Title -->
                    <a href="{{ route('blog.show', $featuredPost->slug) }}" class="block group">
                        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight text-slate-800 dark:text-slate-100 group-hover:bg-gradient-to-r group-hover:from-sky-600 group-hover:to-blue-600 group-hover:bg-clip-text group-hover:text-transparent transition-all duration-300">
                            {{ $featuredPost->title }}
                        </h2>
                    </a>

                    <!-- Excerpt -->
                    <p class="text-lg text-slate-600 dark:text-slate-400 leading-relaxed">
                        {{ $featuredPost->excerpt }}
                    </p>

                    <!-- Author & Meta -->
                    <div class="flex items-center gap-6 text-sm">
                        @if($setting->site_author)
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('storage/user_profile_photos/'.$setting->site_author_image) }}" alt="{{ $setting->site_author }}" class="w-12 h-12 rounded-full ring-2 ring-sky-200 dark:ring-sky-700">
                            <div>
                                <div class="font-semibold text-slate-700 dark:text-slate-300">{{ $setting->site_author }}</div>
                                <div class="text-slate-500 dark:text-slate-500">{{ $featuredPost->read_time }}</div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- CTA Button -->
                    <a href="{{ route('blog.show', $featuredPost->slug) }}" class="group inline-flex items-center gap-3 bg-gradient-to-r from-sky-500 to-blue-600 text-white px-8 py-4 rounded-2xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 hover:-translate-y-1">
                        Read Full Article
                        <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>

                <!-- Featured Image -->
                <div class="order-first lg:order-last">
                    <a href="{{ route('blog.show', $featuredPost->slug) }}" class="block group">
                        <div class="relative overflow-hidden rounded-2xl shadow-2xl">
                            <img src="{{ asset('storage/'. $featuredPost->image ) }}" alt="{{ $featuredPost->title }}" class="w-full h-80 lg:h-96 object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-sky-900/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="absolute top-4 right-4 bg-white/90 dark:bg-slate-800/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-semibold text-sky-600 dark:text-sky-400">
                                Featured
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endif


    <!-- Categories -->
    <section class="container mx-auto px-4 py-20">
        <div class="text-center mb-16 animate-fade-in">
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 font-['Poppins']">
                Explore <span class="bg-gradient-to-r from-sky-500 via-blue-600 to-cyan-500 bg-clip-text text-transparent">Categories</span>
            </h2>
            <p class="text-xl text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">
                Discover articles across different topics and find what interests you most
            </p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($categories as $index => $category)
            <a href="{{ route('blog.category', $category->slug) }}" class="group bg-white/60 dark:bg-slate-800/60 backdrop-blur-lg p-8 rounded-2xl border border-sky-200/50 dark:border-slate-600/50 text-center hover:bg-white/80 dark:hover:bg-slate-800/80 hover:shadow-xl hover:shadow-sky-500/10 transition-all duration-300 hover:scale-105 hover:-translate-y-2 animate-scale-in" style="animation-delay: {{ $index * 0.1 }}s">

                <!-- Category Icon -->
                <div class="w-16 h-16 mx-auto mb-6 bg-gradient-to-br from-sky-400 to-blue-500 rounded-2xl flex items-center justify-center shadow-lg group-hover:shadow-xl group-hover:scale-110 transition-all duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>

                <!-- Category Name -->
                <h3 class="font-bold text-lg mb-2 text-slate-800 dark:text-slate-100 group-hover:bg-gradient-to-r group-hover:from-sky-600 group-hover:to-blue-600 group-hover:bg-clip-text group-hover:text-transparent transition-all duration-300">
                    {{ $category->name }}
                </h3>

                <!-- Article Count -->
                <p class="text-sm text-slate-500 dark:text-slate-400 font-medium">
                    {{ $category->count }} articles
                </p>

                <!-- Hover Arrow -->
                <div class="mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <svg class="w-5 h-5 mx-auto text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </div>
            </a>
            @endforeach
        </div>
    </section>


    <!-- Latest Posts -->
    <section class="container mx-auto px-4 pb-20">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-16 gap-6">
            <div class="animate-fade-in">
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold font-['Poppins']">
                    Latest <span class="bg-gradient-to-r from-sky-500 via-blue-600 to-cyan-500 bg-clip-text text-transparent">Articles</span>
                </h2>
                <p class="text-lg text-slate-600 dark:text-slate-400 mt-2">Fresh insights and stories from our community</p>
            </div>
            <a href="{{ route('bloglist') }}" class="group inline-flex items-center gap-3 bg-white/60 dark:bg-slate-800/60 backdrop-blur-lg px-6 py-3 rounded-2xl border border-sky-200/50 dark:border-slate-600/50 font-semibold text-sky-700 dark:text-sky-300 hover:bg-white/80 dark:hover:bg-slate-800/80 hover:shadow-lg transition-all duration-300 hover:scale-105">
                View All Articles
                <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($recentposts as $index => $post)
            <div class="animate-scale-in" style="animation-delay: {{ $index * 0.1 }}s">
                @include('partials.blog-card', ['post' => $post])
            </div>

            <!-- Advertisement after 3rd article -->
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

            <!-- Advertisement after 7th article -->
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
            @endforeach
        </div>

        <!-- Pagination -->
        @if ($recentposts->hasPages())
            <div class="flex justify-center mt-16">
                <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-lg rounded-2xl border border-sky-200/50 dark:border-slate-600/50 p-2">
                    {{ $recentposts->links() }}
                </div>
            </div>
        @endif
    </section>
</div>
@endsection
