@extends('layouts.app')

@section('title', 'DCM Presidency School (DCMP) - Best School in Ludhiana')

@section('meta-description',
    '')


@section('meta-keywords',
    'DCM Presidency School, DCMP, Best School in Ludhiana, Top School in Ludhiana, CBSE School in Ludhiana, Cambridge International School in Ludhiana, Experiential Learning School, Future-Ready Learning, Innovative Education, Holistic Development, Advanced Labs and Facilities, Award-Winning School, Global Exposure for Students')

@section('content')

    {{-- Popups Section --}}
    @if (count($popups) > 0)
        {{-- Popup Modal --}}
        <div id="popupModal" class="modal fade" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        {{-- Bootstrap Carousel --}}
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div id="popupCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($popups as $key => $popup)
                                    <div class="carousel-item @if ($key === 0) active @endif">
                                        <img src="{{ Storage::url($popup->image) }}" class="d-block w-100 img-fluid"
                                            alt="Popup Image">
                                    </div>
                                @endforeach
                            </div>
                            {{-- Carousel Controls --}}
                            <button class="carousel-control-prev" type="button" data-bs-target="#popupCarousel"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#popupCarousel"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif




    <!--Floating Strip Left-->
    <!--<div class="floating-left-strip">-->
    <!--    <a class="btn btn-sm" href="{{ route('job-form.get') }}">Careers</a>-->
    <!--</div>-->


    <!-- Floating WhatsApp Button -->
    <a href="https://api.whatsapp.com/send/?phone=9115992924&text=Hello%20Dass%20and%20Brown%20Experiential%20Learning%20School&type=phone_number&app_absent=0"
        class="whatsapp-button" target="_blank">
        <i class="fab fa-whatsapp"></i>
        Contact Us
    </a>


    {{-- Success Modal --}}
    <!--<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">-->
    <!--    <div class="modal-dialog modal-custom-width">-->
    <!--        <div class="modal-content">-->
    <!--            <div class="modal-header" style="background-color:rgb(26,79,156)">-->
    <!--                <h5 style="color: white;" class="modal-title" id="successModalLabel">Success</h5>-->
    <!--                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
    <!--            </div>-->
    <!--            <div class="modal-body">-->
    <!--                <i class="fas fa-check-circle"></i>-->
    <!--                <p>Thank you for contacting us.</p>-->
    <!--                <p>Your enquiry has been submitted successfully! We will contact you shortly</p>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
    <!--@if (Session::has('success'))
    -->
    <!--    <div id="contact-alert" class="alert alert-success" style="display: none;" data-bs-toggle="modal"-->
    <!--        data-bs-target="#successModal">-->
    <!--        {{ Session::get('success') }}-->
    <!--    </div>-->
    <!--
    @endif-->

    {{-- Model to Show on Enquire Now --}}
    <!--<div class="modal fade" id="enquiryModal" tabindex="-1" aria-labelledby="enquiryModalLabel" aria-hidden="true">-->
    <!--    <div class="modal-dialog model-sm">-->
    <!--        <div class="modal-content">-->
    <!--            <div class="modal-header" style="background: linear-gradient(30deg, #0C54A0, #027C3F, #E31E25, #FF9A14);";>-->
    <!--                <h5 class="modal-title" id="enquiryModalLabel" style="color: white;">Enquire Now</h5>-->
    <!--                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
    <!--            </div>-->
    <!--            <div class="modal-body">-->
    <!-- Your form goes here -->
    <!--                <form method="POST" action="{{ route('contact.store') }}" enctype="multipart/form-data">-->
    <!--                    @csrf-->
    <!--                    <div class="text-center">-->
    <!--                        <img class="rounded" src="{{ asset('storage/assets/dcmp-logo.png') }}" alt="dbels-logo"-->
    <!--                            style="width:100px;height:100px; background-color:#ffffff00; object-fit:contain;">-->
    <!--                    </div>-->
    <!--                    <div class="mb-2 mt-1">-->
    <!--                        <label class="enquiry-model-field mt-2" for="name" class="form-label"> Name <span-->
    <!--                                class="text-danger">*</span></label>-->
    <!--                        <input type="text" class="form-control" id="name" placeholder="Enter name"-->
    <!--                            name="name" required>-->
    <!--                        @error('name')
        -->
        <!--                            <div class="text-danger">{{ $message }}</div>-->
        <!--
    @enderror-->
    <!--                    </div>-->
    <!--                    <div class="mb-2">-->
    <!--                        <label class="enquiry-model-field mt-2" for="email" class="form-label"> Email <span-->
    <!--                                class="text-danger">*</span></label>-->
    <!--                        <input type="email" class="form-control" id="email" placeholder="Enter Email"-->
    <!--                            name="email" required>-->
    <!--                        @error('email')
        -->
        <!--                            <div class="text-danger">{{ $message }}</div>-->
        <!--
    @enderror-->
    <!--                    </div>-->
    <!--                    <div class="mb-2">-->
    <!--                        <label class="enquiry-model-field mt-2" for="phone_number" class="form-label"> Phone Number-->
    <!--                            <span class="text-danger">*</span></label>-->
    <!--                        <input type="text" class="form-control" id="phone_number" placeholder="Enter Phone Number"-->
    <!--                            name="phone_number" required>-->
    <!--                        @error('phone_number')
        -->
        <!--                            <div class="text-danger">{{ $message }}</div>-->
        <!--
    @enderror-->
    <!--                    </div>-->
    <!--                    <div class="mb-2">-->
    <!--                        <label class="enquiry-model-field mt-2" for="message" class="form-label"> Message <span-->
    <!--                                class="text-danger">*</span></label>-->
    <!--                        <textarea type="text" class="form-control" id="message" placeholder="Enter Message" name="message"></textarea>-->
    <!--                        @error('message')
        -->
        <!--                            <div class="text-danger">{{ $message }}</div>-->
        <!--
    @enderror-->
    <!--                    </div>-->

    <!--                    <button type="submit" class="btn btn-primary"-->
    <!--                        style="background-color:rgb(26,79,156); border-radius:5px; border:none">Submit</button>-->
    <!--                </form>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
    <div id="carouselExampleCaptions" class="carousel slide animate-aos" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @foreach ($banners as $key => $banner)
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $key }}"
                    @if ($loop->first) class="active" @endif
                    aria-label="Slide {{ $key + 1 }}"></button>
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach ($banners as $key => $banner)
                <div class="carousel-item @if ($loop->first) active @endif">
                    <img loading="eager" src="{{ Storage::url($banner->banner_image_path) }}" class="d-block w-100 hero-slide-img"
                        alt="banner_image">
                    <div class="carousel-caption d-none d-md-block">
                        {{-- Your caption content here --}}
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    {{-- End of Hero Slider Section --}}

    {{-- Admissions CTA Section --}}
    <section class="admission-cta-section">

        {{-- Decorative blobs --}}
        <div class="adm-blob adm-blob-1"></div>
        <div class="adm-blob adm-blob-2"></div>

        <div class="container position-relative" style="z-index:1">
            <div class="row align-items-center gy-5">

                {{-- Left: text + buttons --}}
                <div class="col-lg-7 text-white" data-aos="fade-right">
                    <span class="adm-badge"><i class="fas fa-star me-1"></i> Admissions Open 2026–27</span>
                    <h2 class="adm-title mt-3">Give Your Child the Education They Deserve</h2>
                    <p class="adm-subtitle">DCM Presidency School is now accepting applications. Secure your child's future with Digitally Networked Smart School With Cutting Edge Technology</p>

                    <div class="d-flex gap-2 gap-md-3 mt-4 flex-wrap" style="flex-wrap: wrap !important;">
                        @if ($enquiryUrl)
                            <a href="{{ $enquiryUrl }}" target="_blank" rel="noopener noreferrer" class="adm-btn-primary">
                                <i class="fas fa-question-circle me-2"></i>Enquire Now
                            </a>
                        @else
                            <button class="adm-btn-primary npfWidgetButton npfWidget-cbdb663e4ed49cb2c31d9bd90e87b6c7">
                                <i class="fas fa-question-circle me-2"></i>Enquire Now
                            </button>
                        @endif
                        <a href="{{ $registrationUrl }}" target="_blank" rel="noopener noreferrer" class="adm-btn-outline">
                            <i class="fas fa-pen me-2"></i>Register Now
                        </a>
                    </div>
                </div>

                {{-- Right: stats --}}
                <div class="col-lg-5" data-aos="fade-left" data-aos-delay="150">
                    <div class="adm-stats-grid">
                        <div class="adm-stat">
                            <span class="adm-stat-num">50<span class="adm-stat-plus">+</span></span>
                            <span class="adm-stat-label">National Awards &amp; Prestigious Recognitions</span>
                        </div>
                        <div class="adm-stat">
                            <i class="fas fa-graduation-cap adm-stat-icon"></i>
                            <span class="adm-stat-label">CBSE Curriculum</span>
                        </div>
                        <div class="adm-stat">
                            <i class="fab fa-microsoft adm-stat-icon"></i>
                            <span class="adm-stat-label">Proud Microsoft Showcase School</span>
                        </div>
                        <div class="adm-stat">
                            <i class="fas fa-robot adm-stat-icon"></i>
                            <span class="adm-stat-label">Advanced AI, Robotics &amp; STEAM Innovation Labs</span>
                        </div>
                        <div class="adm-stat">
                            <span class="adm-stat-num">2000<span class="adm-stat-plus">+</span></span>
                            <span class="adm-stat-label">Young Leaders Inspired &amp; Empowered</span>
                        </div>
                        <div class="adm-stat">
                            <i class="fas fa-globe adm-stat-icon"></i>
                            <span class="adm-stat-label">International Exposure &amp; Global Exchange Opportunities</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- Explore Your Potential --}}
    <div class="container-fluid py-5 animate-aos">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <div class="row">
                        <div class="col-3 col-sm-3 col-md-3 col-lg-3 d-flex justify-content-center align-items-center">
                            <img loading="lazy" class="pb-md-4 pb-sm-4 pb-4 explore-logo"
                                src="{{ asset('storage/assets/dcmp-logo.png') }}" alt="dcmp-logo">
                        </div>
                        <div class="col-9 col-sm-9 col-md-9 col-lg-9" data-aos="fade-up" data-aos-delay="400">
                            <h2 class="explore-potential-heading mb-4">
                                DIGITALLY NETWORKED SMART SCHOOL
                                <span class="fw-bold explore-text">WITH CUTTING EDGE TECHNOLOGY</span>
                            </h2>
                        </div>
                    </div>
                    <p class="explore-potential-text" data-aos="fade-up" data-aos-delay="500">
                        Located in the serene environment of Panchkula, (Tri City) , <br> Dass & Brown Experiential Learning
                        School is designed to cultivate competent & conscientious individuals who can think ahead of their
                        times. Dbels is designed with modern architecture & is going to be the first of its kind, centrally
                        air-conditioned, state-of-the-art, Wi-Fi enabled, digitally equipped campus.
                    </p>
                </div>
                <div class="col-lg-6 h-100 shadow-sm p-1" data-aos="fade-left" data-aos-delay="600">
                    <!--<iframe width="100%" style="aspect-ratio: 2.02;"-->
                    <!--    src="https://www.youtube.com/embed/OfPGCY2k9y4?si=IEd3yUQt2zrNWZfJ" title="YouTube video player"-->
                    <!--    frameborder="0"-->
                    <!--    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"-->
                    <!--    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>-->
                    {{-- Second-Slider Section --}}
                    <div id="explore" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            @foreach ($explorebanners as $key => $explorebanner)
                                <button type="button" data-bs-target="#explore" data-bs-slide-to="{{ $key }}"
                                    @if ($loop->first) class="active" @endif
                                    aria-label="Slide {{ $key + 1 }}"></button>
                            @endforeach
                        </div>
                        <div class="carousel-inner">
                            @foreach ($explorebanners as $key => $explorebanner)
                                <div class="carousel-item @if ($loop->first) active @endif">
                                    <img loading="lazy" src="{{ Storage::url($explorebanner->banner_image_path) }}"
                                        class="d-block w-100 explore-slide-img" alt="Slide {{ $key + 1 }}">
                                    <div class="carousel-caption d-none d-md-block">
                                        {{-- Your caption content here --}}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#explore"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#explore"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Card Highlights Section --}}
    <div class="container-fluid highlights-section py-5" data-aos="fade-up">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col">
                    <span class="hlt-eyebrow">Quick Access</span>
                    <h2 class="section-title mt-2">Explore More with DCMP</h2>
                    <p class="text-light opacity-75">Everything you need, just a click away</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <a href="https://admissions.dassandbrownschool.com/" class="hlt-card">
                        <div class="hlt-card-top-bar"></div>
                        <div class="hlt-card-body">
                            <div class="hlt-card-icon-wrap">
                                <img src="{{ asset('storage/assets/facilities-images/admission-enquiry.png') }}" alt="admissions" loading="lazy">
                            </div>
                            <h3 class="hlt-card-title">Admission Enquiry</h3>
                            <p class="hlt-card-desc">Begin your child's journey. Apply now for the 2026–27 academic year.</p>
                            <span class="hlt-card-cta">Enquire Now <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('blogs.get') }}" class="hlt-card">
                        <div class="hlt-card-top-bar"></div>
                        <div class="hlt-card-body">
                            <div class="hlt-card-icon-wrap">
                                <img src="{{ asset('storage/assets/facilities-images/blogs.png') }}" alt="blog" loading="lazy">
                            </div>
                            <h3 class="hlt-card-title">Blogs</h3>
                            <p class="hlt-card-desc">Insights, stories and the latest news from the DCMP community.</p>
                            <span class="hlt-card-cta">Read Blogs <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <a href="{{ route('job-form.get') }}" class="hlt-card">
                        <div class="hlt-card-top-bar"></div>
                        <div class="hlt-card-body">
                            <div class="hlt-card-icon-wrap">
                                <img src="{{ asset('storage/assets/facilities-images/careers.png') }}" alt="career" loading="lazy">
                            </div>
                            <h3 class="hlt-card-title">Careers</h3>
                            <p class="hlt-card-desc">Join our team of passionate educators, innovators and changemakers.</p>
                            <span class="hlt-card-cta">View Openings <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <a href="{{ route('contact') }}" class="hlt-card">
                        <div class="hlt-card-top-bar"></div>
                        <div class="hlt-card-body">
                            <div class="hlt-card-icon-wrap">
                                <img src="{{ asset('storage/assets/facilities-images/contact.png') }}" alt="contact" loading="lazy">
                            </div>
                            <h3 class="hlt-card-title">Contact Us</h3>
                            <p class="hlt-card-desc">Have a question? We're here to help and guide you every step of the way.</p>
                            <span class="hlt-card-cta">Get in Touch <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>


    <!-- What Sets Us Apart Section -->
    <section class="what-sets-us-apart py-5 bg-light" data-aos="fade-up">
        <div class="container">

            <!-- Section Header -->
            <div class="text-center mb-5">
                <h2 class="fw-bold" data-aos="zoom-in">What Sets Us Apart</h2>
                <p class="text-muted mt-2" data-aos="fade-up" data-aos-delay="150">
                    A Future-Ready Learning Ecosystem Built on Excellence, Innovation & Global Exposure
                </p>
            </div>

            <!-- MAIN ROW -->
            <div class="row g-4">

                <!-- LEFT SIDE -->
                <div class="col-12 col-lg-4 d-flex">
                    <div class="d-flex flex-column justify-content-between gap-3 h-100 w-100">

                        <div class="d-flex" data-aos="fade-right">
                            <i class="fas fa-book-open text-danger fs-4 me-3"></i>
                            <p class="mb-0 text-muted">CBSE NEP experiential learning compliant school</p>
                        </div>

                        <div class="d-flex" data-aos="fade-right" data-aos-delay="100">
                            <i class="fas fa-school text-danger fs-4 me-3"></i>
                            <p class="mb-0 text-muted">World-Class Smart Campus with Advanced Infrastructure</p>
                        </div>

                        <div class="d-flex" data-aos="fade-right" data-aos-delay="200">
                            <i class="fas fa-laptop-code text-danger fs-4 me-3"></i>
                            <p class="mb-0 text-muted">Microsoft Showcase School with AI-Driven Learning</p>
                        </div>

                        <div class="d-flex" data-aos="fade-right" data-aos-delay="300">
                            <i class="fas fa-flask text-danger fs-4 me-3"></i>
                            <p class="mb-0 text-muted">Experiential, Research-Based & Flipped Learning Pedagogies</p>
                        </div>

                        <div class="d-flex" data-aos="fade-right" data-aos-delay="400">
                            <i class="fas fa-robot text-danger fs-4 me-3"></i>
                            <p class="mb-0 text-muted">Highly Awarded ATL, Robotics & STEAM Programs</p>
                        </div>

                        <div class="d-flex" data-aos="fade-right" data-aos-delay="500">
                            <i class="fas fa-user-tie text-danger fs-4 me-3"></i>
                            <p class="mb-0 text-muted">Strong Focus on Communication, Leadership & Personality Development</p>
                        </div>

                        <div class="d-flex" data-aos="fade-right" data-aos-delay="600">
                            <i class="fas fa-trophy text-danger fs-4 me-3"></i>
                            <p class="mb-0 text-muted">Outstanding Academic Excellence & Competitive Exam Preparation</p>
                        </div>

                    </div>
                </div>

                <!-- CENTER IMAGE -->
                <div class="col-12 col-lg-4 d-flex justify-content-center">
                    <img src="{{ asset('storage/assets/child.png') }}" alt="Student Learning"
                        class="img-fluid sets-apart-img" data-aos="zoom-in">
                </div>

                <!-- RIGHT SIDE -->
                <div class="col-12 col-lg-4 d-flex">
                    <div class="d-flex flex-column justify-content-between gap-3 h-100 w-100">

                        <div class="d-flex" data-aos="fade-left">
                            <i class="fas fa-rocket text-danger fs-4 me-3"></i>
                            <p class="mb-0 text-muted">International Exposure through tie-ups with Universities Abroad</p>
                        </div>

                        <div class="d-flex" data-aos="fade-left" data-aos-delay="100">
                            <i class="fas fa-swimming-pool text-danger fs-4 me-3"></i>
                            <p class="mb-0 text-muted">Elite Sport Facilities including outdoor and indoor arenas</p>
                        </div>

                        <div class="d-flex" data-aos="fade-left" data-aos-delay="200">
                            <i class="fas fa-palette text-danger fs-4 me-3"></i>
                            <p class="mb-0 text-muted">Holistic Development through Arts, Culture & Innovation</p>
                        </div>

                        <div class="d-flex" data-aos="fade-left" data-aos-delay="300">
                            <i class="fas fa-heart text-danger fs-4 me-3"></i>
                            <p class="mb-0 text-muted">Certified Wellness Support with Counsellors & Mentors</p>
                        </div>

                        <div class="d-flex" data-aos="fade-left" data-aos-delay="400">
                            <i class="fas fa-compass text-danger fs-4 me-3"></i>
                            <p class="mb-0 text-muted">Career Guidance & Study Abroad Support from Middle School onwards</p>
                        </div>

                        <div class="d-flex" data-aos="fade-left" data-aos-delay="500">
                            <i class="fas fa-shield-alt text-danger fs-4 me-3"></i>
                            <p class="mb-0 text-muted">Safe, Secure & Student-Centric Environment with 24×7 CCTV</p>
                        </div>

                        <div class="d-flex" data-aos="fade-left" data-aos-delay="600">
                            <i class="fas fa-award text-danger fs-4 me-3"></i>
                            <p class="mb-0 text-muted">Nationally Recognized with Multiple Awards & Rankings</p>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </section>



    <section class="py-5 position-relative text-dark section-activity-bg">
        <div class="container">
            <!-- TITLE -->
            <div class="text-center mb-5" data-aos="fade-down">
                <h2 class="fw-bold display-4 p-2 activity-heading">Real Learning in Action</h2>
                <p class="text-muted fs-5">A glimpse of engaging moments inside and outside the classroom at
                    <strong>DCMP</strong>
                </p>
            </div>

            <!-- IMAGE GRID -->
            <div class="row g-4">
                @foreach (range(1, 6) as $i)
                    <div class="col-sm-6 col-md-4" data-aos="zoom-in" data-aos-delay="{{ 100 * $i }}">
                        <div class="position-relative overflow-hidden rounded-4 shadow-sm activity-img-wrap">
                            @php
                                $imagePath = 'storage/assets/image' . $i . '.jpeg';
                            @endphp

                            @if (file_exists(public_path($imagePath)))
                                <img src="{{ asset($imagePath) }}" class="w-100 h-100 reel-cover"
                                    alt="Activity Photo {{ $i }}">
                            @else
                                <div
                                    class="w-100 h-100 d-flex align-items-center justify-content-center text-muted bg-light">
                                    <small>Image {{ $i }} not found</small>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- VIEW GALLERY -->
            <div class="text-center mt-5" data-aos="fade-up">
                <a href="{{ route('gallery-activities.get') }}"
                    class="btn btn-outline-primary px-4 py-2 rounded-pill shadow-sm">View Full Gallery</a>
            </div>
        </div>
    </section>


    {{-- Facilities Section --}}
    <section class="fac-section py-5" data-aos="fade-up">
        <div class="container">

            {{-- Section header --}}
            <div class="text-center mb-5">
                <span class="hlt-eyebrow" data-aos="fade-down">World-Class Infrastructure</span>
                <h2 class="cool-heading mt-2" data-aos="zoom-in">Facilities @ DCMP</h2>
                <p class="fac-section-desc text-muted mt-3 mx-auto" data-aos="fade-up" data-aos-delay="100">
                    A masterpiece of modern design — centrally air-conditioned, Wi-Fi enabled and fully digitally
                    equipped with cutting-edge science, innovation labs and elite sports facilities.
                </p>
            </div>

            {{-- Facility tiles --}}
            @php
                $facilities = [
                    ['src' => 'AI AND IT LAB ICON.png',               'alt' => 'AI Innovation Hub'],
                    ['src' => 'alt and robotic icon.png',            'alt' => 'ATL & Robotics Labs'],
                    ['src' => 'adv lab icon.png',                    'alt' => 'Advance Laboratories'],
                    ['src' => 'smart classes.png',                   'alt' => 'Smart Classrooms'],
                    ['src' => 'hi tech math lab icon.png',           'alt' => 'Smart Digital Board'],
                    ['src' => 'Hi Tech Campus Icon.png',             'alt' => 'Hi-Tech Campus'],
                    ['src' => 'lrc icon.png',                        'alt' => 'Habitat Centre'],
                    ['src' => 'Indoor and Outdoor Sports Icon.png',  'alt' => 'Swimming Pool'],
                    ['src' => 'Indoor and Outdoor Sports Icon.png',  'alt' => 'Milkha Singh Stadium'],
                    ['src' => 'Indoor and Outdoor Sports Icon.png',  'alt' => 'Astroturf Courts'],
                    ['src' => 'Indoor and Outdoor Sports Icon.png',  'alt' => 'Indoor Sports Arena'],
                    ['src' => 'ncc icon.png',                        'alt' => 'Rifle Shooting Range'],
                    ['src' => 'auditorium icon.png',                 'alt' => 'Open Air Theatre'],
                    ['src' => 'care centre icon.png',                'alt' => 'Wellness & Counselling'],
                    ['src' => '24x7 cctv icon.png',                  'alt' => '24×7 CCTV Security'],
                ];
            @endphp
            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-4 justify-content-center">
                @foreach ($facilities as $index => $facility)
                    <div class="col" data-aos="zoom-in" data-aos-delay="{{ 60 + $index * 50 }}">
                        <div class="fac-tile">
                            <div class="fac-tile-img-wrap">
                                <img loading="lazy"
                                    src="{{ asset('storage/assets/facilities-images/' . rawurlencode($facility['src'])) }}"
                                    alt="{{ $facility['alt'] }}"
                                    onerror="this.style.display='none'">
                            </div>
                            <p class="fac-tile-label mb-0 fw-500" style="font-size: 0.85rem; color: #333;">{{ $facility['alt'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    {{-- Blog Section --}}
    <div class="blog-section-wrap py-5">
        <div class="container">

            {{-- Section header --}}
            <div class="blog-section-header" data-aos="fade-up">
                <div>
                    <span class="blog-section-label">Stay Informed</span>
                    <h2 class="blog-section-title">Latest from Our Blog</h2>
                </div>
                <a href="{{ route('blogs.get') }}" class="blog-view-all">View All <i class="fas fa-arrow-right ms-1"></i></a>
            </div>

            {{-- Cards --}}
            <div class="row g-4 mt-1">
                @foreach ($blogs as $blog)
                    <div class="col-lg-3 col-md-6 col-12" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                        <a href="{{ route('blog.detail.get', ['slug' => $blog->slug]) }}" class="blog-card-link">
                            <div class="blog-card-v2">
                                {{-- Image with overlay --}}
                                <div class="blog-card-v2-img-wrap">
                                    <img src="{{ Storage::url($blog->blog_image_path) }}" loading="lazy"
                                        class="blog-card-v2-img" alt="{{ $blog->title }}">
                                    <div class="blog-card-v2-img-overlay"></div>
                                </div>
                                {{-- Body --}}
                                <div class="blog-card-v2-body">
                                    <div class="blog-card-v2-date">
                                        <i class="far fa-calendar-alt me-1"></i>{{ $blog->created_at->format('M j, Y') }}
                                    </div>
                                    <h5 class="blog-card-v2-title">{{ Str::limit($blog->title, 65) }}</h5>
                                    <span class="blog-card-v2-cta">Read More <i class="fas fa-arrow-right"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

        </div>
    </div>


    {{-- ── Opinions That Matter Section ──────────────────────────── --}}
    @if ($homeTestimonials->isNotEmpty())
    <section class="hp-opinions-section py-5">
        <div class="container">

            {{-- Header --}}
            <div class="hp-opinions-header" data-aos="fade-up">
                <div>
                    <span class="hp-opinions-label">Community Voices</span>
                    <h2 class="hp-opinions-title">Opinion That Matters</h2>
                </div>
                <a href="{{ route('testimonials.get') }}" class="hp-opinions-view-all">
                    View All &rarr;
                </a>
            </div>

            {{-- Card grid --}}
            <div class="hp-opinions-grid">
                @foreach ($homeTestimonials as $t)
                    @php
                        $gradients = [
                            'linear-gradient(135deg,#667eea,#764ba2)',
                            'linear-gradient(135deg,#f093fb,#f5576c)',
                            'linear-gradient(135deg,#4facfe,#00c6fb)',
                            'linear-gradient(135deg,#43e97b,#38f9d7)',
                            'linear-gradient(135deg,#fa709a,#ee7752)',
                            'linear-gradient(135deg,#a18cd1,#fbc2eb)',
                            'linear-gradient(135deg,#fccb90,#d57eeb)',
                            'linear-gradient(135deg,#e0c3fc,#8ec5fc)',
                        ];
                        $bg = $gradients[abs(crc32($t->name)) % count($gradients)];
                        $limit = 160;
                        $full  = $t->content;
                        $short = mb_strlen($full) > $limit;
                    @endphp
                    <div class="hp-opinion-card" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 80 }}">

                        {{-- Stars --}}
                        <div class="hp-star-row">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $t->rating ? '' : 'hp-star-empty' }}"></i>
                            @endfor
                        </div>

                        {{-- Quote --}}
                        <p class="hp-opinion-content">&ldquo;{{ $short ? mb_substr($full, 0, $limit) . '…' : $full }}&rdquo;</p>

                        @if ($short)
                            <button class="hp-view-full-btn"
                                data-full="{{ e($full) }}"
                                data-name="{{ e($t->name) }}"
                                data-designation="{{ e($t->designation) }}"
                                data-date="{{ $t->testimonial_date ? \Carbon\Carbon::parse($t->testimonial_date)->format('d M Y') : '' }}"
                                data-rating="{{ $t->rating }}"
                                data-photo="{{ $t->photo_path ? Storage::url($t->photo_path) : '' }}"
                                data-gradient="{{ $bg }}"
                                data-initial="{{ strtoupper(substr($t->name, 0, 1)) }}"
                                onclick="openHpReadMore(this)">
                                <i class="fas fa-quote-right" style="font-size:.7rem;"></i> Full Opinion
                            </button>
                        @endif

                        {{-- Author --}}
                        <div class="hp-opinion-author">
                            @if ($t->photo_path)
                                <img src="{{ Storage::url($t->photo_path) }}"
                                     alt="{{ $t->name }}"
                                     class="hp-opinion-avatar"
                                     loading="lazy">
                            @else
                                <div class="hp-opinion-avatar-placeholder" style="background:{{ $bg }}">
                                    {{ strtoupper(substr($t->name, 0, 1)) }}
                                </div>
                            @endif
                            <div>
                                <div class="hp-opinion-name">{{ $t->name }}</div>
                                @if ($t->designation)
                                    <div class="hp-opinion-designation">{{ $t->designation }}</div>
                                @endif
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    </section>

    {{-- Read-More Modal for homepage opinions --}}
    <div class="modal fade" id="hpReadMoreModal" tabindex="-1" aria-labelledby="hpReadMoreModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg" style="border-radius:16px;overflow:hidden;">
                <div class="modal-header border-0" style="background:var(--color-primary,#052A56);padding:16px 20px;">
                    <div id="hp-rm-stars" style="display:flex;gap:4px;align-items:center;"></div>
                    <button type="button" class="btn-close btn-close-white" style="margin-left:auto;" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding:28px 28px 16px;">
                    <p id="hp-rm-content" style="font-style:italic;color:#333;font-size:1.02rem;line-height:1.85;margin:0;"></p>
                </div>
                <div class="modal-footer border-0" style="padding:12px 24px 20px;justify-content:flex-start;gap:14px;">
                    <div id="hp-rm-avatar" style="flex-shrink:0;"></div>
                    <div>
                        <div id="hp-rm-name" style="font-weight:700;font-size:.95rem;color:#1a1a1a;"></div>
                        <div id="hp-rm-designation" style="font-size:.82rem;color:#888;margin-top:2px;"></div>
                        <div id="hp-rm-date" style="font-size:.75rem;color:#aaa;margin-top:3px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ── Learning Partners Section ──────────────────────────── --}}
    @if ($learningPartners->isNotEmpty())
    <section class="learning-partners-section py-5 bg-light">
        <div class="container">

            {{-- Header --}}
            <div class="learning-partners-header" data-aos="fade-up" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
                <div>
                    <span class="section-label" style="color: #0C54A0; font-weight: 600; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px;">Our Collaborators</span>
                    <h2 class="section-title" style="font-size: 2.5rem; font-weight: 700; color: #1a1a1a; margin-top: 0.5rem;">Learning Partners</h2>
                </div>
                <a href="{{ route('learning-partners.get') }}" class="btn" style="white-space: nowrap; background: var(--color-primary, #052A56); color: white; border: none; padding: 0.5rem 1.5rem; border-radius: 6px; font-weight: 600; transition: all 0.3s ease;">
                    View All &rarr;
                </a>
            </div>

            {{-- Partners Grid --}}
            <div class="learning-partners-grid">
                <div class="row g-4">
                    @foreach ($learningPartners as $partner)
                        <div class="col-md-6 col-lg-4">
                            <div class="partner-card h-100" style="border-radius: 12px; overflow: hidden; background: white; box-shadow: 0 2px 8px rgba(0,0,0,0.08); transition: all 0.3s ease;">
                                <div class="partner-logo-wrapper bg-light d-flex align-items-center justify-content-center" style="height: 200px; padding: 1.5rem; background: #f8f9fa;">
                                    @if($partner->logo_path)
                                        @if($partner->website_url)
                                            <a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer"
                                               class="text-decoration-none" style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%;">
                                                <img src="{{ Storage::url($partner->logo_path) }}"
                                                     alt="{{ $partner->name }}"
                                                     class="img-fluid"
                                                     style="max-height: 160px; max-width: 100%; object-fit: contain;">
                                            </a>
                                        @else
                                            <img src="{{ Storage::url($partner->logo_path) }}"
                                                 alt="{{ $partner->name }}"
                                                 class="img-fluid"
                                                 style="max-height: 160px; max-width: 100%; object-fit: contain;">
                                        @endif
                                    @else
                                        <span class="text-muted" style="font-weight: 500;">{{ $partner->name }}</span>
                                    @endif
                                </div>

                                <div class="partner-info" style="padding: 1.5rem;">
                                    <h5 class="partner-name" style="font-size: 1.1rem; font-weight: 600; color: #1a1a1a; margin-bottom: 0.75rem;">{{ $partner->name }}</h5>
                                    @if($partner->description)
                                        <p class="partner-description text-muted" style="font-size: 0.9rem; line-height: 1.5; margin-bottom: 1rem;">
                                            {{ Str::limit($partner->description, 100) }}
                                        </p>
                                    @endif

                                    @if($partner->website_url)
                                        <a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer"
                                           class="btn btn-sm btn-outline-primary" style="border-radius: 6px;">
                                            Learn More <i class="fas fa-external-link-alt ms-2" style="font-size: 0.75rem;"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>
    @endif

    <x-brochure-modal />

    <x-thank-you-modal id="brochureThankYouModal" title="🎉 Thank You!" message="Your brochure request is received!"
        download="#" filename="" />

