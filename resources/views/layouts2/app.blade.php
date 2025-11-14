<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SkyBlog - Modern Sky-Blue Blog Platform')</title>
    
    <!-- Preconnect for performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Modern fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Meta tags for SEO and social sharing -->
    <meta name="description" content="@yield('meta_description', 'Discover amazing articles and insights on our modern sky-blue themed blog platform')">
    <meta name="keywords" content="@yield('meta_keywords', 'blog, articles, technology, design, modern, sky-blue')">
    <meta name="author" content="@yield('meta_author', 'SkyBlog Team')">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'SkyBlog - Modern Sky-Blue Blog Platform')">
    <meta property="og:description" content="@yield('meta_description', 'Discover amazing articles and insights on our modern sky-blue themed blog platform')">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'SkyBlog - Modern Sky-Blue Blog Platform')">
    <meta property="twitter:description" content="@yield('meta_description', 'Discover amazing articles and insights on our modern sky-blue themed blog platform')">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Additional page-specific styles -->
    @stack('styles')
</head>
<body class="min-h-screen bg-gradient-to-br from-sky-50 via-blue-50 to-cyan-50 dark:from-slate-900 dark:via-blue-900 dark:to-slate-800 font-['Inter'] antialiased">
    <!-- Background decorative elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-sky-400/20 rounded-full blur-3xl animate-float"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-blue-400/15 rounded-full blur-3xl animate-float" style="animation-delay: 2s"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-cyan-400/10 rounded-full blur-3xl animate-float" style="animation-delay: 4s"></div>
    </div>

    <!-- Main wrapper with glass effect -->
    <div class="relative z-10 min-h-screen backdrop-blur-sm">
        @include('partials.header')
        
        <main class="relative">
            @yield('content')
        </main>
        
        @include('partials.footer')
    </div>

    <!-- Scroll to top button -->
    <button id="scrollToTop" class="fixed bottom-8 right-8 w-12 h-12 bg-gradient-to-r from-sky-500 to-blue-600 text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 opacity-0 invisible hover:scale-110 z-50">
        <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
        </svg>
    </button>

    <!-- Additional page-specific scripts -->
    @stack('scripts')
    
    <!-- Scroll to top functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const scrollToTopBtn = document.getElementById('scrollToTop');
            
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    scrollToTopBtn.classList.remove('opacity-0', 'invisible');
                    scrollToTopBtn.classList.add('opacity-100', 'visible');
                } else {
                    scrollToTopBtn.classList.add('opacity-0', 'invisible');
                    scrollToTopBtn.classList.remove('opacity-100', 'visible');
                }
            });
            
            scrollToTopBtn.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>
