@extends('layouts2.app')

@section('title', "$page->page_name")

@section('content')
<div class="min-h-screen py-12">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="text-center mb-12 animate-fade-in">
@php
    $titleParts = explode(' ', $page->title);
@endphp

<h1 class="text-5xl md:text-6xl font-bold mb-6">
    {{ $titleParts[0] ?? '' }}
    <span class="gradient-text">{{ $titleParts[1] ?? '' }}</span>
</h1>
            <p class="text-xl text-muted-foreground">
                Empowering writers and readers through quality content
            </p>
        </div>

        <div class="glass-card p-8 md:p-12 mb-8 space-y-6">
            <h2 class="text-3xl font-bold mb-4">Our Mission</h2>
            <p class="text-muted-foreground leading-relaxed text-lg">
                ModernBlog is dedicated to providing a platform where passionate writers can share their knowledge, experiences, and insights with a global audience. We believe in the power of quality content to educate, inspire, and connect people across the world.
            </p>

            <h2 class="text-3xl font-bold mb-4 mt-8">What We Offer</h2>
            <div class="grid md:grid-cols-2 gap-6">
                <div class="glass p-6 rounded-xl">
                    <h3 class="text-xl font-bold mb-3">Quality Content</h3>
                    <p class="text-muted-foreground">
                        Carefully curated articles covering technology, design, business, and more.
                    </p>
                </div>
                <div class="glass p-6 rounded-xl">
                    <h3 class="text-xl font-bold mb-3">Expert Writers</h3>
                    <p class="text-muted-foreground">
                        Content created by industry professionals and passionate enthusiasts.
                    </p>
                </div>
                <div class="glass p-6 rounded-xl">
                    <h3 class="text-xl font-bold mb-3">Modern Design</h3>
                    <p class="text-muted-foreground">
                        Beautiful, responsive interface with glassmorphism effects.
                    </p>
                </div>
                <div class="glass p-6 rounded-xl">
                    <h3 class="text-xl font-bold mb-3">Community Focus</h3>
                    <p class="text-muted-foreground">
                        Building a community of learners and knowledge sharers.
                    </p>
                </div>
            </div>

            <h2 class="text-3xl font-bold mb-4 mt-8">Our Story</h2>
            <p class="text-muted-foreground leading-relaxed text-lg">
                Founded in 2024, ModernBlog started as a simple idea: create a beautiful, modern platform for sharing knowledge. Today, we've grown into a thriving community of writers and readers who are passionate about learning and sharing.
            </p>
        </div>

        <!-- Advertisement -->
        <div class="mb-12">
            <p class="text-sm text-muted-foreground text-center mb-2 font-medium">Advertisement</p>
            <div class="glass-card p-4 rounded-2xl flex items-center justify-center min-h-[120px] bg-gradient-to-r from-purple-50 to-indigo-50 dark:from-purple-950 dark:to-indigo-950">
                <!-- Demo Advertisement - Replace with actual AdSense code -->
                <div class="text-center py-8 px-6">
                    <div class="text-4xl mb-2">📜</div>
                    <p class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-1">Advertisement</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Horizontal Banner - 728 x 90</p>
                </div>
            </div>
        </div>

        <div class="text-center">
            <a href="{{ route('contact') }}" class="btn-gradient text-white px-8 py-4 rounded-lg font-semibold text-lg hover:scale-105 transition-bounce inline-block">
                Get In Touch
            </a>
        </div>
    </div>
</div>
@endsection
