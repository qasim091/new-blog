@extends('layouts2.app')

@section('title', "$page->page_name")

@section('content')
    <div class="min-h-screen py-16">
        <!-- Hero Section -->
        <section class="relative py-20 overflow-hidden">
            <div
                class="absolute inset-0 bg-gradient-to-br from-sky-100/30 via-blue-50/20 to-cyan-100/30 dark:from-slate-800/30 dark:via-blue-900/20 dark:to-slate-700/30">
            </div>

            <div class="container mx-auto px-4 max-w-6xl relative z-10">
                <div class="text-center mb-20 animate-fade-in">
                    @php
                        $titleParts = explode(' ', $page->title);
                    @endphp

                    <h1 class="text-6xl md:text-7xl lg:text-8xl font-bold mb-8 font-['Poppins']">
                        {{ $titleParts[0] ?? 'About' }}
                        <span
                            class="block bg-gradient-to-r from-sky-500 via-blue-600 to-cyan-500 bg-clip-text text-transparent">
                            {{ $titleParts[1] ?? 'SkyBlog' }}
                        </span>
                    </h1>
                    <p class="text-2xl text-slate-600 dark:text-slate-400 max-w-3xl mx-auto leading-relaxed">
                        Your trusted guide to UK visas, study abroad, immigration, and life in the United Kingdom for Pakistanis
                    </p>
                </div>

                <!-- Mission Section -->
                <div
                    class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-3xl p-8 md:p-12 mb-12 shadow-2xl border border-sky-200/50 dark:border-slate-600/50 animate-scale-in">
                    <div class="flex items-center gap-4 mb-8">
                        <div
                            class="w-12 h-12 bg-gradient-to-r from-sky-500 to-blue-600 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h2 class="text-4xl md:text-5xl font-bold text-slate-800 dark:text-slate-100">Our Mission</h2>
                    </div>
                    <p class="text-xl text-slate-600 dark:text-slate-400 leading-relaxed">
                        UK.com.pk is Pakistan's leading resource for UK immigration, study visas, and settlement guidance.
                        Our mission is to empower Pakistanis with accurate, up-to-date information about moving to the United Kingdom—whether for education, work, family reunification, or a better lifestyle. We simplify complex visa processes and help you make confident decisions about your UK journey.
                    </p>
                </div>

                <!-- Features Grid -->
                <div class="mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold text-center mb-12 font-['Poppins']">
                        What We <span
                            class="bg-gradient-to-r from-sky-500 via-blue-600 to-cyan-500 bg-clip-text text-transparent">Offer</span>
                    </h2>

                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                        <div class="group bg-white/60 dark:bg-slate-800/60 backdrop-blur-lg p-8 rounded-2xl border border-sky-200/50 dark:border-slate-600/50 text-center hover:bg-white/80 dark:hover:bg-slate-800/80 hover:shadow-xl hover:shadow-sky-500/10 transition-all duration-300 hover:scale-105 hover:-translate-y-2 animate-slide-up"
                            style="animation-delay: 0.1s">
                            <div
                                class="w-16 h-16 mx-auto mb-6 bg-gradient-to-br from-sky-400 to-blue-500 rounded-2xl flex items-center justify-center shadow-lg group-hover:shadow-xl group-hover:scale-110 transition-all duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold mb-4 text-slate-800 dark:text-slate-100">UK Visa Guidance</h3>
                            <p class="text-slate-600 dark:text-slate-400">
                                Comprehensive guides on UK student visas, work permits, spouse visas, and family immigration routes from Pakistan.
                            </p>
                        </div>

                        <div class="group bg-white/60 dark:bg-slate-800/60 backdrop-blur-lg p-8 rounded-2xl border border-sky-200/50 dark:border-slate-600/50 text-center hover:bg-white/80 dark:hover:bg-slate-800/80 hover:shadow-xl hover:shadow-sky-500/10 transition-all duration-300 hover:scale-105 hover:-translate-y-2 animate-slide-up"
                            style="animation-delay: 0.2s">
                            <div
                                class="w-16 h-16 mx-auto mb-6 bg-gradient-to-br from-blue-400 to-cyan-500 rounded-2xl flex items-center justify-center shadow-lg group-hover:shadow-xl group-hover:scale-110 transition-all duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold mb-4 text-slate-800 dark:text-slate-100">Study in UK Resources</h3>
                            <p class="text-slate-600 dark:text-slate-400">
                                Expert advice on UK universities, scholarships for Pakistani students, IELTS preparation, and student life in Britain.
                            </p>
                        </div>

                        <div class="group bg-white/60 dark:bg-slate-800/60 backdrop-blur-lg p-8 rounded-2xl border border-sky-200/50 dark:border-slate-600/50 text-center hover:bg-white/80 dark:hover:bg-slate-800/80 hover:shadow-xl hover:shadow-sky-500/10 transition-all duration-300 hover:scale-105 hover:-translate-y-2 animate-slide-up"
                            style="animation-delay: 0.3s">
                            <div
                                class="w-16 h-16 mx-auto mb-6 bg-gradient-to-br from-cyan-400 to-sky-500 rounded-2xl flex items-center justify-center shadow-lg group-hover:shadow-xl group-hover:scale-110 transition-all duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h4a2 2 0 002-2V9a2 2 0 00-2-2H7a2 2 0 00-2 2v6a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold mb-4 text-slate-800 dark:text-slate-100">UK Lifestyle & Insurance</h3>
                            <p class="text-slate-600 dark:text-slate-400">
                                Practical tips on living in the UK, health insurance options, NHS registration, and settling into British culture.
                            </p>
                        </div>

                        <div class="group bg-white/60 dark:bg-slate-800/60 backdrop-blur-lg p-8 rounded-2xl border border-sky-200/50 dark:border-slate-600/50 text-center hover:bg-white/80 dark:hover:bg-slate-800/80 hover:shadow-xl hover:shadow-sky-500/10 transition-all duration-300 hover:scale-105 hover:-translate-y-2 animate-slide-up"
                            style="animation-delay: 0.4s">
                            <div
                                class="w-16 h-16 mx-auto mb-6 bg-gradient-to-br from-blue-500 to-sky-400 rounded-2xl flex items-center justify-center shadow-lg group-hover:shadow-xl group-hover:scale-110 transition-all duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold mb-4 text-slate-800 dark:text-slate-100">Shopping & Deals</h3>
                            <p class="text-slate-600 dark:text-slate-400">
                                Best UK shopping guides, online deals, Pakistani grocery stores in Britain, and money-saving tips for new immigrants.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Story Section -->
                <div
                    class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-3xl p-8 md:p-12 mb-12 shadow-2xl border border-sky-200/50 dark:border-slate-600/50 animate-fade-in">
                    <div class="flex items-center gap-4 mb-8">
                        <div
                            class="w-12 h-12 bg-gradient-to-r from-cyan-500 to-sky-600 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                        </div>
                        <h2 class="text-4xl md:text-5xl font-bold text-slate-800 dark:text-slate-100">Our Story</h2>
                    </div>
                    <p class="text-xl text-slate-600 dark:text-slate-400 leading-relaxed">
                        UK.com.pk was founded to bridge the information gap for Pakistanis dreaming of a future in the United Kingdom. We understand the challenges of navigating UK visa applications, finding the right university, or settling into a new country. Our team of immigration experts and UK residents work together to bring you trustworthy, practical guidance—helping thousands of Pakistanis successfully move to the UK every year.
                    </p>
                </div>

                <!-- CTA Section -->
                <div class="text-center animate-scale-in">
                    <a href="{{ route('contact') }}"
                        class="group inline-flex items-center gap-4 bg-gradient-to-r from-sky-500 to-blue-600 text-white px-12 py-6 rounded-2xl font-bold text-xl shadow-2xl hover:shadow-sky-500/25 transition-all duration-300 hover:scale-105 hover:-translate-y-2">
                        <span>Get In Touch</span>
                        <svg class="w-6 h-6 transition-transform group-hover:translate-x-1" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>

            </div>
        </section>
    </div>
@endsection
