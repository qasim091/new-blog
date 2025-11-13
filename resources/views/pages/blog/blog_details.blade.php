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


        <!-- Content -->
        <div class="glass-card p-8 md:p-12 mb-12 prose prose-lg max-w-none">
            @php
                // Split content by paragraphs
                $description = $article->description;
                $paragraphs = preg_split('/(<\/p>)/i', $description, -1, PREG_SPLIT_DELIM_CAPTURE);
                
                // Count actual paragraphs (pairs of content + closing tag)
                $totalParagraphs = floor(count($paragraphs) / 2);
                
                // Initialize content sections
                $firstTwoParagraphs = '';
                $middleContent = '';
                $beforeLastContent = '';
                $lastParagraph = '';
                
                if ($totalParagraphs >= 5) {
                    // For 5+ paragraphs: first two, middle, before last, last 2
                    $midPoint = floor(($totalParagraphs - 4) / 2) + 2; // Calculate mid excluding first 2 and last 2
                    
                    // First two paragraphs (index 0-3)
                    $firstTwoParagraphs = $paragraphs[0] . ($paragraphs[1] ?? '') . 
                                         $paragraphs[2] . ($paragraphs[3] ?? '');
                    
                    // Middle content (from 3rd to mid point)
                    for ($i = 4; $i < (($midPoint + 1) * 2); $i++) {
                        $middleContent .= $paragraphs[$i];
                    }
                    
                    // Before last content (from after middle to before last 2 paragraphs)
                    for ($i = (($midPoint + 1) * 2); $i < (count($paragraphs) - 4); $i++) {
                        $beforeLastContent .= $paragraphs[$i];
                    }
                    
                    // Last 2 paragraphs
                    $lastParagraph = $paragraphs[count($paragraphs) - 4] . ($paragraphs[count($paragraphs) - 3] ?? '') .
                                    $paragraphs[count($paragraphs) - 2] . ($paragraphs[count($paragraphs) - 1] ?? '');
                    
                } elseif ($totalParagraphs == 4) {
                    // For 4 paragraphs: first two, last two
                    $firstTwoParagraphs = $paragraphs[0] . ($paragraphs[1] ?? '') . 
                                         $paragraphs[2] . ($paragraphs[3] ?? '');
                    // Last 2 paragraphs (3rd and 4th)
                    $lastParagraph = $paragraphs[4] . ($paragraphs[5] ?? '') . 
                                    $paragraphs[6] . ($paragraphs[7] ?? '');
                    
                } elseif ($totalParagraphs == 3) {
                    // For 3 paragraphs: first two, last
                    $firstTwoParagraphs = $paragraphs[0] . ($paragraphs[1] ?? '') . 
                                         $paragraphs[2] . ($paragraphs[3] ?? '');
                    $lastParagraph = $paragraphs[4] . ($paragraphs[5] ?? '');
                    
                } elseif ($totalParagraphs == 2) {
                    // For 2 paragraphs: show both as first two
                    $firstTwoParagraphs = $paragraphs[0] . ($paragraphs[1] ?? '') . 
                                         $paragraphs[2] . ($paragraphs[3] ?? '');
                } else {
                    // Single paragraph or no paragraphs
                    $firstTwoParagraphs = $description;
                }
            @endphp
            
            {{-- First Two Paragraphs --}}
            {!! $firstTwoParagraphs !!}
            
            {{-- Ad After Two Paragraphs --}}
            @if($adsAfterFirstParagraph->count() > 0)
                </div>
                <div class="mb-8">
                    @foreach($adsAfterFirstParagraph as $ad)
                    <div class="mb-8">
                        <p class="text-sm text-muted-foreground text-center mb-2 font-medium">Advertisement</p>
                        <div class="glass-card p-4 rounded-2xl flex items-center justify-center min-h-[120px]">
                            {!! $ad->ad_code !!}
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="glass-card p-8 md:p-12 mb-12 prose prose-lg max-w-none">
            @endif
            
            {{-- Middle Content --}}
            @if($middleContent)
                {!! $middleContent !!}
                
                {{-- Ad in Middle of Content --}}
                @if($adsMiddleContent->count() > 0)
                    </div>
                    <div class="mb-8">
                        @foreach($adsMiddleContent as $ad)
                        <div class="mb-8">
                            <p class="text-sm text-muted-foreground text-center mb-2 font-medium">Advertisement</p>
                            <div class="glass-card p-4 rounded-2xl flex items-center justify-center min-h-[120px]">
                                {!! $ad->ad_code !!}
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="glass-card p-8 md:p-12 mb-12 prose prose-lg max-w-none">
                @endif
            @endif
            
            {{-- Before Last Content --}}
            @if($beforeLastContent)
                {!! $beforeLastContent !!}
            @endif
            
            {{-- Ad Before Last 2 Tags in Description --}}
            @if($adsBeforeLast2Tags->count() > 0 && $lastParagraph)
                </div>
                <div class="mb-8">
                    @foreach($adsBeforeLast2Tags as $ad)
                    <div class="mb-8">
                        <p class="text-sm text-muted-foreground text-center mb-2 font-medium">Advertisement</p>
                        <div class="glass-card p-4 rounded-2xl flex items-center justify-center min-h-[120px]">
                            {!! $ad->ad_code !!}
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="glass-card p-8 md:p-12 mb-12 prose prose-lg max-w-none">
            @endif
            
            {{-- Last 2 Tags/Paragraphs --}}
            @if($lastParagraph)
                {!! $lastParagraph !!}
            @endif
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
