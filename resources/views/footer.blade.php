{{-- ─── Wave divider ───────────────────────────────────────────────── --}}
<div class="footer-wave" aria-hidden="true">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 56" preserveAspectRatio="none">
        <path d="M0,28 C240,56 480,0 720,28 C960,56 1200,0 1440,28 L1440,56 L0,56 Z"/>
    </svg>
</div>

<footer class="site-footer pb-0">

    {{-- ─── CTA strip ──────────────────────────────────────────────────── --}}
    <div class="footer-cta-strip">
        <div class="container">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
                <div>
                    <h5 class="footer-cta-title mb-1">Ready to Join {{ config('site.name') }}?</h5>
                    <p class="footer-cta-subtitle mb-0">Book a campus visit and experience the DCMP difference.</p>
                </div>
                <div class="d-flex gap-2 flex-wrap justify-content-center">
                    <a href="{{ config('site.admissions_url') }}" target="_blank" rel="noopener noreferrer"
                       class="btn footer-cta-btn-primary">
                        <i class="fas fa-pen-to-square me-2"></i>Apply Now
                    </a>
                    <a href="{{ route('contact') }}" class="btn footer-cta-btn-outline">
                        <i class="fas fa-phone-alt me-2"></i>Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- ─── Main footer body ───────────────────────────────────────────── --}}
    <div class="container py-5">
        <div class="row g-4">

            {{-- Column 1: Brand + Contact --}}
            <div class="col-12 col-md-6 col-lg-3">
                <div class="footer-logo-wrap">
                    <img src="{{ asset(config('site.logo_icon')) }}" alt="{{ config('site.name') }} Logo"
                         width="160" height="60" loading="lazy">
                </div>
                <p class="footer-tagline">{{ config('site.tagline') }}</p>

                <div class="footer-contact-item">
                    <div class="icon-wrap"><i class="fas fa-map-marker-alt"></i></div>
                    <span>{{ config('site.address.full') }}</span>
                </div>

                <div class="footer-contact-item">
                    <div class="icon-wrap"><i class="fas fa-phone-alt"></i></div>
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', config('site.phone')) }}"
                       class="footer-contact-link">{{ config('site.phone') }}</a>
                </div>

                <div class="footer-contact-item">
                    <div class="icon-wrap"><i class="fas fa-envelope"></i></div>
                    <div>
                        <div><a href="mailto:{{ config('site.email_admissions') }}" class="footer-contact-link">{{ config('site.email_admissions') }}</a></div>
                        <div><a href="mailto:{{ config('site.email_info') }}" class="footer-contact-link">{{ config('site.email_info') }}</a></div>
                    </div>
                </div>

                @if(config('site.whatsapp'))
                <a href="https://wa.me/91{{ config('site.whatsapp') }}"
                   target="_blank" rel="noopener noreferrer" class="footer-whatsapp-btn">
                    <i class="fab fa-whatsapp me-2"></i>Chat on WhatsApp
                </a>
                @endif

                <div class="footer-social-icons">
                    @if(config('site.social.facebook'))
                    <a href="{{ config('site.social.facebook') }}" target="_blank" rel="noopener noreferrer"
                       class="footer-social-icon" title="Facebook" aria-label="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    @endif
                    @if(config('site.social.instagram'))
                    <a href="{{ config('site.social.instagram') }}" target="_blank" rel="noopener noreferrer"
                       class="footer-social-icon" title="Instagram" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    @endif
                    @if(config('site.social.linkedin'))
                    <a href="{{ config('site.social.linkedin') }}" target="_blank" rel="noopener noreferrer"
                       class="footer-social-icon" title="LinkedIn" aria-label="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    @endif
                    @if(config('site.social.twitter'))
                    <a href="{{ config('site.social.twitter') }}" target="_blank" rel="noopener noreferrer"
                       class="footer-social-icon" title="X / Twitter" aria-label="X / Twitter">
                        <i class="fab fa-x-twitter"></i>
                    </a>
                    @endif
                    @if(config('site.social.youtube'))
                    <a href="{{ config('site.social.youtube') }}" target="_blank" rel="noopener noreferrer"
                       class="footer-social-icon" title="YouTube" aria-label="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                    @endif
                </div>
            </div>

            {{-- Column 2: Quick Links --}}
            <div class="col-12 col-sm-6 col-lg-2">
                <h6 class="footer-heading">Quick Links</h6>
                <ul class="footer-links">
                    <li><a href="{{ route('home.get') }}"><i class="fas fa-chevron-right"></i>Home</a></li>
                    @php
                        $aboutMenu = \App\Models\MenuItem::where('name', 'About')->first();
                        if($aboutMenu) {
                            $aboutChildren = $aboutMenu->children()->orderBy('display_order')->where('status', 'active')->whereNotNull('url')->get();
                        }
                    @endphp
                    @if($aboutMenu)
                        @foreach($aboutChildren as $child)
                            <li><a href="{{ $child->href }}"><i class="fas fa-chevron-right"></i>{{ $child->name }}</a></li>
                        @endforeach
                    @endif
                    @php
                        $faqMenu = \App\Models\MenuItem::where('url', 'faq')->orWhere('name', 'FAQ')->orWhere('name', 'FAQs')->first();
                    @endphp
                    @if($faqMenu && $faqMenu->url)
                        <li><a href="{{ $faqMenu->href }}"><i class="fas fa-chevron-right"></i>{{ $faqMenu->name }}</a></li>
                    @else
                        <li><a href="{{ route('faq.get') }}"><i class="fas fa-chevron-right"></i>FAQs</a></li>
                    @endif
                    <li><a href="{{ route('blogs.get') }}"><i class="fas fa-chevron-right"></i>Blogs</a></li>
                    <li><a href="{{ route('job-form.get') }}"><i class="fas fa-chevron-right"></i>Careers</a></li>
                    <li><a href="{{ route('downloads-list.get') }}"><i class="fas fa-chevron-right"></i>Downloads</a></li>
                    <li><a href="{{ route('contact') }}"><i class="fas fa-chevron-right"></i>Contact Us</a></li>
                </ul>
            </div>

            {{-- Column 3: Admissions + Academics --}}
            <div class="col-12 col-sm-6 col-lg-2">
                <h6 class="footer-heading">Admissions</h6>
                <ul class="footer-links mb-4">
                    <li><a href="{{ config('site.admissions_url') }}" target="_blank" rel="noopener noreferrer"><i class="fas fa-chevron-right"></i>Admission Enquiry</a></li>
                    <li><a href="{{ route('resource-list') }}"><i class="fas fa-chevron-right"></i>Resource List</a></li>
                    <li><a href="{{ config('site.brochure_url') }}" target="_blank" rel="noopener noreferrer"><i class="fas fa-chevron-right"></i>Download Brochure</a></li>
                </ul>

                <h6 class="footer-heading">Academics</h6>
                <ul class="footer-links">
                    @php
                        $academicsMenu = \App\Models\MenuItem::where('name', 'Academics')->first();
                        if($academicsMenu) {
                            $academicsChildren = $academicsMenu->children()->orderBy('display_order')->where('status', 'active')->whereNotNull('url')->where('name', '!=', 'Resource List')->get();
                        }
                    @endphp
                    @if($academicsMenu)
                        @foreach($academicsChildren as $child)
                            <li><a href="{{ $child->href }}"><i class="fas fa-chevron-right"></i>{{ $child->name }}</a></li>
                        @endforeach
                    @endif
                </ul>
            </div>

            {{-- Column 4: Google Map --}}
            <div class="col-12 col-md-6 col-lg-5">
                <h6 class="footer-heading">Find Us</h6>
                <div class="footer-map-wrap">
                    <iframe
                        src="{{ config('site.maps_embed') }}"
                        width="100%" height="260" class="map-iframe"
                        style="border:0;"
                        allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-cross-origin"
                        title="{{ config('site.name') }} Location Map"></iframe>
                </div>
                <div class="footer-map-caption">
                    <span><i class="fas fa-map-marker-alt me-1"></i>{{ config('site.address.city') }}, {{ config('site.address.state') }}</span>
                    <a href="https://maps.google.com/?q={{ urlencode(config('site.address.full')) }}"
                       target="_blank" rel="noopener noreferrer" class="footer-map-directions">
                        <i class="fas fa-route me-1"></i>Get Directions
                    </a>
                </div>
            </div>

        </div>
    </div>

    <hr class="footer-divider">

    <div class="footer-bottom">
        <div class="container">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-2">
                <span>&copy; {{ date('Y') }} {{ config('site.full_name') }}. All rights reserved.</span>
                <div>
                    <a href="{{ route('sitemap') }}">Sitemap</a>
                    <span class="footer-bottom-divider">|</span>
                    <a href="{{ url('/mandatory-disclosure') }}">Mandatory Disclosure</a>
                    <span class="footer-bottom-divider">|</span>
                    <a href="{{ route('contact') }}">Contact</a>
                </div>
            </div>
        </div>
    </div>

</footer>

{{-- ─── Back to Top ─────────────────────────────────────────────────── --}}
<button id="backToTop" class="back-to-top" aria-label="Back to top" title="Back to top">
    <i class="fas fa-chevron-up"></i>
</button>

@push('scripts')
<script>
(function () {
    'use strict';
    var btn = document.getElementById('backToTop');
    if (!btn) return;
    window.addEventListener('scroll', function () {
        btn.classList.toggle('show', window.scrollY > 400);
    }, { passive: true });
    btn.addEventListener('click', function () {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
}());
</script>
@endpush
