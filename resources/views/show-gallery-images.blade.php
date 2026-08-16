@extends('layouts.app')
@section('title', '{{ $album->album_name }} – Gallery – DBELS')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/show.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
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
            <h1 class="page-hero-title" data-aos="fade-up">{{ $album->album_name }}</h1>
            <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="120">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home.get') }}"><i class="fas fa-home me-1"></i>Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $album->album_name }}</li>
                </ol>
            </nav>
        </div>
        <div class="page-hero-wave">
            <svg viewBox="0 0 1440 56" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"><path d="M0,28 C360,56 1080,0 1440,28 L1440,56 L0,56 Z" fill="#f4f6f9"/></svg>
        </div>
    </div>

    <div class="container py-5 section-min-h-lg">
        <div class="row g-3">
            @foreach ($album->images as $index => $image)
                <div class="col-md-4 col-sm-6" data-aos="zoom-in" data-aos-delay="{{ ($index % 6) * 60 }}">
                    <a data-fancybox="gallery" href="{{ asset('storage/' . $image->album_image_path) }}"
                        class="gallery-photo-wrap d-block overflow-hidden rounded-3 shadow-sm">
                        <img src="{{ asset('storage/' . $image->album_image_path) }}"
                            alt="Photo {{ $index + 1 }}" loading="lazy"
                            class="gallery-photo-img w-100">
                    </a>
                </div>
            @endforeach
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
@endsection
