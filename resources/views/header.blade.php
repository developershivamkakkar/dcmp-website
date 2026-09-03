{{-- Announcements Section --}}
<div class="container-fluid px-0">
    <div class="row g-0">
        <div class="col-lg-3 col-md-12 d-flex justify-content-center align-items-center text-center ann-bar-col">
            <div class="announcements"><i class="fas fa-bullhorn me-2"></i>ANNOUNCEMENTS:</div>
        </div>
        <div class="col-lg-7 col-md-12 d-flex align-items-center ann-bar-col">
            <div class="announcements-text w-100 px-3">
                <div id="announcements-slider" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($announcements as $key => $announcement)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                {{ $announcement->content }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div
            class="col-lg-2 d-none d-lg-flex align-items-center justify-content-center social-icons-header ann-bar-col">
            <div>
                @if (config('site.social.facebook'))
                    <a href="{{ config('site.social.facebook') }}" target="_blank" rel="noopener noreferrer"
                        class="mx-1"><i class="fab fa-facebook"></i></a>
                @endif
                @if (config('site.social.instagram'))
                    <a href="{{ config('site.social.instagram') }}" target="_blank" rel="noopener noreferrer"
                        class="mx-1"><i class="fab fa-instagram"></i></a>
                @endif
                @if (config('site.social.linkedin'))
                    <a href="{{ config('site.social.linkedin') }}" target="_blank" rel="noopener noreferrer"
                        class="mx-1"><i class="fab fa-linkedin"></i></a>
                @endif
                @if (config('site.social.twitter'))
                    <a href="{{ config('site.social.twitter') }}" target="_blank" rel="noopener noreferrer"
                        class="mx-1"><i class="fab fa-twitter"></i></a>
                @endif
                @if (config('site.social.youtube'))
                    <a href="{{ config('site.social.youtube') }}" target="_blank" rel="noopener noreferrer"
                        class="mx-1"><i class="fab fa-youtube"></i></a>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="container d-none d-lg-flex pt-3 pb-1 header-info-row">
    <div class="row w-100">
        <div class="col-lg-4">
            <a href="/"><img class="img-fluid p-1 h-20" src="{{ asset(config('site.logo')) }}"
                    alt="{{ config('site.name') }}" /></a>
        </div>
        <div class="col-lg-4 d-flex justify-content-center align-items-center flex-column">
            <i class="fa fa-address-book mb-1"></i>
            <span class="desktop-icons-below-text text-center">
                {{ config('site.address.line1') }}<br>
                {{ config('site.address.line2') }}</span>
        </div>
        <div class="col-lg-2 d-flex justify-content-center align-items-center flex-column">
            <i class="fa fa-envelope mb-1"></i>
            <a href="mailto:{{ config('site.email_info') }}"
                class="desktop-icons-below-text text-center text-decoration-none text-reset">{{ config('site.email_info') }}</a>
        </div>
        <div class="col-lg-2 d-flex justify-content-center align-items-center flex-column">
            <i class="fa fa-phone mb-1"></i>
            <a href="tel:{{ preg_replace('/[^0-9+]/', '', config('site.phone')) }}"
                class="desktop-icons-below-text white-space-nowrap text-decoration-none text-reset">{{ config('site.phone') }}</a>
        </div>
    </div>
</div>
<!-- Desktop Upper Nav Strip -->
<nav class="navbar desktop-upper-nav-strip d-none d-lg-block">
    <div class="container-fluid">
        <ul class="navbar-nav d-flex flex-row px-5 gap-3 ms-auto align-items-center">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('downloads-list.get') }}">Downloads</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('blogs.get') }}">Blogs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('job-form.get') }}">Careers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('events.get') }}">Events</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('show.page', ['slug' => 'faq']) }}">FAQs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('testimonials.get') }}">Opinion That Matters</a>
            </li>
            <li class="nav-item ms-2">
                <a class="nav-link header-apply-btn" href="{{ route('admissions.landing.get') }}">Apply Now</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Desktop Lower Nav Strip -->
