@extends('layouts.app')

@section('title', 'Opinion That Matters – Testimonials')
@section('meta-description', 'Read what parents, students and alumni say about ' . config('site.full_name') . '.')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/pages/show.css') }}">
<style>
    /* ── Hero ──────────────────────────────────────────────────────── */
    .testimonials-hero {
        position: relative;
        background: linear-gradient(135deg, var(--color-primary, #052A56) 0%, #031D3D 60%, #00A859 100%);
        padding: 80px 0 100px;
        text-align: center;
        color: #fff;
        overflow: hidden;
    }
    /* decorative background circles */
    .testimonials-hero::before,
    .testimonials-hero::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        opacity: .08;
        background: #fff;
        pointer-events: none;
    }
    .testimonials-hero::before {
        width: 420px; height: 420px;
        top: -120px; left: -100px;
    }
    .testimonials-hero::after {
        width: 300px; height: 300px;
        bottom: 30px; right: -80px;
    }
    .testimonials-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2rem, 5vw, 3.2rem);
        font-weight: 800;
        letter-spacing: -.01em;
        margin-bottom: 12px;
        color: #fff;
        position: relative;
    }
    .testimonials-hero p {
        font-size: 1.08rem;
        color: rgba(255,255,255,.88);
        max-width: 540px;
        margin: 0 auto;
        position: relative;
    }
    /* wave divider */
    .hero-wave {
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        line-height: 0;
        overflow: hidden;
    }
    .hero-wave svg {
        display: block;
        width: 100%;
        height: 60px;
    }

    /* ── Section wrapper ───────────────────────────────────────────── */
    .testimonials-section { padding: 70px 0 80px; background: #fafafa; }

    /* ── Filter tabs ───────────────────────────────────────────────── */
    .filter-tabs { display: flex; gap: 8px; flex-wrap: wrap; justify-content: center; margin-bottom: 44px; }
    .filter-tabs button {
        padding: 7px 20px;
        border: 2px solid var(--color-primary, #8c0305);
        background: transparent;
        color: var(--color-primary, #8c0305);
        border-radius: 50px;
        font-size: .85rem;
        font-weight: 600;
        cursor: pointer;
        transition: background .2s, color .2s;
    }
    .filter-tabs button.active,
    .filter-tabs button:hover {
        background: var(--color-primary, #8c0305);
        color: #fff;
    }

    /* ── Card grid ─────────────────────────────────────────────────── */
    .testimonial-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 28px; }

    /* ── Card ───────────────────────────────────────────────────────── */
    .testimonial-card {
        background: #fff;
        border-radius: 16px;
        padding: 28px 24px 22px;
        box-shadow: 0 4px 18px rgba(0,0,0,.07);
        display: flex;
        flex-direction: column;
        gap: 16px;
        transition: transform .25s, box-shadow .25s;
        position: relative;
    }
    .testimonial-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 34px rgba(140,3,5,.12);
    }
    .testimonial-card::before {
        content: '\201C';
        position: absolute;
        top: 14px;
        right: 20px;
        font-size: 5rem;
        line-height: 1;
        color: var(--color-primary, #8c0305);
        opacity: .08;
        font-family: Georgia, serif;
        pointer-events: none;
    }

    /* Stars */
    .star-row { display: flex; gap: 3px; }
    .star-row i, #rm-stars i { font-size: .8rem; color: #f0a500; }
    .star-row i.empty, #rm-stars i.empty { color: #ddd; }

    /* Quote text */
    .testimonial-content {
        font-size: .95rem;
        color: #444;
        line-height: 1.75;
        flex: 1;
        font-style: italic;
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .view-full-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-top: 8px;
        padding: 4px 14px;
        border: 1.5px solid var(--color-primary, #8c0305);
        border-radius: 50px;
        background: transparent;
        color: var(--color-primary, #8c0305);
        font-size: .78rem;
        font-weight: 600;
        letter-spacing: .02em;
        cursor: pointer;
        transition: background .2s, color .2s;
    }
    .view-full-btn:hover {
        background: var(--color-primary, #8c0305);
        color: #fff;
    }
    /* modal avatar */
    #rm-avatar img,
    #rm-avatar div {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        object-fit: cover;
        flex-shrink: 0;
    }

    /* Author */
    .testimonial-author { display: flex; align-items: center; gap: 12px; }
    .testimonial-avatar {
        width: 52px; height: 52px;
        border-radius: 50%;
        object-fit: cover;
        flex-shrink: 0;
        border: 3px solid #f3e9e9;
    }
    .testimonial-avatar-placeholder {
        width: 52px; height: 52px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        border: 3px solid rgba(255,255,255,.6);
        box-shadow: 0 2px 10px rgba(0,0,0,.12);
        font-family: 'Playfair Display', serif;
        font-size: 1.35rem;
        font-weight: 700;
        color: #fff;
        text-shadow: 0 1px 3px rgba(0,0,0,.25);
        user-select: none;
    }
    .testimonial-name { font-weight: 700; font-size: .95rem; color: #1a1a1a; }
    .testimonial-designation { font-size: .8rem; color: #888; }
    .testimonial-date { font-size: .75rem; color: #aaa; margin-top: 2px; }
    .testimonial-badge {
        display: inline-block;
        padding: 2px 10px;
        border-radius: 50px;
        font-size: .7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .04em;
        margin-top: 4px;
    }
    .badge-parent  { background: #e8f4fd; color: #1565c0; }
    .badge-student { background: #e8f5e9; color: #2e7d32; }
    .badge-alumni  { background: #fce4ec; color: #c62828; }
    .badge-staff   { background: #fff3e0; color: #e65100; }
    .badge-other   { background: #f3e5f5; color: #6a1b9a; }

    /* Empty state */
    .testimonials-empty { text-align: center; padding: 60px 20px; color: #999; }
    .testimonials-empty i { font-size: 3rem; display: block; margin-bottom: 14px; }
</style>
@endsection

@section('content')

    {{-- Hero --}}
    <section class="testimonials-hero">
        <div class="container" style="position:relative;z-index:1;">
            <h1 data-aos="fade-up">Opinion That Matters</h1>
            <p data-aos="fade-up" data-aos-delay="80">Hear directly from the families and students who are part of the {{ config('site.name') }} community.</p>
        </div>
        <div class="hero-wave">
            <svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,30 C240,60 480,0 720,30 C960,60 1200,0 1440,30 L1440,60 L0,60 Z" fill="#fafafa"/>
            </svg>
        </div>
    </section>

    {{-- Testimonials --}}
    <section class="testimonials-section">
        <div class="container">

            @if ($testimonials->isNotEmpty())

                {{-- Filter tabs --}}
                <div class="filter-tabs" data-aos="fade-up">
                    <button class="active" data-filter="all">All</button>
                    @foreach ($testimonials->pluck('relation')->filter()->unique() as $rel)
                        <button data-filter="{{ $rel }}">{{ ucfirst($rel) }}s</button>
                    @endforeach
                </div>

                <div class="testimonial-grid" id="testimonial-grid">
                    @foreach ($testimonials as $t)
                        <div class="testimonial-card" data-relation="{{ $t->relation }}" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 80 }}">
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
                            @endphp

                            {{-- Stars --}}
                            <div class="star-row">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $t->rating ? '' : 'empty' }}"></i>
                                @endfor
                            </div>

                            {{-- Quote --}}
                            @php $limit = 160; $full = $t->content; $short = mb_strlen($full) > $limit; @endphp
                            <p class="testimonial-content">&ldquo;{{ $short ? mb_substr($full, 0, $limit) . '…' : $full }}&rdquo;</p>
                            @if ($short)
                                <button class="view-full-btn"
                                    data-full="{{ e($full) }}"
                                    data-name="{{ e($t->name) }}"
                                    data-designation="{{ e($t->designation) }}"
                                    data-date="{{ $t->testimonial_date ? \Carbon\Carbon::parse($t->testimonial_date)->format('d M Y') : '' }}"
                                    data-rating="{{ $t->rating }}"
                                    data-photo="{{ $t->photo_path ? Storage::url($t->photo_path) : '' }}"
                                    data-gradient="{{ $bg }}"
                                    data-initial="{{ strtoupper(substr($t->name, 0, 1)) }}"
                                    onclick="openReadMore(this)">
                                    <i class="fas fa-quote-right" style="font-size:.7rem;"></i> Full Opinion
                                </button>
                            @endif

                            {{-- Author --}}
                            <div class="testimonial-author">
                                @if ($t->photo_path)
                                    <img src="{{ Storage::url($t->photo_path) }}"
                                         alt="{{ $t->name }}"
                                         class="testimonial-avatar"
                                         loading="lazy">
                                @else
                                    <div class="testimonial-avatar-placeholder" style="background:{{ $bg }}">
                                        {{ strtoupper(substr($t->name, 0, 1)) }}
                                    </div>
                                @endif
                                <div>
                                    <div class="testimonial-name">{{ $t->name }}</div>
                                    @if ($t->designation)
                                        <div class="testimonial-designation">{{ $t->designation }}</div>
                                    @endif
                                    @if ($t->testimonial_date)
                                        <div class="testimonial-date"><i class="far fa-calendar-alt me-1"></i>{{ \Carbon\Carbon::parse($t->testimonial_date)->format('d M Y') }}</div>
                                    @endif
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>

            @else
                <div class="testimonials-empty">
                    <i class="fas fa-comment-dots"></i>
                    <p>No testimonials available yet.</p>
                </div>
            @endif

        </div>
    </section>

    {{-- Read-more modal --}}
    <div class="modal fade" id="readMoreModal" tabindex="-1" aria-labelledby="readMoreModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content" style="border-radius:16px;overflow:hidden;">
                <div class="modal-header" style="border-bottom:none;padding-bottom:0;">
                    <h6 class="modal-title" id="readMoreModalLabel" style="font-family:'Playfair Display',serif;font-size:1.1rem;">Opinion That Matters</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <div id="rm-stars" class="mb-2" style="display:flex;gap:3px;"></div>
                    <p id="rm-content" style="font-size:1rem;color:#333;font-style:italic;line-height:1.85;border-left:4px solid var(--color-primary,#8c0305);padding-left:18px;margin:8px 0 20px;"></p>
                    <div style="display:flex;align-items:center;gap:12px;">
                        <div id="rm-avatar"></div>
                        <div>
                            <div id="rm-name" style="font-weight:700;font-size:.95rem;"></div>
                            <div id="rm-designation" style="font-size:.8rem;color:#888;"></div>
                            <div id="rm-date" style="font-size:.75rem;color:#aaa;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var filterBtns = document.querySelectorAll('.filter-tabs button');
        var cards      = document.querySelectorAll('.testimonial-card');

        filterBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                filterBtns.forEach(function (b) { b.classList.remove('active'); });
                this.classList.add('active');

                var filter = this.dataset.filter;
                cards.forEach(function (card) {
                    var show = filter === 'all' || card.dataset.relation === filter;
                    card.style.display = show ? '' : 'none';
                });
            });
        });
    });

    function openReadMore(btn) {
        // Stars
        var rating = parseInt(btn.dataset.rating) || 5;
        var starsHtml = '';
        for (var i = 1; i <= 5; i++) {
            starsHtml += '<i class="fas fa-star' + (i <= rating ? '' : ' empty') + '"></i> ';
        }
        document.getElementById('rm-stars').innerHTML = starsHtml;

        // Content
        document.getElementById('rm-content').innerHTML = '\u201C' + btn.dataset.full + '\u201D';

        // Avatar
        var avatarEl = document.getElementById('rm-avatar');
        if (btn.dataset.photo) {
            avatarEl.innerHTML = '<img src="' + btn.dataset.photo + '" class="modal-avatar" alt="' + btn.dataset.name + '">';
        } else {
            avatarEl.innerHTML = '<div class="modal-avatar d-flex align-items-center justify-content-center fw-bold" style="background:' + btn.dataset.gradient + ';color:#fff;font-size:1.4rem;font-family:\'Playfair Display\',serif;">' + btn.dataset.initial + '</div>';
        }

        document.getElementById('rm-name').textContent        = btn.dataset.name;
        document.getElementById('rm-designation').textContent = btn.dataset.designation || '';
        document.getElementById('rm-date').innerHTML          = btn.dataset.date ? '<i class="far fa-calendar-alt me-1"></i>' + btn.dataset.date : '';

        var modal = new bootstrap.Modal(document.getElementById('readMoreModal'));
        modal.show();
    }
</script>
@endsection
