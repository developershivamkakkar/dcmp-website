@extends('layouts.app')
@section('title', 'Transfer Certificate – DBELS')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/show.css') }}">
@endsection

@section('content')

    {{-- Floating WhatsApp --}}
    <a href="https://api.whatsapp.com/send/?phone={{ config('site.whatsapp') }}&text=Hello%20Dass%20and%20Brown%20Experiential%20Learning%20School&type=phone_number&app_absent=0"
       class="whatsapp-button" target="_blank">
        <i class="fab fa-whatsapp"></i> Contact Us
    </a>

    {{-- Page Hero --}}
    <div class="page-hero">
        <div class="page-hero-blob page-hero-blob-1"></div>
        <div class="page-hero-blob page-hero-blob-2"></div>
        <div class="page-hero-content">
            <h1 class="page-hero-title" data-aos="fade-up">Transfer Certificate</h1>
            <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="120">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home.get') }}"><i class="fas fa-home me-1"></i>Home</a></li>
                    <li class="breadcrumb-item active">Transfer Certificate</li>
                </ol>
            </nav>
        </div>
        <div class="page-hero-wave">
            <svg viewBox="0 0 1440 56" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,28 C360,56 1080,0 1440,28 L1440,56 L0,56 Z" fill="#f4f6f9"/>
            </svg>
        </div>
    </div>

    <div class="container py-5" style="max-width: 720px;">

        {{-- ── Info card ──────────────────────────────────────────────────── --}}
        <div class="card shadow-sm border-0 mb-4" data-aos="fade-up">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-2" style="color: var(--color-primary);">
                    <i class="fas fa-info-circle me-2"></i>How to obtain your TC
                </h5>
                <ul class="mb-0 text-muted" style="line-height: 2;">
                    <li>Enter your <strong>Admission Number</strong> below to search and download your Transfer Certificate.</li>
                    <li>If your TC is not available online, please visit the school office.</li>
                    <li>For queries contact: <a href="tel:{{ config('site.phone') }}">{{ config('site.phone') }}</a></li>
                </ul>
            </div>
        </div>

        {{-- ── Search form ─────────────────────────────────────────────────── --}}
        <div class="card shadow-sm border-0 mb-4" data-aos="fade-up" data-aos-delay="80">
            <div class="card-header py-3" style="background: var(--color-primary);">
                <h6 class="mb-0 text-white fw-bold">
                    <i class="fas fa-search me-2"></i>Search Transfer Certificate
                </h6>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('tc.search') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="admission_number" class="form-control form-control-lg text-uppercase
                               @error('admission_number') is-invalid @enderror"
                               placeholder="Enter Admission Number"
                               value="{{ old('admission_number', request('admission_number')) }}"
                               required>
                        <button class="btn btn-lg text-white" type="submit"
                                style="background: var(--color-primary); border-color: var(--color-primary);">
                            <i class="fas fa-search me-1"></i> Search
                        </button>
                    </div>
                    @error('admission_number')
                        <div class="text-danger mt-1 small">{{ $message }}</div>
                    @enderror
                </form>
            </div>
        </div>

        {{-- ── Result ───────────────────────────────────────────────────────── --}}
        @if (isset($searched))
            @if (isset($tc))
                <div class="card shadow border-0 border-start border-4 mb-4" data-aos="fade-up"
                     style="border-color: var(--color-primary) !important;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                                 style="width:52px;height:52px;background:var(--color-primary-light);">
                                <i class="fas fa-file-pdf fa-lg" style="color:var(--color-primary);"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-0" style="color:var(--color-primary);">{{ $tc->student_name }}</h5>
                                <span class="text-muted small">Admission No: <strong>{{ $tc->admission_number }}</strong></span>
                            </div>
                        </div>
                        <table class="table table-sm mb-4">
                            <tr><th width="40%">Father's Name</th><td>{{ $tc->father_name }}</td></tr>
                            <tr><th>Session</th><td>{{ $tc->session }}</td></tr>
                        </table>
                        <a href="{{ Storage::url($tc->tc_file_path) }}" target="_blank"
                           class="btn btn-lg w-100 text-white fw-bold"
                           style="background: var(--color-primary); border-color: var(--color-primary);"
                           download>
                            <i class="fas fa-download me-2"></i> Download Transfer Certificate
                        </a>
                    </div>
                </div>
            @else
                <div class="alert alert-warning d-flex align-items-center gap-2" data-aos="fade-up">
                    <i class="fas fa-exclamation-triangle fa-lg"></i>
                    <div>
                        No Transfer Certificate found for admission number
                        <strong>{{ $admNo }}</strong>.
                        Please contact the school office.
                    </div>
                </div>
            @endif
        @endif

    </div>

@endsection