<nav class="navbar desktop-lower-nav-strip d-none d-lg-block sticky-top">
    <div class="container-fluid">
        <ul class="navbar-nav d-flex flex-row  mx-auto align-items-center">
            @foreach ($navMenuItems as $item)
                @if ($item->children->isEmpty())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ $item->href }}">{{ $item->name }}</a>
                    </li>
                @else
                    <li class="nav-item dropdown desktop-dropdown">
                        <a class="nav-link dropdown-toggle" id="nav-{{ $item->id }}" role="button"
                            aria-expanded="false">
                            {{ $item->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="nav-{{ $item->id }}">
                            @foreach ($item->children as $child)
                                @if ($child->children->isNotEmpty())
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-submenu-toggle" href="#">
                                            {{ $child->name }} <i class="fas fa-chevron-right"></i>
                                        </a>
                                        <ul class="dropdown-submenu-menu">
                                            @foreach ($child->children as $grandchild)
                                                <li><a class="dropdown-item"
                                                        href="{{ $grandchild->href }}">{{ $grandchild->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li><a class="dropdown-item" href="{{ $child->href }}">{{ $child->name }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @endif
            @endforeach



            {{-- Gallery Dropdown --}}
            <li class="nav-item dropdown desktop-dropdown">
                <a class="nav-link dropdown-toggle" role="button" aria-expanded="false">
                    Gallery
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="{{ route('gallery-infrastructure.get') }}">
                            <i class="fas fa-building me-2"></i>Infrastructure
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('gallery-school-events.get') }}">
                            <i class="fas fa-calendar-alt me-2"></i>Events &amp; Activities
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('gallery-annual-functions.get') }}">
                            <i class="fas fa-star me-2"></i>Annual Functions
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('gallery-news-clippings.get') }}">
                            <i class="fas fa-newspaper me-2"></i>News Clippings
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('contact') }}">Contact</a>
            </li>
        </ul>
    </div>
</nav>

{{-- ══ MOBILE HEADER — d-lg-none ══════════════════════════════════════ --}}

{{-- Checkbox, overlay & sidebar live OUTSIDE the sticky header so that
     the sticky header's transform does not create a stacking context
     that traps these fixed-position elements. --}}
<input type="checkbox" id="mob-menu-toggle" class="mob-menu-input d-lg-none">
<label for="mob-menu-toggle" class="mob-overlay d-lg-none" aria-hidden="true"></label>

