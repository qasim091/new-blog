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
                    Important information about the use of uk.com.pk content and services
                </p>
            </div>

            <div class="glass-card p-8 md:p-12 mb-8 space-y-6">
                <h2 class="text-3xl font-bold mb-4">General Disclaimer</h2>
                <p class="text-muted-foreground leading-relaxed text-lg">
                    uk.com.pk provides information about UK visas, study abroad opportunities, immigration processes, lifestyle tips, insurance guidance, and shopping resources for Pakistanis. While we strive to keep all information accurate and up-to-date, we do not guarantee the completeness, reliability, or accuracy of the content. All information is provided for general guidance only.
                </p>

                <h2 class="text-3xl font-bold mb-4 mt-8">Important Disclaimers</h2>
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="glass p-6 rounded-xl">
                        <h3 class="text-xl font-bold mb-3">No Immigration Advice</h3>
                        <p class="text-muted-foreground">
                            uk.com.pk does not provide legal immigration advice. For UK visa applications, always consult UKVI, licensed immigration advisers, or solicitors registered with OISC.
                        </p>
                    </div>
                    <div class="glass p-6 rounded-xl">
                        <h3 class="text-xl font-bold mb-3">Educational Information Only</h3>
                        <p class="text-muted-foreground">
                            Information about UK universities, courses, and scholarships is for guidance only. Verify admission requirements directly with institutions before applying.
                        </p>
                    </div>
                    <div class="glass p-6 rounded-xl">
                        <h3 class="text-xl font-bold mb-3">Insurance & Financial Content</h3>
                        <p class="text-muted-foreground">
                            Insurance tips and financial information on uk.com.pk are general in nature. Consult qualified financial advisors for personalized advice before making decisions.
                        </p>
                    </div>
                    <div class="glass p-6 rounded-xl">
                        <h3 class="text-xl font-bold mb-3">External Links & Affiliates</h3>
                        <p class="text-muted-foreground">
                            uk.com.pk may contain affiliate links and links to third-party websites. We are not responsible for external content, products, or services offered by other sites.
                        </p>
                    </div>
                </div>

                <h2 class="text-3xl font-bold mb-4 mt-8">Your Responsibility</h2>
                <p class="text-muted-foreground leading-relaxed text-lg">
                    UK immigration rules, visa requirements, and policies change frequently. uk.com.pk strongly recommends that all users verify information with official sources including the UK Home Office (gov.uk), UKVI, and relevant embassies before making any decisions about visas, immigration, study, or settlement in the United Kingdom. By using this website, you accept full responsibility for your actions based on the information provided.
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
