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
                    Please read these terms carefully before using uk.com.pk
                </p>
            </div>

            <div class="glass-card p-8 md:p-12 mb-8 space-y-6">
                <h2 class="text-3xl font-bold mb-4">Agreement to Terms</h2>
                <p class="text-muted-foreground leading-relaxed text-lg">
                    By accessing and using uk.com.pk, you agree to be bound by these Terms and Conditions. Our website provides information about UK visas, immigration, study abroad options, lifestyle guides, and shopping resources for Pakistanis. If you do not agree with any part of these terms, please discontinue use of our website.
                </p>

                <h2 class="text-3xl font-bold mb-4 mt-8">Terms of Use</h2>
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="glass p-6 rounded-xl">
                        <h3 class="text-xl font-bold mb-3">Informational Purpose Only</h3>
                        <p class="text-muted-foreground">
                            All content on uk.com.pk regarding UK visas, immigration, and study abroad is for general information only and does not constitute legal or professional advice.
                        </p>
                    </div>
                    <div class="glass p-6 rounded-xl">
                        <h3 class="text-xl font-bold mb-3">User Responsibility</h3>
                        <p class="text-muted-foreground">
                            Users are responsible for verifying visa requirements, immigration policies, and other information with official UK government sources before making decisions.
                        </p>
                    </div>
                    <div class="glass p-6 rounded-xl">
                        <h3 class="text-xl font-bold mb-3">Intellectual Property</h3>
                        <p class="text-muted-foreground">
                            All content, logos, and materials on uk.com.pk are protected by copyright. Reproduction without written permission is prohibited.
                        </p>
                    </div>
                    <div class="glass p-6 rounded-xl">
                        <h3 class="text-xl font-bold mb-3">Third-Party Links</h3>
                        <p class="text-muted-foreground">
                            Our website may contain links to external sites. uk.com.pk is not responsible for the content or privacy practices of third-party websites.
                        </p>
                    </div>
                </div>

                <h2 class="text-3xl font-bold mb-4 mt-8">Limitation of Liability</h2>
                <p class="text-muted-foreground leading-relaxed text-lg">
                    uk.com.pk shall not be liable for any damages arising from the use of information on this website. UK visa policies, immigration rules, and university requirements change frequently. Always consult official UK Home Office and UKVI sources for the most current information. By using this website, you acknowledge that decisions regarding UK immigration, study, or settlement are made at your own risk.
                </p>
            </div>


            <div class="text-center">
                <a href="{{ route('contact') }}"
                    class="btn-gradient text-white px-8 py-4 rounded-lg font-semibold text-lg hover:scale-105 transition-bounce inline-block">
                    Get In Touch
                </a>
            </div>
        </div>
    </div>
@endsection
