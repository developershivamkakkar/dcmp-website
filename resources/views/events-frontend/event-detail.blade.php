@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/show.css') }}">
    <style>
        /* ── Page Editor — Brand Colors ─────────────────────────────── */
        /*    Primary (Teal)  #052A56  |  Accent (Green) #00A859  |  Link (Blue) #0066b5  */
        .page-editor .content {
            overflow-x: auto;
            word-wrap: break-word;
            font-family: 'Poppins', sans-serif;
            font-size: 15.5px;
            line-height: 1.85;
            color: #333;
        }

        /* Headings */
        .page-editor h1,
        .page-editor h2,
        .page-editor h3,
        .page-editor h4,
        .page-editor h5,
        .page-editor h6 {
            font-family: 'Lora', serif;
            color: #052A56;
            margin-top: 1.6rem;
            margin-bottom: 0.75rem;
            font-weight: 700;
        }
        .page-editor h2 {
            border-left: 4px solid #00A859;
            padding-left: 12px;
        }

        /* Paragraphs */
        .page-editor p {
            font-family: 'Poppins', sans-serif;
            font-size: 15.5px;
            line-height: 1.85;
            color: #2d2d2d !important;
            margin-bottom: 1.1rem;
        }
        /* Kill pasted inline colors from Word / Google Docs */
        .page-editor span {
            color: inherit !important;
            font-size: inherit !important;
            font-family: inherit !important;
            background-color: transparent !important;
        }
        .page-editor li {
            color: #2d2d2d !important;
            font-size: 15.5px;
            line-height: 1.85;
        }

        /* Links */
        .page-editor a { color: #0066b5; text-decoration: underline; }
        .page-editor a:hover { color: #004d8c; }

        /* Blockquote */
        .page-editor blockquote {
            border-left: 4px solid #00A859;
            padding: 12px 20px;
            background: #fdf8ee;
            border-radius: 0 8px 8px 0;
            color: #555;
            margin: 1.5rem 0;
            font-style: italic;
        }

        /* Tables */
        .page-editor table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            margin-bottom: 1.5rem;
            border-radius: 8px;
            overflow: hidden;
        }
        .page-editor table th,
        .page-editor figure.table table th {
            background-color: #052A56 !important;
            color: #ffffff !important;
            font-weight: 600;
            padding: 12px 16px;
            text-align: left;
            border: none;
        }
        .page-editor table td {
            padding: 11px 16px;
            border-bottom: 1px solid #eeeeee;
            text-align: left;
            vertical-align: top;
        }
        .page-editor table tr:nth-child(even) td { background-color: #f8f9fc; }
        .page-editor table tr:hover td { background-color: #fdf8ee; }

        /* Responsive images */
        .page-editor img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 1.5rem auto;
            border-radius: 8px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.10);
        }
        .image_resized {
            margin-left: auto;
            margin-right: auto;
            max-width: 100% !important;
        }
    </style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.page-editor th').forEach(function (th) {
        const c = th.style.color;
        if (!c || c === 'rgb(0, 0, 0)' || c === 'hsl(0, 0%, 0%)' || c === '#000000' || c === 'black') {
            th.style.removeProperty('color');
        }
    });
});
</script>
@endsection

@section('content')

<a href="https://wa.me/6284058009" class="whatsapp-button" target="_blank">
    <i class="fab fa-whatsapp"></i> Contact Us
</a>


{{-- Page Hero Banner --}}
<div class="page-hero">
    <div class="page-hero-blob page-hero-blob-1"></div>
    <div class="page-hero-blob page-hero-blob-2"></div>
    <div class="page-hero-content">
        <h1 class="page-hero-title" data-aos="fade-up">{{ $event->title }}</h1>
        <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="120">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home.get') }}"><i class="fas fa-home me-1"></i>Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('events.get') }}">Events</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($event->title, 40) }}</li>
            </ol>
        </nav>
    </div>
    <div class="page-hero-wave">
        <svg viewBox="0 0 1440 56" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"><path d="M0,28 C360,56 1080,0 1440,28 L1440,56 L0,56 Z" fill="#f4f6f9"/></svg>
    </div>
</div>

<div class="bg-light py-5">
    <div class="container">
        <div class="row g-4">

            {{-- ── Main Article ────────────────────────────────── --}}
            <div class="col-lg-8" data-aos="fade-up">
                <div class="bg-white rounded-3 shadow-sm overflow-hidden">
                    <img src="{{ Storage::url($event->event_image_path) }}"
                         class="img-fluid w-100" style="max-height:420px; object-fit:cover;"
                         alt="{{ $event->title }}">
                    <div class="p-4 p-md-5">
                        <div class="d-flex flex-wrap gap-3 align-items-center mb-4 pb-3 border-bottom">
                            <span class="text-muted small">
                                <i class="fa-regular fa-calendar-days text-danger me-1"></i>
                                Published: {{ $event->published_date->format('F j, Y') }}
                            </span>
                            <span class="text-muted small">
                                <i class="fa-solid fa-calendar-check text-danger me-1"></i>
                                Event Date: {{ $event->event_date ? $event->event_date->format('F j, Y') : 'TBD' }}
                            </span>
                        </div>
                        <div class="page-editor">
                            <div class="content">
                                {!! $event->content !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Sidebar ─────────────────────────────────────── --}}
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">

                {{-- Latest Events --}}
                <div class="bg-white rounded-3 shadow-sm p-4 mb-4">
                    <h5 class="fw-bold mb-3 pb-2 border-bottom" style="color:#052A56;">
                        <i class="fas fa-calendar-alt me-2"></i>Latest Events
                    </h5>
                    <ul class="list-unstyled mb-0">
                        @foreach ($events as $latestEvent)
                            <li class="d-flex gap-3 mb-3 pb-3 border-bottom">
                                <img src="{{ Storage::url($latestEvent->event_image_path) }}"
                                     class="rounded flex-shrink-0"
                                     style="width:64px; height:64px; object-fit:cover;"
                                     alt="{{ $latestEvent->title }}">
                                <div>
                                    <a href="{{ route('event.detail.get', $latestEvent->slug) }}"
                                       class="text-decoration-none fw-semibold sidebar-event-titles-link"
                                       style="font-size:13.5px; color:#222; line-height:1.4;">
                                        {{ Str::limit($latestEvent->title, 60) }}
                                    </a>
                                    <p class="text-muted mb-0 mt-1" style="font-size:12px;">
                                        <i class="fa-regular fa-calendar-days text-danger me-1"></i>
                                        {{ $latestEvent->event_date ? $latestEvent->event_date->format('M j, Y') : 'TBD' }}
                                    </p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- YouTube Video --}}
                {{-- <div class="bg-white rounded-3 shadow-sm p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold mb-0" style="color:#052A56; font-size:15px;">
                            <i class="fab fa-youtube me-2"></i>DBELS Walkthrough
                        </h5>
                        <a class="text-decoration-none small fw-semibold link-orange" target="_blank"
                           href="https://www.youtube.com/@dbelschd">See more</a>
                    </div>
                    <div class="ratio ratio-16x9 rounded overflow-hidden">
                        <iframe src="https://www.youtube.com/embed/OfPGCY2k9y4?si=IEd3yUQt2zrNWZfJ"
                            title="DBELS Walkthrough" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div> --}}

            </div>
        </div>
    </div>
</div>

@endsection
