@extends('layouts.app')
@section('title', 'Activities Gallery – DBELS')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/show.css') }}">
@endsection

@section('content')

    <a href="https://api.whatsapp.com/send/?phone=9115992924&text=Hello%20Dass%20and%20Brown%20Experiential%20Learning%20School&type=phone_number&app_absent=0"
        class="whatsapp-button" target="_blank">
        <i class="fab fa-whatsapp"></i> Contact Us
    </a>
    

    <div class="page-hero">
        <div class="page-hero-blob page-hero-blob-1"></div>
        <div class="page-hero-blob page-hero-blob-2"></div>
        <div class="page-hero-content">
            <h1 class="page-hero-title" data-aos="fade-up">Activities</h1>
            <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="120">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home.get') }}"><i class="fas fa-home me-1"></i>Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('gallery-activities.get') }}">Gallery</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Activities</li>
                </ol>
            </nav>
        </div>
        <div class="page-hero-wave">
            <svg viewBox="0 0 1440 56" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"><path d="M0,28 C360,56 1080,0 1440,28 L1440,56 L0,56 Z" fill="#f4f6f9"/></svg>
        </div>
    </div>

    <div class="container py-5 section-min-h-lg">
        <div class="row g-4">
            @if (isset($albums) && $albums->count() > 0)
                @foreach ($albums as $index => $album)
                    @if (!$album->images->isEmpty())
                        <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="{{ ($index % 6) * 80 }}">
                            <a href="{{ route('activities.images.show', $album->id) }}" class="gallery-album-card">
                                <div class="gallery-album-img-wrap">
                                    <img src="{{ asset('storage/' . $album->images->first()->album_image_path) }}"
                                        alt="{{ $album->album_name }}" loading="lazy" class="gallery-album-img">
                                    <div class="gallery-album-overlay">
                                        <i class="fas fa-images gallery-album-icon"></i>
                                        <span class="gallery-album-count">{{ $album->images->count() }} Photos</span>
                                    </div>
                                </div>
                                <div class="gallery-album-body">
                                    <h5 class="gallery-album-title">{{ $album->album_name }}</h5>
                                    <span class="gallery-album-cta">View Album <i class="fas fa-arrow-right"></i></span>
                                </div>
                            </a>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="col-12 text-center py-5">
                    <i class="fas fa-images fa-3x text-muted mb-3"></i>
                    <p class="text-muted">No albums found.</p>
                </div>
            @endif
        </div>
    </div>

@endsection
