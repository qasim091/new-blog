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
                    How uk.com.pk collects, uses, and protects your personal information
                </p>
            </div>

            <div class="glass-card p-8 md:p-12 mb-8 space-y-6">
                <h2 class="text-3xl font-bold mb-4">Information We Collect</h2>
                <p class="text-muted-foreground leading-relaxed text-lg">
                    uk.com.pk collects information to provide better services to Pakistanis seeking UK visa, immigration, and study abroad guidance. We may collect personal information such as your name, email address, and contact details when you submit forms, subscribe to newsletters, or contact us. We also automatically collect non-personal data including IP addresses, browser type, and pages visited through cookies and analytics tools.
                </p>

                <h2 class="text-3xl font-bold mb-4 mt-8">How We Use Your Information</h2>
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="glass p-6 rounded-xl">
                        <h3 class="text-xl font-bold mb-3">Service Improvement</h3>
                        <p class="text-muted-foreground">
                            We use collected data to improve our UK visa guides, study abroad resources, and immigration content based on user interests and feedback.
                        </p>
                    </div>
                    <div class="glass p-6 rounded-xl">
                        <h3 class="text-xl font-bold mb-3">Communication</h3>
                        <p class="text-muted-foreground">
                            Your email may be used to respond to inquiries, send newsletters about UK immigration updates, or notify you about new visa-related content.
                        </p>
                    </div>
                    <div class="glass p-6 rounded-xl">
                        <h3 class="text-xl font-bold mb-3">Cookies & Analytics</h3>
                        <p class="text-muted-foreground">
                            uk.com.pk uses cookies and Google Analytics to understand user behavior, improve website performance, and deliver relevant content to Pakistani visitors.
                        </p>
                    </div>
                    <div class="glass p-6 rounded-xl">
                        <h3 class="text-xl font-bold mb-3">Third-Party Sharing</h3>
                        <p class="text-muted-foreground">
                            We do not sell your personal information. Data may be shared with trusted partners like Google AdSense for advertising purposes only.
                        </p>
                    </div>
                </div>

                <h2 class="text-3xl font-bold mb-4 mt-8">Your Rights & Data Protection</h2>
                <p class="text-muted-foreground leading-relaxed text-lg">
                    You have the right to access, correct, or delete your personal information held by uk.com.pk. To exercise these rights, contact us at info@uk.com.pk. We implement appropriate security measures to protect your data from unauthorized access. By using our website, you consent to this Privacy Policy. We may update this policy periodically, and continued use of uk.com.pk constitutes acceptance of any changes.
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
