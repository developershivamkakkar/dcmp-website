@extends('layouts.app')
@section('title', 'School Events')
@section('content')

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/6284058009" class="whatsapp-button" target="_blank">
        <i class="fab fa-whatsapp"></i> Contact Us
    </a>

    

    {{-- Page Hero Banner --}}
    <div class="page-hero">
        <div class="page-hero-blob page-hero-blob-1"></div>
        <div class="page-hero-blob page-hero-blob-2"></div>
        <div class="page-hero-content">
            <h1 class="page-hero-title" data-aos="fade-up">School Events</h1>
            <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="120">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home.get') }}"><i class="fas fa-home me-1"></i>Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Events</li>
                </ol>
            </nav>
        </div>
        <div class="page-hero-wave">
            <svg viewBox="0 0 1440 56" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"><path d="M0,28 C360,56 1080,0 1440,28 L1440,56 L0,56 Z" fill="#f4f6f9"/></svg>
        </div>
    </div>

    <div class="blog-section-wrap py-5">
        <div class="container section-min-h-600">
            <div class="row g-4">
                @foreach ($events as $event)
                    <div class="col-lg-3 col-md-6 col-12" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                        <a href="{{ route('event.detail.get', ['slug' => $event->slug]) }}" class="blog-card-link">
                            <div class="blog-card-v2">
                                <div class="blog-card-v2-img-wrap">
                                    <img src="{{ Storage::url($event->event_image_path) }}" loading="lazy"
                                        class="blog-card-v2-img" alt="{{ $event->title }}">
                                    <div class="blog-card-v2-img-overlay"></div>
                                </div>
                                <div class="blog-card-v2-body">
                                    <div class="blog-card-v2-date">
                                        <i class="far fa-calendar-alt me-1"></i>{{ $event->event_date ? $event->event_date->format('M j, Y') : 'TBD' }}
                                    </div>
                                    <h5 class="blog-card-v2-title">{{ Str::limit($event->title, 65) }}</h5>
                                    <span class="blog-card-v2-cta">Read More <i class="fas fa-arrow-right"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $events->links() }}
            </div>
        </div>
    </div>

@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/show.css') }}">
@endsection