{{-- Sidebar --}}
<nav class="mob-sidebar d-lg-none" aria-label="Mobile navigation">

    {{-- Branded header (always visible) --}}
    <div class="mob-sidebar-head">
        <img src="{{ asset(config('site.logo')) }}" alt="{{ config('site.name') }}" class="mob-sidebar-logo">
        <div class="mob-sidebar-info">
            <span class="mob-sidebar-name">{{ config('site.name') }}</span>
            <span class="mob-sidebar-sub">{{ config('site.address.city') }}</span>
        </div>
        <label for="mob-menu-toggle" class="mob-sidebar-close" aria-label="Close menu">
            <i class="fas fa-times"></i>
        </label>
    </div>

    {{-- Quick contact strip (always visible) --}}
    <div class="mob-sidebar-contact-strip">
        <a href="tel:{{ preg_replace('/[^0-9+]/', '', config('site.phone')) }}"><i class="fas fa-phone-alt"></i>
            {{ config('site.phone') }}</a>
        <a href="mailto:{{ config('site.email_info') }}"><i class="fas fa-envelope"></i> Email Us</a>
    </div>

    {{-- ── JS-driven push-navigation panels ──────────────────────── --}}
    <div class="mob-nav-panels-container">

        {{-- ── MAIN PANEL ──────────────────────────────────────────── --}}
        <div class="mob-nav-panel" data-panel="mob-main" data-active>
            <div class="mob-nav-scroll">
                <ul class="mob-nav-list">
                    @foreach ($navMenuItems as $item)
                        <li class="mob-nav-item">
                            @if ($item->children->isNotEmpty())
                                <button class="mob-nav-link" data-push="mob-sp-{{ $item->id }}">
                                    <span>{{ $item->name }}</span>
                                    <i class="fas fa-chevron-right mob-sub-chevron"></i>
                                </button>
                            @else
                                <a href="{{ $item->href }}" class="mob-nav-link">
                                    <span>{{ $item->name }}</span>
                                </a>
                            @endif
                        </li>
                    @endforeach
                    {{-- Gallery → own panel --}}
                    <li class="mob-nav-item">
                        <button class="mob-nav-link" data-push="mob-sp-gallery">
                            <span><i class="fas fa-images mob-nav-icon"></i>Gallery</span>
                            <i class="fas fa-chevron-right mob-sub-chevron"></i>
                        </button>
                    </li>
                    {{-- Quick Links → own panel --}}
                    <li class="mob-nav-item">
                        <button class="mob-nav-link" data-push="mob-sp-quicklinks">
                            <span><i class="fas fa-link mob-nav-icon"></i>Quick Links</span>
                            <i class="fas fa-chevron-right mob-sub-chevron"></i>
                        </button>
                    </li>
                </ul>

                {{-- CTA --}}
                <div class="mob-sidebar-cta">
                    <a href="{{ route('admissions.landing.get') }}" class="mob-cta-apply">Apply Now</a>
                    <a href="{{ config('site.brochure_url') }}" class="mob-cta-brochure"
                        target="_blank">Brochure</a>
                </div>

                {{-- Social --}}
                <div class="mob-sidebar-social">
                    <span class="mob-social-label">Follow Us</span>
                    <div class="mob-social-icons">
                        @if (config('site.social.facebook'))
                            <a href="{{ config('site.social.facebook') }}" target="_blank" aria-label="Facebook"><i
                                    class="fab fa-facebook-f"></i></a>
                        @endif
                        @if (config('site.social.instagram'))
                            <a href="{{ config('site.social.instagram') }}" target="_blank"
                                aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        @endif
                        @if (config('site.social.youtube'))
                            <a href="{{ config('site.social.youtube') }}" target="_blank" aria-label="YouTube"><i
                                    class="fab fa-youtube"></i></a>
                        @endif
                        @if (config('site.social.twitter'))
                            <a href="{{ config('site.social.twitter') }}" target="_blank" aria-label="Twitter/X"><i
                                    class="fab fa-twitter"></i></a>
                        @endif
                        @if (config('site.social.linkedin'))
                            <a href="{{ config('site.social.linkedin') }}" target="_blank" aria-label="LinkedIn"><i
                                    class="fab fa-linkedin-in"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>{{-- /mob-main --}}

        {{-- ── LEVEL-1 PANELS (nav items with children) ───────────── --}}
        @foreach ($navMenuItems as $item)
            @if ($item->children->isNotEmpty())
                <div class="mob-nav-panel" data-panel="mob-sp-{{ $item->id }}">
                    <div class="mob-subpanel-head">
                        <button class="mob-back-btn" data-pop><i class="fas fa-chevron-left"></i> Back</button>
                        <span class="mob-subpanel-title">{{ $item->name }}</span>
                    </div>
                    <div class="mob-nav-scroll">
                        <ul class="mob-subnav-list">
                            @foreach ($item->children as $child)
                                <li>
                                    @if ($child->children->isNotEmpty())
                                        <button class="mob-subnav-link" data-push="mob-sp-{{ $child->id }}">
                                            <span>{{ $child->name }}</span>
                                            <i class="fas fa-chevron-right mob-sub-chevron"></i>
                                        </button>
                                    @else
                                        <a href="{{ $child->href }}">{{ $child->name }}</a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                {{-- ── LEVEL-2 PANELS (grandchildren) ─────────────── --}}
                @foreach ($item->children as $child)
                    @if ($child->children->isNotEmpty())
                        <div class="mob-nav-panel" data-panel="mob-sp-{{ $child->id }}">
                            <div class="mob-subpanel-head">
                                <button class="mob-back-btn" data-pop><i class="fas fa-chevron-left"></i>
                                    Back</button>
                                <span class="mob-subpanel-title">{{ $child->name }}</span>
                            </div>
                            <div class="mob-nav-scroll">
                                <ul class="mob-subnav-list">
                                    @foreach ($child->children as $grandchild)
                                        <li><a href="{{ $grandchild->href }}">{{ $grandchild->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- ── GALLERY PANEL ───────────────────────────────────────── --}}
        <div class="mob-nav-panel" data-panel="mob-sp-gallery">
            <div class="mob-subpanel-head">
                <button class="mob-back-btn" data-pop><i class="fas fa-chevron-left"></i> Back</button>
                <span class="mob-subpanel-title"><i class="fas fa-images"
                        style="margin-right:8px;"></i>Gallery</span>
            </div>
            <div class="mob-nav-scroll">
                <ul class="mob-subnav-list">
                    <li><a href="{{ route('gallery-infrastructure.get') }}"><i
                                class="fas fa-building me-2"></i>Infrastructure</a></li>
                    <li><a href="{{ route('gallery-school-events.get') }}"><i
                                class="fas fa-calendar-alt me-2"></i>Events &amp; Activities</a></li>
                    <li><a href="{{ route('gallery-annual-functions.get') }}"><i class="fas fa-star me-2"></i>Annual
                            Functions</a></li>
                    <li><a href="{{ route('gallery-news-clippings.get') }}"><i class="fas fa-newspaper me-2"></i>News
                            Clippings</a></li>
                </ul>
            </div>
        </div>

        {{-- ── QUICK LINKS PANEL ────────────────────────────────────── --}}
        <div class="mob-nav-panel" data-panel="mob-sp-quicklinks">
            <div class="mob-subpanel-head">
                <button class="mob-back-btn" data-pop><i class="fas fa-chevron-left"></i> Back</button>
                <span class="mob-subpanel-title"><i class="fas fa-link" style="margin-right:8px;"></i>Quick
                    Links</span>
            </div>
            <div class="mob-nav-scroll">
                <ul class="mob-subnav-list">
                    <li><a href="{{ route('blogs.get') }}"><i class="fas fa-pen-nib me-2"></i>Blogs</a></li>
                    <li><a href="{{ route('events.get') }}"><i class="fas fa-calendar-alt me-2"></i>Events</a></li>
                    <li><a href="{{ route('downloads-list.get') }}"><i class="fas fa-download me-2"></i>Downloads</a>
                    </li>
                    <li><a href="{{ route('faq.get') }}"><i class="fas fa-question-circle me-2"></i>FAQs</a></li>
                    <li><a href="{{ route('testimonials.get') }}"><i class="fas fa-comment-dots me-2"></i>Opinion
                            That Matters</a></li>
                    <li><a href="{{ route('job-form.get') }}"><i class="fas fa-briefcase me-2"></i>Careers</a></li>
                </ul>
            </div>
        </div>

    </div>{{-- /mob-nav-panels-container --}}

