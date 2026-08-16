<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- -- SEO: Title ---------------------------------------------------- --}}
    <title>@yield('title', $seo->title())</title>

    {{-- -- SEO: Core meta ------------------------------------------------ --}}
    <meta name="description" content="@yield('meta-description', $seo->description())">
    <meta name="keywords"    content="@yield('meta-keywords',    $seo->keywords())">
    <meta name="robots"      content="@yield('robots', $seo->robots())">
    <meta name="author"      content="{{ config('site.full_name') }}">

    {{-- -- SEO: Canonical URL --------------------------------------------- --}}
    <link rel="canonical" href="@yield('canonical', $seo->canonical())">

    {{-- -- SEO: Open Graph ----------------------------------------------- --}}
    <meta property="og:type"        content="@yield('og-type', $seo->ogType())">
    <meta property="og:site_name"   content="{{ config('site.full_name') }}">
    <meta property="og:locale"      content="{{ app()->getLocale() }}">
    <meta property="og:title"       content="@yield('og-title', $seo->ogTitle())">
    <meta property="og:description" content="@yield('og-description', $seo->ogDescription())">
    <meta property="og:url"         content="@yield('og-url', $seo->canonical())">
    <meta property="og:image"       content="@yield('og-image', $seo->ogImage())">

    {{-- -- SEO: Twitter Card --------------------------------------------- --}}
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="@yield('og-title',       $seo->ogTitle())">
    <meta name="twitter:description" content="@yield('og-description', $seo->ogDescription())">
    <meta name="twitter:image"       content="@yield('og-image',       $seo->ogImage())">

    {{-- CSRF --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset(config('site.favicon')) }}">

    {{-- Preconnects ------------------------------------------------------- --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="https://kit.fontawesome.com">

    {{-- -- LCP / resource preload hints (pages push their hero image here) --}}
    @stack('preload')

    {{-- -- Google Fonts: Poppins (body/UI) + Raleway (headings) ---------- --}}
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600&family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">

    {{-- -- Bootstrap CSS ------------------------------------------------ --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    {{-- App CSS --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{-- AOS CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    {{-- Bootstrap Icons (used by reels/media sections) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- -- Google Tag Manager (head) ----------------------------------- --}}
    @if(config('site.google_tag_manager'))
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','{{ config('site.google_tag_manager') }}');</script>
    @endif

    {{-- -- Google Analytics (GA4) --------------------------------------- --}}
    @if(config('site.google_analytics'))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('site.google_analytics') }}"></script>
    <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','{{ config('site.google_analytics') }}');</script>
    @endif

    {{-- -- Per-page styles ----------------------------------------------- --}}
    @yield('styles')

    {{-- -- Structured Data / JSON-LD (pages push schema here) ----------- --}}
    @stack('schema')

</head>

<body>
    {{-- Page Loader --}}
    <div id="page-loader">
        <div class="page-loader-spinner"></div>
    </div>

    {{-- Google Tag Manager (noscript) --}}
    @if(config('site.google_tag_manager'))
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ config('site.google_tag_manager') }}"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    @endif

    @include('header')
    <main class="@yield('main-class', '')">
        @yield('content')
    </main>

    @include('footer')

    {{-- FontAwesome (deferred — does not block rendering) --}}
    <script src="https://kit.fontawesome.com/ce31a4dd61.js" crossorigin="anonymous" defer></script>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    {{-- AOS --}}
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js" defer></script>

    {{-- Core site scripts -------------------------------------------------- --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // -- AOS animations
            if (typeof AOS !== 'undefined') AOS.init({
                once: true,
                duration: 350,
                offset: 50,
                easing: 'ease-out',
                disable: function () { return window.innerWidth < 768; }
            });

            // -- Level-3 submenu: click toggle for mobile/touch only
            // On desktop (=992px) CSS :hover handles it; JS is not needed there.
            document.querySelectorAll('.dropdown-submenu-toggle').forEach(function (toggle) {
                toggle.addEventListener('click', function (e) {
                    if (window.innerWidth >= 992) return; // desktop: let CSS hover handle it
                    e.preventDefault();
                    e.stopPropagation();
                    var li = this.closest('.dropdown-submenu');
                    var isOpen = li.classList.contains('open');
                    document.querySelectorAll('.dropdown-submenu.open').forEach(function (el) {
                        el.classList.remove('open');
                    });
                    if (!isOpen) li.classList.add('open');
                });
            });
            document.addEventListener('click', function () {
                document.querySelectorAll('.dropdown-submenu.open').forEach(function (el) {
                    el.classList.remove('open');
                });
            });

            // -- Session alert auto-hide
            var sessionAlert = document.getElementById('session-alert');
            if (sessionAlert) {
                setTimeout(function () { sessionAlert.style.display = 'none'; }, 2000);
            }

            // -- Hide page loader
            var loader = document.getElementById('page-loader');
            if (loader) {
                setTimeout(function () {
                    loader.classList.add('page-loader-done');
                    setTimeout(function () { loader.style.display = 'none'; }, 350);
                }, 300);
            }

            // -- Contact success modal (only if present)
            if (document.getElementById('contact-alert') && document.getElementById('successModal')) {
                new bootstrap.Modal(document.getElementById('successModal')).show();
            }

            // -- Popup modal (only if element exists on this page)
            var popupModalEl = document.getElementById('popupModal');
            if (popupModalEl) {
                new bootstrap.Modal(popupModalEl).show();
            }

            // -- Sticky header on scroll
            (function() {
                var h = document.getElementById('site-header');
                if (!h) return;
                var isHeroPage = !!document.querySelector('main.hero-page');
                function updateSticky() {
                    h.classList.toggle('sticky', !isHeroPage || window.scrollY > 60);
                }
                window.addEventListener('scroll', updateSticky, { passive: true });
                updateSticky();
            })();

        });
    </script>

    {{-- -- Sidebar "Register Now" CTA ----------------------------------- --}}
    @php
        $sidebarEnabled = \App\Models\SiteSetting::get('sidebar_register_enabled', '0');
        $sidebarText    = \App\Models\SiteSetting::get('sidebar_register_text', 'Register Now');
        $sidebarUrl     = \App\Models\SiteSetting::get('sidebar_register_url', '#');
    @endphp
    @if($sidebarEnabled === '1' && $sidebarUrl)
    <a href="{{ $sidebarUrl }}" target="_blank" rel="noopener" class="sidebar-register-btn" aria-label="{{ $sidebarText }}">
        <span>{{ $sidebarText }}</span>
    </a>
    <style>
        .sidebar-register-btn {
            position: fixed;
            right: 0;
            top: 50%;
            transform: translateY(-50%) rotate(90deg) translateX(50%);
            transform-origin: right center;
            background: var(--color-primary, #8c0305);
            color: #fff !important;
            text-decoration: none !important;
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.5px;
            padding: 10px 22px;
            border-radius: 6px 6px 0 0;
            z-index: 1050;
            white-space: nowrap;
            box-shadow: -2px 0 10px rgba(0,0,0,.18);
            transition: background .2s, padding .2s;
        }
        .sidebar-register-btn:hover {
            background: #a80408;
            padding: 12px 22px;
        }
        @media (max-width: 575.98px) {
            .sidebar-register-btn {
                font-size: 11px;
                padding: 8px 16px;
            }
        }
    </style>
    @endif

    {{-- Per-page scripts --}}
    @yield('scripts')
    @stack('scripts')

</body>

</html>
