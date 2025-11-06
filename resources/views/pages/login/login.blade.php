@extends('layouts2.app')

@section('title', "$page->page_name")

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 relative overflow-hidden">
    <!-- Background decorations -->
    <div class="absolute top-20 left-10 w-72 h-72 bg-primary/20 rounded-full blur-3xl animate-float"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-accent/15 rounded-full blur-3xl animate-float" style="animation-delay: 1s"></div>

    <div class="w-full max-w-md relative z-10">
        <!-- Header -->
        <div class="text-center mb-8 animate-fade-in">
            <h1 class="text-4xl md:text-5xl font-bold mb-3">
                Welcome <span class="gradient-text">Back</span>
            </h1>
            <p class="text-muted-foreground text-lg">
                Sign in to your account to continue
            </p>
        </div>

        <!-- Login Form -->
        <div class="glass-card p-8 animate-scale-in">
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold mb-2">
                        Email Address
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                            </svg>
                        </div>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            class="glass-strong w-full pl-12 pr-4 py-3 rounded-xl border-2 focus:border-primary focus:outline-none transition-smooth @error('email') border-red-500 @enderror"
                            placeholder="your@email.com"
                        >
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold mb-2">
                        Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            class="glass-strong w-full pl-12 pr-4 py-3 rounded-xl border-2 focus:border-primary focus:outline-none transition-smooth @error('password') border-red-500 @enderror"
                            placeholder="••••••••"
                        >
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input
                            type="checkbox"
                            name="remember"
                            class="w-4 h-4 rounded border-2 text-primary focus:ring-primary focus:ring-offset-0 transition-smooth"
                        >
                        <span class="text-sm font-medium group-hover:text-primary transition-smooth">
                            Remember me
                        </span>
                    </label>

                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm font-semibold text-primary hover:text-accent transition-smooth">
                        Forgot password?
                    </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="w-full btn-gradient text-white py-3 rounded-xl font-bold text-lg shadow-[var(--shadow-hover)] hover:shadow-[var(--shadow-elevated)] hover:scale-[1.02] transition-bounce"
                >
                    Sign In
                </button>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-border"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 glass-strong rounded-full font-medium">
                            Or continue with
                        </span>
                    </div>
                </div>

                <!-- Social Login (Optional) -->
                <div class="grid grid-cols-2 gap-4">
                    <button
                        type="button"
                        class="glass-strong border-2 hover:bg-background/50 transition-bounce hover:scale-105 px-4 py-3 rounded-xl font-semibold flex items-center justify-center gap-2"
                    >
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                        </svg>
                        Google
                    </button>
                    <button
                        type="button"
                        class="glass-strong border-2 hover:bg-background/50 transition-bounce hover:scale-105 px-4 py-3 rounded-xl font-semibold flex items-center justify-center gap-2"
                    >
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                        </svg>
                        GitHub
                    </button>
                </div>
            </form>

            <!-- Register Link -->
            <div class="mt-8 text-center">
                <p class="text-muted-foreground">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="font-bold text-primary hover:text-accent transition-smooth">
                        Sign up for free
                    </a>
                </p>
            </div>
        </div>

        <!-- Back to Home -->
        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-muted-foreground hover:text-primary transition-smooth font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Home
            </a>
        </div>
    </div>
</div>
@endsection
