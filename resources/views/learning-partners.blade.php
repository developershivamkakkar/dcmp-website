@extends('layouts.app')

@section('title', 'Learning Partners — ' . config('site.name'))
@section('meta-description', 'Meet our valued learning partners at ' . config('site.name') . '. Organizations committed to excellence in education.')

@section('content')

{{-- Page Header --}}
<div class="page-header py-5 bg-light">
    <div class="container">
        <h1 class="page-title mb-2">Learning Partners</h1>
        <p class="lead text-muted">Organizations & institutions collaborating with {{ config('site.name') }}</p>
    </div>
</div>

{{-- Partners Section --}}
<section class="py-5">
    <div class="container">
        @if($partners->count() > 0)
            <div class="partners-grid">
                <div class="row g-4">
                    @foreach($partners as $partner)
                        <div class="col-md-6 col-lg-4">
                            <div class="partner-card">
                                <div class="partner-logo-wrapper bg-light d-flex align-items-center justify-content-center">
                                    @if($partner->logo_path)
                                        @if($partner->website_url)
                                            <a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer"
                                               class="text-decoration-none d-flex align-items-center justify-content-center w-100 h-100">
                                                <img src="{{ Storage::url($partner->logo_path) }}"
                                                     alt="{{ $partner->name }}"
                                                     class="img-fluid"
                                                     style="max-height: 140px; object-fit: contain;">
                                            </a>
                                        @else
                                            <img src="{{ Storage::url($partner->logo_path) }}"
                                                 alt="{{ $partner->name }}"
                                                 class="img-fluid"
                                                 style="max-height: 140px; object-fit: contain;">
                                        @endif
                                    @else
                                        <span class="text-muted fw-500">{{ $partner->name }}</span>
                                    @endif
                                </div>

                                <div class="partner-info">
                                    <h4 class="partner-name mb-2">{{ $partner->name }}</h4>
                                    @if($partner->description)
                                        <p class="partner-description mb-3">
                                            {{ $partner->description }}
                                        </p>
                                    @endif

                                    @if($partner->website_url)
                                        <a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer"
                                           class="btn btn-sm btn-outline-primary">
                                            Visit Website <i class="fas fa-external-link-alt ms-2" style="font-size: 0.75rem;"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="alert alert-info text-center py-5">
                <i class="fas fa-info-circle me-2"></i>
                <span>No learning partners to display at this time.</span>
            </div>
        @endif
    </div>
</section>

<style>
.partner-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 12px;
    overflow: hidden;
    background: white;
    border: 1px solid #e8e8e8;
    display: flex;
    flex-direction: column;
}

.partner-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
}

.partner-logo-wrapper {
    padding: 2rem 1.5rem !important;
    background: #f8f9fa !important;
    flex-shrink: 0;
}

.partner-logo-wrapper img {
    transition: opacity 0.3s ease;
}

.partner-card:hover .partner-logo-wrapper img {
    opacity: 0.85;
}

.partner-info {
    padding: 1.5rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.partner-name {
    font-weight: 700;
    color: #1a1a1a;
    font-size: 1.1rem;
}

.partner-description {
    font-size: 0.9rem;
    line-height: 1.5;
    color: #666;
    flex-grow: 1;
}

.partner-info .btn {
    align-self: flex-start;
    margin-top: auto;
}
</style>

@endsection