</nav>

<div class="d-lg-none mobile-sticky-header">

    {{-- Top bar --}}
    <div class="mob-topbar">
        <a href="{{ route('home.get') }}" class="mob-logo-link">
            <img src="{{ asset(config('site.logo')) }}" alt="{{ config('site.name') }}" class="mob-logo-img">
        </a>
        <label for="mob-menu-toggle" class="mob-hamburger" aria-label="Open navigation">
            <span></span><span></span><span></span>
        </label>
    </div>

</div>
{{-- ══ END MOBILE HEADER ════════════════════════════════════════════ --}}
{{-- ══ END MOBILE HEADER ════════════════════════════════════════════ --}}

{{-- ── Mobile push-nav JS (no dependencies) ───────────────────────── --}}
<script>
    (function() {
        var container = document.querySelector('.mob-nav-panels-container');
        if (!container) return;

        var stack = ['mob-main'];

        function getPanel(id) {
            return container.querySelector('[data-panel="' + id + '"]');
        }

        function activate(entering, leaving, direction) {
            container.querySelectorAll('.mob-nav-panel').forEach(function(p) {
                p.removeAttribute('data-active');
                p.removeAttribute('data-prev');
            });
            if (leaving && direction === 'forward') {
                leaving.setAttribute('data-prev', '');
            }
            if (entering) entering.setAttribute('data-active', '');
        }

        container.addEventListener('click', function(e) {
            // Push forward
            var pushBtn = e.target.closest('[data-push]');
            if (pushBtn) {
                var id = pushBtn.dataset.push;
                var entering = getPanel(id);
                var leaving = getPanel(stack[stack.length - 1]);
                if (!entering) return;
                stack.push(id);
                activate(entering, leaving, 'forward');
                return;
            }
            // Pop back
            var popBtn = e.target.closest('[data-pop]');
            if (popBtn && stack.length > 1) {
                var leavingId = stack.pop();
                var leaving = getPanel(leavingId);
                var entering = getPanel(stack[stack.length - 1]);
                activate(entering, leaving, 'back');
            }
        });

        // Reset to main panel when sidebar is closed
        var toggle = document.getElementById('mob-menu-toggle');
        if (toggle) {
            toggle.addEventListener('change', function() {
                if (!this.checked) {
                    var delay = 350; // match sidebar close transition
                    setTimeout(function() {
                        stack = ['mob-main'];
                        container.querySelectorAll('.mob-nav-panel').forEach(function(p) {
                            p.removeAttribute('data-active');
                            p.removeAttribute('data-prev');
                        });
                        var main = getPanel('mob-main');
                        if (main) main.setAttribute('data-active', '');
                    }, delay);
                }
            });
        }
    }());
</script>