@endsection

@section('styles')
<style>
    /* ── Homepage: Opinions That Matter ────────────────────────── */
    .hp-opinions-section { background: #fff; }

    .hp-opinions-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 40px;
    }
    .hp-opinions-label {
        display: inline-block;
        font-size: .75rem;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: var(--color-primary, #052A56);
    }
    .hp-opinions-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(1.5rem, 3vw, 2.1rem);
        font-weight: 800;
        color: #1a1a1a;
        margin: 0;
        position: relative;
        padding-bottom: 12px;
    }
    .hp-opinions-title::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0;
        width: 48px; height: 3px;
        background: var(--color-primary, #052A56);
    }
    .hp-opinions-view-all {
        font-size: .85rem;
        font-weight: 600;
        color: var(--color-primary, #052A56);
        text-decoration: none;
        border: 1.5px solid var(--color-primary, #052A56);
        border-radius: 50px;
        padding: 6px 18px;
        transition: background .2s, color .2s;
        white-space: nowrap;
    }
    .hp-opinions-view-all:hover {
        background: var(--color-primary, #052A56);
        color: #fff;
    }

    .hp-opinions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
        gap: 26px;
    }

    .hp-opinion-card {
        background: #fafafa;
        border-radius: 16px;
        padding: 26px 22px 20px;
        box-shadow: 0 4px 18px rgba(0,0,0,.06);
        display: flex;
        flex-direction: column;
        gap: 14px;
        transition: transform .25s, box-shadow .25s;
        position: relative;
        border: 1px solid #f0f0f0;
    }
    .hp-opinion-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(5,42,86,.1);
    }
    .hp-opinion-card::before {
        content: '\201C';
        position: absolute;
        top: 12px; right: 18px;
        font-size: 5rem;
        line-height: 1;
        color: var(--color-primary, #052A56);
        opacity: .07;
        font-family: Georgia, serif;
        pointer-events: none;
    }

    .hp-star-row { display: flex; gap: 3px; }
    .hp-star-row i { font-size: .78rem; color: #f0a500; }
    .hp-star-row i.hp-star-empty { color: #ddd; }

    .hp-opinion-content {
        font-size: .93rem;
        color: #444;
        line-height: 1.75;
        flex: 1;
        font-style: italic;
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin: 0;
    }

    .hp-view-full-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 14px;
        border: 1.5px solid var(--color-primary, #052A56);
        border-radius: 50px;
        background: transparent;
        color: var(--color-primary, #052A56);
        font-size: .78rem;
        font-weight: 600;
        letter-spacing: .02em;
        cursor: pointer;
        transition: background .2s, color .2s;
    }
    .hp-view-full-btn:hover {
        background: var(--color-primary, #052A56);
        color: #fff;
    }

    .hp-opinion-author { display: flex; align-items: center; gap: 10px; }
    .hp-opinion-avatar {
        width: 46px; height: 46px;
        border-radius: 50%;
        object-fit: cover;
        flex-shrink: 0;
        border: 3px solid #f3e9e9;
    }
    .hp-opinion-avatar-placeholder {
        width: 46px; height: 46px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        font-family: 'Playfair Display', serif;
        font-size: 1.2rem;
        font-weight: 700;
        color: #fff;
        text-shadow: 0 1px 3px rgba(0,0,0,.25);
        user-select: none;
    }
    .hp-opinion-name { font-weight: 700; font-size: .9rem; color: #1a1a1a; }
    .hp-opinion-designation { font-size: .78rem; color: #888; }

    /* Read-more modal avatar */
    #hp-rm-avatar img,
    #hp-rm-avatar div {
        width: 52px; height: 52px;
        border-radius: 50%;
        object-fit: cover;
        flex-shrink: 0;
    }

    /* Learning Partners View All Button */
    .learning-partners-header a {
        transition: all 0.3s ease;
    }

    .learning-partners-header a:hover {
        background: var(--color-primary, #052A56) !important;
        color: white !important;
        box-shadow: 0 4px 12px rgba(5, 42, 86, 0.3);
        transform: translateY(-2px);
    }
</style>
@endsection

@section('scripts')
<script>
    function openHpReadMore(btn) {
        var full        = btn.dataset.full;
        var name        = btn.dataset.name;
        var designation = btn.dataset.designation || '';
        var date        = btn.dataset.date || '';
        var rating      = parseInt(btn.dataset.rating) || 0;
        var photo       = btn.dataset.photo || '';
        var gradient    = btn.dataset.gradient || '#052A56';
        var initial     = btn.dataset.initial || '?';

        // Stars
        var starsHtml = '';
        for (var i = 1; i <= 5; i++) {
            starsHtml += i <= rating
                ? '<i class="fas fa-star" style="color:#f0a500;font-size:.82rem;"></i>'
                : '<i class="fas fa-star" style="color:rgba(255,255,255,.4);font-size:.82rem;"></i>';
        }
        document.getElementById('hp-rm-stars').innerHTML = starsHtml;

        // Content (use innerHTML so quotes render correctly)
        document.getElementById('hp-rm-content').innerHTML =
            '\u201C' + full.replace(/</g,'&lt;').replace(/>/g,'&gt;') + '\u201D';

        // Avatar
        var avatarEl = document.getElementById('hp-rm-avatar');
        if (photo) {
            avatarEl.innerHTML = '<img src="' + photo + '" alt="" style="width:52px;height:52px;border-radius:50%;object-fit:cover;border:3px solid #f3e9e9;">';
        } else {
            avatarEl.innerHTML = '<div style="width:52px;height:52px;border-radius:50%;background:' + gradient + ';display:flex;align-items:center;justify-content:center;font-family:serif;font-size:1.3rem;font-weight:700;color:#fff;flex-shrink:0;">' + initial + '</div>';
        }

        document.getElementById('hp-rm-name').textContent       = name;
        document.getElementById('hp-rm-designation').textContent = designation;
        document.getElementById('hp-rm-date').innerHTML =
            date ? '<i class="far fa-calendar-alt" style="margin-right:4px;"></i>' + date : '';

        // Reuse existing instance to avoid backdrop stacking (Bootstrap 5.0.x)
        var el = document.getElementById('hpReadMoreModal');
        var existing = bootstrap.Modal.getInstance(el);
        if (existing) {
            existing.dispose();
        }
        new bootstrap.Modal(el).show();
    }
</script>
@endsection
