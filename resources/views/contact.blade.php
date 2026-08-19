@extends('layouts.app')
@section('title', 'Contact Us – ' . config('site.name'))

@section('meta-description', config('site.meta_description'))

@section('meta-keywords', config('site.meta_keywords'))

@section('content')




    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/91{{ config('site.whatsapp') }}" class="whatsapp-button" target="_blank">
        <i class="fab fa-whatsapp"></i>
        Contact Us
    </a>

    {{-- Page Hero Banner --}}
    <div class="page-hero">
        <div class="page-hero-blob page-hero-blob-1"></div>
        <div class="page-hero-blob page-hero-blob-2"></div>
        <div class="page-hero-content">
            <h1 class="page-hero-title" data-aos="fade-up">Contact Us</h1>
            <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="120">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home.get') }}"><i class="fas fa-home me-1"></i>Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                </ol>
            </nav>
        </div>
        <div class="page-hero-wave">
            <svg viewBox="0 0 1440 56" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,28 C360,56 1080,0 1440,28 L1440,56 L0,56 Z" fill="#f4f6f9" />
            </svg>
        </div>
    </div>

    <div class="container-fluid">
        <div class="container">
            {{-- Success Modal --}}
            <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-custom-width modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header modal-header-primary">
                            <h5 class="modal-title" id="successModalLabel">Success</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <i class="fas fa-check-circle"></i>
                            <p>Your enquiry has been submitted successfully!</p>
                        </div>
                    </div>
                </div>
            </div>
            @if (Session::has('success'))
                <div id="contact-alert" class="alert alert-success contact-alert-hidden" data-bs-toggle="modal"
                    data-bs-target="#successModal">
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="container mt-5 pb-5">
                <div class="row">
                    <div class="col-lg-7">
                        <h3 class="heading-secondary">Join Us In</h3>
                        <h3 class="fw-bold">Shaping the Future of Education</h3>
                        <div class="my-2">
                            <h5 class="fw-bold">Site Office:</h5>
                            <p>{{ config('site.address.line1') }}<br>{{ config('site.address.line2') }}<br>{{ config('site.address.city') }},
                                {{ config('site.address.state') }} – {{ config('site.address.postal_code') }}
                            </p>
                            <p><i class="fas fa-envelope me-1"></i><a href="mailto:{{ config('site.email_info') }}"
                                    class="text-reset text-decoration-none">{{ config('site.email_info') }}</a></p>
                        </div>

                        <div class="my-2">
                            <h5 class="fw-bold">Admissions Office:</h5>
                            <p><i class="fas fa-envelope me-1"></i><a href="mailto:{{ config('site.email_admissions') }}"
                                    class="text-reset text-decoration-none">{{ config('site.email_admissions') }}</a></p>
                        </div>
                        <div class="mt-2">
                            <h4 class="fw-bold">Call us:</h4>
                            <p><i class="fas fa-phone me-1"></i><a
                                    href="tel:{{ preg_replace('/[^0-9+]/', '', config('site.phone')) }}"
                                    class="text-reset text-decoration-none">{{ config('site.phone') }}</a></p>
                        </div>
                        <h5 class="mt-2 mb-2">Follow us on:</h5>
                        <div class="mt-2 mb-4">
                            @if(config('site.social.facebook'))
                                <a href="{{ config('site.social.facebook') }}" target="_blank" rel="noopener noreferrer"
                                    class="text-dark mx-2"><i class="fab fa-facebook fa-2x"></i></a>
                            @endif
                            @if(config('site.social.instagram'))
                                <a href="{{ config('site.social.instagram') }}" target="_blank" rel="noopener noreferrer"
                                    class="text-dark mx-2"><i class="fab fa-instagram fa-2x"></i></a>
                            @endif
                            @if(config('site.social.linkedin'))
                                <a href="{{ config('site.social.linkedin') }}" target="_blank" rel="noopener noreferrer"
                                    class="text-dark mx-2"><i class="fab fa-linkedin fa-2x"></i></a>
                            @endif
                            @if(config('site.social.twitter'))
                                <a href="{{ config('site.social.twitter') }}" target="_blank" rel="noopener noreferrer"
                                    class="text-dark mx-2"><i class="fab fa-twitter fa-2x"></i></a>
                            @endif
                            @if(config('site.social.youtube'))
                                <a href="{{ config('site.social.youtube') }}" target="_blank" rel="noopener noreferrer"
                                    class="text-dark mx-2"><i class="fab fa-youtube fa-2x"></i></a>
                            @endif
                            @if(config('site.whatsapp'))
                                <a href="https://wa.me/91{{ config('site.whatsapp') }}" target="_blank"
                                    rel="noopener noreferrer" class="text-dark mx-2"><i class="fab fa-whatsapp fa-2x"></i></a>
                            @endif
                        </div>

                    </div>
                    <div class="col-lg-5 mb-3">
                        <form class="contact-form" method="POST" action="{{ route('contact.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="text-center">
                                <img class="rounded contact-logo" src="{{ asset('storage/assets/dcmp-logo.png') }}"
                                    alt="dbels-logo">
                            </div>
                            <div class="mb-2 mt-1">
                                <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                <input type="name" class="form-control" id="name" placeholder="Enter name" name="name">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-2">
                                <label for="phone_number" class="form-label">Phone Number<span
                                        class="text-danger">*</span></label>
                                <input type="phone_number" class="form-control" id="phone_number"
                                    placeholder="Enter Phone Number" name="phone_number"> </textarea>
                                @error('phone_number')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="message" class="form-label">Message<span class="text-danger">*</span></label>
                                <textarea type="message" class="form-control" id="message" placeholder="Enter Message"
                                    name="message"> </textarea>
                                @error('message')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-secondary-custom">Submit</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/show.css') }}">
@endsection
