@extends('layouts.app')
@section('title', 'DBS-RESOURCE-LIST')
@section('content')

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/6284058009" class="whatsapp-button" target="_blank">
        <i class="fab fa-whatsapp"></i>
        Contact Us
    </a>

    

    {{-- Page Hero Banner --}}
    <div class="page-hero">
        <div class="page-hero-blob page-hero-blob-1"></div>
        <div class="page-hero-blob page-hero-blob-2"></div>
        <div class="page-hero-content">
            <h1 class="page-hero-title" data-aos="fade-up">Resource List</h1>
            <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="120">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home.get') }}"><i class="fas fa-home me-1"></i>Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Resource List</li>
                </ol>
            </nav>
        </div>
        <div class="page-hero-wave">
            <svg viewBox="0 0 1440 56" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"><path d="M0,28 C360,56 1080,0 1440,28 L1440,56 L0,56 Z" fill="#f4f6f9"/></svg>
        </div>
    </div>

    <div class="page-editor-wrap">
        <div class="container py-5 section-min-h" data-aos="fade-up">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="page-content-card">
                        <div class="page-content-accent-bar"></div>
                        <div class="page-content-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr class="tbl-header-muted">
                                            <th width="10%" class="resource-heading">S.No.</th>
                                            <th width="30%" class="resource-heading">Class</th>
                                            <th width="30%" class="resource-heading">Session</th>
                                            <th width="30%" class="resource-heading">Download</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($lists !== null && count($lists) > 0)
                                            @foreach ($lists as $key => $list)
                                                <tr class="resource-list">
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $list->resource_name }}</td>
                                                    <td>{{ $list->session }}</td>
                                                    <td>
                                                        <button class="btn btn-download">
                                                            <a class="btn-download" target="_blank"
                                                                href="{{ Storage::url($list->resource_file_path) }}">View/Download</a>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4" class="text-center">No records found.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/show.css') }}">
@endsection
