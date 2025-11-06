@extends('layouts2.app')

@section('title', "$page->page_name")

@section('content')
<div class="min-h-screen py-12">
    <div class="container mx-auto px-4 max-w-2xl">
        <div class="text-center mb-12 animate-fade-in">
@php
    $titleParts = explode(' ', $page->title);
@endphp

<h1 class="text-5xl md:text-6xl font-bold mb-6">
    {{ $titleParts[0] ?? '' }}
    <span class="gradient-text">{{ $titleParts[1] ?? '' }}</span>
</h1>
            <p class="text-xl text-muted-foreground">
                We'd love to hear from you. Send us a message!
            </p>
        </div>

        @if(session('success'))
        <div class="glass-card p-6 mb-8 bg-green-500/10 border-green-500">
            <p class="text-green-600 dark:text-green-400 font-semibold">{{ session('success') }}</p>
        </div>
        @endif

        <div class="glass-card p-8 md:p-12">
            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-semibold mb-2">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full glass-strong px-4 py-3 rounded-lg border-2 focus:border-primary focus:outline-none transition-smooth @error('name') border-red-500 @enderror">
                    @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required class="w-full glass-strong px-4 py-3 rounded-lg border-2 focus:border-primary focus:outline-none transition-smooth @error('email') border-red-500 @enderror">
                    @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="subject" class="block text-sm font-semibold mb-2">Subject</label>
                    <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required class="w-full glass-strong px-4 py-3 rounded-lg border-2 focus:border-primary focus:outline-none transition-smooth @error('subject') border-red-500 @enderror">
                    @error('subject')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="message" class="block text-sm font-semibold mb-2">Message</label>
                    <textarea id="message" name="message" rows="6" required class="w-full glass-strong px-4 py-3 rounded-lg border-2 focus:border-primary focus:outline-none transition-smooth @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                    @error('message')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full btn-gradient text-white py-4 rounded-lg font-semibold text-lg hover:scale-105 transition-bounce">
                    Send Message
                </button>
            </form>
        </div>

        <div class="mt-12 grid md:grid-cols-3 gap-6">
            <div class="glass-card p-6 text-center">
                <svg class="w-8 h-8 mx-auto mb-3 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                <h3 class="font-bold mb-1">Email</h3>
                <p class="text-muted-foreground text-sm">hello@modernblog.com</p>
            </div>
            <div class="glass-card p-6 text-center">
                <svg class="w-8 h-8 mx-auto mb-3 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <h3 class="font-bold mb-1">Location</h3>
                <p class="text-muted-foreground text-sm">San Francisco, CA</p>
            </div>
            <div class="glass-card p-6 text-center">
                <svg class="w-8 h-8 mx-auto mb-3 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
                <h3 class="font-bold mb-1">Phone</h3>
                <p class="text-muted-foreground text-sm">+1 (555) 123-4567</p>
            </div>
        </div>
    </div>
</div>
@endsection
