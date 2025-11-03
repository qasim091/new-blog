<header class="sticky top-0 z-50 glass-strong border-b shadow-[var(--shadow-subtle)]">
    <nav class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
            <a href="{{ route('home') }}" class="text-2xl font-bold gradient-text-accent hover:scale-105 transition-bounce inline-block">
                ModernBlog
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center gap-8">
                <a href="{{ route('home') }}" class="text-foreground/80 hover:text-foreground transition-smooth font-semibold relative after:absolute after:bottom-0 after:left-0 after:w-0 after:h-0.5 after:bg-gradient-primary after:transition-all after:duration-300 hover:after:w-full">
                    Home
                </a>
                <a href="{{ route('blog.index') }}" class="text-foreground/80 hover:text-foreground transition-smooth font-semibold relative after:absolute after:bottom-0 after:left-0 after:w-0 after:h-0.5 after:bg-gradient-primary after:transition-all after:duration-300 hover:after:w-full">
                    Blog
                </a>
                <a href="{{ route('categories') }}" class="text-foreground/80 hover:text-foreground transition-smooth font-semibold relative after:absolute after:bottom-0 after:left-0 after:w-0 after:h-0.5 after:bg-gradient-primary after:transition-all after:duration-300 hover:after:w-full">
                    Categories
                </a>
                <a href="{{ route('about') }}" class="text-foreground/80 hover:text-foreground transition-smooth font-semibold relative after:absolute after:bottom-0 after:left-0 after:w-0 after:h-0.5 after:bg-gradient-primary after:transition-all after:duration-300 hover:after:w-full">
                    About
                </a>
                <a href="{{ route('contact') }}" class="text-foreground/80 hover:text-foreground transition-smooth font-semibold relative after:absolute after:bottom-0 after:left-0 after:w-0 after:h-0.5 after:bg-gradient-primary after:transition-all after:duration-300 hover:after:w-full">
                    Contact
                </a>
                <button onclick="toggleTheme()" class="p-2 rounded-full hover:scale-110 transition-bounce hover:bg-muted">
                    <svg id="theme-icon-sun" class="h-5 w-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <svg id="theme-icon-moon" class="h-5 w-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                    </svg>
                </button>
                @auth
                    <!-- Logged In User Menu -->
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.dashboard') }}" class="glass-strong hover:bg-background/50 transition-smooth font-semibold px-4 py-2 rounded-lg flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="glass-strong hover:bg-red-500/10 transition-smooth font-semibold px-4 py-2 rounded-lg flex items-center gap-2 text-red-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                @else
                    <!-- Guest User Menu -->
                    <div class="flex items-center gap-3">
                        <a href="{{ route('login') }}" class="glass-strong hover:bg-background/50 transition-smooth font-semibold px-5 py-2 rounded-lg">
                            Login
                        </a>
                        {{-- <a href="{{ route('register') }}" class="btn-gradient text-white shadow-[var(--shadow-hover)] hover:shadow-[var(--shadow-elevated)] hover:scale-105 transition-bounce font-semibold px-5 py-2 rounded-lg">
                            Sign Up
                        </a> --}}
                    </div>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <div class="flex md:hidden items-center gap-2">
                <button onclick="toggleTheme()" class="p-2 rounded-full hover:bg-muted">
                    <svg class="h-5 w-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <svg class="h-5 w-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                    </svg>
                </button>
                <button onclick="toggleMobileMenu()" class="p-2 rounded-full hover:bg-muted">
                    <svg id="menu-icon" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg id="close-icon" class="h-5 w-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="hidden md:hidden mt-4 pb-4 flex-col gap-4 animate-slide-in">
            <a href="{{ route('home') }}" class="text-foreground/80 hover:text-foreground transition-smooth font-medium">Home</a>
            <a href="{{ route('blog.index') }}" class="text-foreground/80 hover:text-foreground transition-smooth font-medium">Blog</a>
            <a href="{{ route('categories') }}" class="text-foreground/80 hover:text-foreground transition-smooth font-medium">Categories</a>
            <a href="{{ route('about') }}" class="text-foreground/80 hover:text-foreground transition-smooth font-medium">About</a>
            <a href="{{ route('contact') }}" class="text-foreground/80 hover:text-foreground transition-smooth font-medium">Contact</a>

            @auth
                <!-- Logged In Mobile Menu -->
                <a href="{{ route('admin.dashboard') }}" class="w-full glass-strong hover:bg-background/50 transition-smooth px-6 py-2 rounded-lg text-center inline-block font-semibold">
                    Dashboard
                </a>
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full glass-strong hover:bg-red-500/10 transition-smooth px-6 py-2 rounded-lg text-center font-semibold text-red-500">
                        Logout
                    </button>
                </form>
            @else
                <!-- Guest Mobile Menu -->
                <a href="{{ route('login') }}" class="w-full glass-strong hover:bg-background/50 transition-smooth px-6 py-2 rounded-lg text-center inline-block font-semibold">
                    Login
                </a>
                {{-- <a href="{{ route('register') }}" class="w-full bg-gradient-primary text-white border-0 hover:opacity-90 transition-smooth px-6 py-2 rounded-lg text-center inline-block font-semibold">
                    Sign Up
                </a> --}}
            @endauth
        </div>
    </nav>
</header>

<script>
    function toggleTheme() {
        const html = document.documentElement;
        const isDark = html.classList.contains('dark');
        if (isDark) {
            html.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        } else {
            html.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        }
    }

    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');
        const closeIcon = document.getElementById('close-icon');

        menu.classList.toggle('hidden');
        menu.classList.toggle('flex');
        menuIcon.classList.toggle('hidden');
        closeIcon.classList.toggle('hidden');
    }

    // Initialize theme on page load
    if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    }
</script>
