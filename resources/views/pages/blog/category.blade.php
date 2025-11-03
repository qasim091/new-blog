@extends('layouts2.app')

@section('title', $category->name . ' - Crystal Write Hub')

@section('content')
<div class="min-h-screen py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="mb-12 text-center animate-fade-in">
                <div class="inline-block {{ $category->color }} w-20 h-20 rounded-2xl mb-6 opacity-30"></div>
                <h1 class="text-5xl md:text-6xl font-bold mb-4">
                    <span class="gradient-text">{{ $category->name }}</span>
                </h1>
                <p class="text-xl text-muted-foreground">
                    {{ $posts->total() }} articles in this category
                </p>
            </div>

            <!-- Blog Posts Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @forelse($posts as $post)
                <div class="animate-scale-in">
                    @include('partials.blog-card', ['post' => $post])
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-muted-foreground text-xl">No posts found in this category.</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($posts->hasPages())
            <div class="flex justify-center">
                {{ $posts->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
