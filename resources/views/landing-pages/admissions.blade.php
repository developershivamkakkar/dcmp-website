@extends('layouts.app')
@section('title', $lp['adm_page_title'] ?? 'Admissions | ' . config('site.name'))
@section('meta-description', $lp['adm_meta_description'] ?? config('site.meta_description'))
@section('meta-keywords', config('site.meta_keywords'))

@section('styles')
<link rel="stylesheet" href="{{ asset('css/pages/show.css') }}">
<style>
/* -- Hero --------------------------------------- */
.adm-hero {
    background: linear-gradient(135deg, #031D3D 0%, #052A56 55%, #00A859 100%);
    padding: 60px 0 80px;
    position: relative;
    overflow: hidden;
}
.adm-hero::before {
    content: '';
    position: absolute;
    width: 700px; height: 700px;
    background: radial-gradient(circle, rgba(0,168,89,.18) 0%, transparent 65%);
    top: -200px; right: -120px;
    pointer-events: none;
}
.adm-hero::after {
    content: '';
    position: absolute;
    width: 360px; height: 360px;
    background: radial-gradient(circle, rgba(255,255,255,.08) 0%, transparent 70%);
    bottom: -80px; left: -60px;
    pointer-events: none;
}
.adm-hero-inner { position: relative; z-index: 2; }

.adm-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(0,168,89,.18);
    border: 1px solid rgba(0,168,89,.45);
    color: #00A859;
    font-size: 11px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase;
    padding: 6px 18px; border-radius: 40px; margin-bottom: 22px;
}
.adm-hero-title {
    font-size: clamp(28px, 4.5vw, 52px);
    font-weight: 900; color: #fff;
    line-height: 1.1; margin-bottom: 18px;
}
.adm-hero-text {
    font-size: 15px;
    color: rgba(255,255,255,.82);
    line-height: 1.8; margin-bottom: 36px;
}
.adm-btns { display: flex; flex-wrap: wrap; gap: 12px; }
.adm-btn-gold {
    background: #00A859; color: #fff; font-weight: 700;
    padding: 14px 32px; border-radius: 50px; font-size: 15px;
    text-decoration: none; border: none; cursor: pointer;
    transition: background .2s, transform .15s;
    display: inline-flex; align-items: center; gap: 8px;
}
.adm-btn-gold:hover { background: #009449; color: #fff; transform: translateY(-2px); }
.adm-btn-outline {
    border: 2px solid rgba(255,255,255,.55); color: #fff; font-weight: 600;
    padding: 12px 32px; border-radius: 50px; font-size: 15px;
    text-decoration: none; transition: border-color .2s, background .2s;
    display: inline-flex; align-items: center; gap: 8px;
}
.adm-btn-outline:hover { border-color: #fff; background: rgba(255,255,255,.1); color: #fff; }

/* Contact card */
.adm-contact-card {
    background: rgba(255,255,255,.1);
    border: 1px solid rgba(255,255,255,.2);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-radius: 20px;
    padding: 36px 32px;
}
.adm-contact-card-title {
    color: #00A859; font-size: 11px; font-weight: 700;
    letter-spacing: 2px; text-transform: uppercase;
    margin-bottom: 24px; display: flex; align-items: center; gap: 8px;
}
.adm-contact-card-title::after {
    content: ''; flex: 1; height: 1px; background: rgba(0,168,89,.3);
}
.adm-contact-row {
    display: flex; align-items: flex-start; gap: 14px;
    color: rgba(255,255,255,.9); font-size: 14px;
    text-decoration: none; margin-bottom: 20px; transition: color .2s;
}
.adm-contact-row:last-child { margin-bottom: 0; }
.adm-contact-row:hover { color: #00A859; }
.adm-contact-row .ci {
    width: 42px; height: 42px; border-radius: 12px; flex-shrink: 0;
    background: rgba(0,168,89,.18);
    display: flex; align-items: center; justify-content: center;
    font-size: 16px; color: #00A859;
}
.adm-contact-row .ct-label { font-size: 11px; opacity: .65; font-weight: 600; letter-spacing: .5px; text-transform: uppercase; margin-bottom: 2px; }
.adm-contact-row .ct-val  { font-size: 14px; font-weight: 500; line-height: 1.4; }
.adm-card-divider { height: 1px; background: rgba(255,255,255,.12); margin: 20px 0; }
.adm-wa-btn {
    display: flex; align-items: center; justify-content: center; gap: 10px;
    background: #25d366; color: #fff; font-weight: 700; font-size: 14px;
    padding: 12px 20px; border-radius: 50px; text-decoration: none; width: 100%;
    transition: background .2s, transform .15s;
}
.adm-wa-btn:hover { background: #1ebe5c; color: #fff; transform: translateY(-2px); }

/* Wave */
.adm-wave { line-height: 0; background: #052A56; }
.adm-wave svg { display: block; width: 100%; }

/* -- Process ------------------------------------- */
.adm-process { background: #f8fafc; padding: 80px 0 90px; }
.adm-eyebrow  { font-size: 11px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: #8c0305; margin-bottom: 8px; display: block; }
.adm-section-title { font-size: clamp(22px,3vw,32px); font-weight: 800; color: #1a2a4a; }

.adm-steps { display: grid; grid-template-columns: repeat(auto-fit,minmax(210px,1fr)); gap: 0; margin-top: 52px; position: relative; }
.adm-steps::before {
    content: '';
    position: absolute;
    top: 35px; left: calc(12.5% + 16px); right: calc(12.5% + 16px);
    height: 2px; background: linear-gradient(90deg,#8c0305,#d2ae6d);
    opacity: .25; pointer-events: none;
}
@media(max-width:767px){ .adm-steps::before { display: none; } }

.adm-step {
    background: transparent; padding: 0 16px;
    text-align: center; position: relative;
}
.adm-step-bubble {
    width: 70px; height: 70px; border-radius: 50%; margin: 0 auto 8px;
    background: linear-gradient(135deg,#8c0305,#d2ae6d);
    display: flex; align-items: center; justify-content: center;
    font-size: 24px; color: #fff;
    box-shadow: 0 6px 20px rgba(140,3,5,.25);
    position: relative; z-index: 1;
    transition: transform .25s, box-shadow .25s;
}
.adm-step:hover .adm-step-bubble { transform: translateY(-6px); box-shadow: 0 14px 32px rgba(140,3,5,.35); }
.adm-step-num-badge {
    position: absolute; top: -8px; right: -8px;
    width: 22px; height: 22px; border-radius: 50%;
    background: #1a2a4a; color: #fff;
    font-size: 10px; font-weight: 800;
    display: flex; align-items: center; justify-content: center;
    border: 2px solid #fff;
}
.adm-step-card-body {
    background: #fff; border-radius: 16px; padding: 24px 20px;
    box-shadow: 0 4px 20px rgba(0,0,0,.07);
    transition: transform .25s, box-shadow .25s;
    margin-top: 16px;
}
.adm-step:hover .adm-step-card-body { transform: translateY(-4px); box-shadow: 0 12px 32px rgba(0,0,0,.12); }
.adm-step-title { font-size: 15px; font-weight: 800; color: #1a2a4a; margin-bottom: 8px; }
.adm-step-text  { font-size: 13px; color: #666; line-height: 1.65; margin: 0; }
</style>
@endsection

@section('content')

    {{-- Floating buttons --}}


    @if(config('site.whatsapp'))
    <a href="https://wa.me/91{{ config('site.whatsapp') }}" class="whatsapp-button" target="_blank" rel="noopener noreferrer">
        <i class="fab fa-whatsapp"></i> Contact Us
    </a>
    @endif

    {{-- -- HERO -- --}}
    <section class="adm-hero">
        <div class="container adm-hero-inner">
            <div class="row align-items-center gy-5">

                {{-- Copy --}}
                <div class="col-lg-7" data-aos="fade-right">
                    <div class="adm-badge">
                        <i class="fas fa-star"></i>
                        {{ $lp['lp_cta_badge'] ?? 'Admissions Open 2026�27' }}
                    </div>
                    <h1 class="adm-hero-title">
                        {{ $lp['adm_hero_title'] ?? 'Admissions 2026�27' }}
                    </h1>
                    <p class="adm-hero-text">
                        {{ $lp['adm_hero_subtitle'] ?? '' }}
                    </p>
                    <div class="adm-btns">
                        @if(config('site.enquiry_url'))
                            <a href="{{ config('site.enquiry_url') }}" target="_blank" rel="noopener noreferrer" class="adm-btn-gold">
                                <i class="fas fa-question-circle"></i> Enquire Now
                            </a>
                        @else
                            <button class="adm-btn-gold npfWidgetButton npfWidget-cbdb663e4ed49cb2c31d9bd90e87b6c7">
                                <i class="fas fa-question-circle"></i> Enquire Now
                            </button>
                        @endif
                        <a href="{{ config('site.registration_url') ?: config('site.admissions_url') }}"
                           target="_blank" rel="noopener noreferrer" class="adm-btn-outline">
                            <i class="fas fa-pen"></i> Apply Online
                        </a>
                    </div>
                </div>

                {{-- Contact card --}}
                <div class="col-lg-5" data-aos="fade-left" data-aos-delay="120">
                    <div class="adm-contact-card">
                        <div class="adm-contact-card-title">
                            <i class="fas fa-headset"></i> Contact Admissions
                        </div>

                        @if(config('site.phone'))
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', config('site.phone')) }}" class="adm-contact-row">
                            <span class="ci"><i class="fas fa-phone-alt"></i></span>
                            <div>
                                <div class="ct-label">Phone</div>
                                <div class="ct-val">{{ config('site.phone') }}</div>
                            </div>
                        </a>
                        @endif

                        @if(config('site.email_admissions'))
                        <a href="mailto:{{ config('site.email_admissions') }}" class="adm-contact-row">
                            <span class="ci"><i class="fas fa-envelope"></i></span>
                            <div>
                                <div class="ct-label">Email</div>
                                <div class="ct-val">{{ config('site.email_admissions') }}</div>
                            </div>
                        </a>
                        @endif

                        @if(config('site.address.line1') || config('site.address.city'))
                        <div class="adm-contact-row">
                            <span class="ci"><i class="fas fa-map-marker-alt"></i></span>
                            <div>
                                <div class="ct-label">Address</div>
                                <div class="ct-val">{{ config('site.address.line1') }}{{ config('site.address.line2') ? ', ' . config('site.address.line2') : '' }}{{ config('site.address.city') ? ', ' . config('site.address.city') : '' }}</div>
                            </div>
                        </div>
                        @endif

                        @if(config('site.whatsapp'))
                        <div class="adm-card-divider"></div>
                        <a href="https://wa.me/91{{ config('site.whatsapp') }}" target="_blank" rel="noopener noreferrer" class="adm-wa-btn">
                            <i class="fab fa-whatsapp fa-lg"></i> Chat on WhatsApp
                        </a>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- Wave --}}
    <div class="adm-wave">
        <svg viewBox="0 0 1440 48" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,24 C480,48 960,0 1440,24 L1440,48 L0,48 Z" fill="#f8fafc"/>
        </svg>
    </div>

    {{-- -- PROCESS -- --}}
    <section class="adm-process">
        <div class="container">
            <div class="text-center" data-aos="fade-up">
                <span class="adm-eyebrow">How to Apply</span>
                <h2 class="adm-section-title">Admission Process</h2>
                <p class="text-muted mt-2">Four simple steps to join the {{ config('site.name') }} family</p>
            </div>

            <div class="adm-steps">
                @foreach([1,2,3,4] as $i)
                <div class="adm-step" data-aos="fade-up" data-aos-delay="{{ $i * 90 }}">
                    <div class="adm-step-bubble">
                        <i class="{{ $lp['adm_step_'.$i.'_icon'] ?? 'fas fa-circle' }}"></i>
                        <span class="adm-step-num-badge">{{ $i }}</span>
                    </div>
                    <div class="adm-step-card-body">
                        <div class="adm-step-title">{{ $lp['adm_step_'.$i.'_title'] ?? 'Step '.$i }}</div>
                        <p class="adm-step-text">{{ $lp['adm_step_'.$i.'_text'] ?? '' }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-brochure-modal />

@endsection
