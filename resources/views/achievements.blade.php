@extends('layouts.app')
@section('title', 'Achievements – Dass and Brown World School')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/show.css') }}">
    <style>
        /* -- Tab switcher ----------------------------------------------- */
        .achieve-tabs { gap: 12px; }
        .achieve-tabs .nav-link {
            border-radius: 50px;
            padding: 10px 32px;
            font-weight: 600;
            color: var(--color-primary);
            border: 2px solid var(--color-primary);
            background: transparent;
            transition: all .25s;
        }
        .achieve-tabs .nav-link.active,
        .achieve-tabs .nav-link:hover {
            background: var(--color-primary);
            color: #fff;
        }

        /* -- Category filter pills -------------------------------------- */
        .cat-pill {
            border-radius: 50px;
            padding: 6px 20px;
            font-size: .82rem;
            font-weight: 600;
            cursor: pointer;
            border: 2px solid #dee2e6;
            background: #fff;
            color: #555;
            transition: all .2s;
        }
        .cat-pill:hover  { border-color: var(--color-primary); color: var(--color-primary); }
        .cat-pill.active { background: var(--color-primary); border-color: var(--color-primary); color: #fff; }

        /* -- School achievement card ------------------------------------ */
        .school-card { border-radius: 14px; overflow: hidden; transition: transform .25s, box-shadow .25s; }
        .school-card:hover { transform: translateY(-6px); box-shadow: 0 16px 40px rgba(140,3,5,.15) !important; }
        .school-card .card-img-wrap { position: relative; height: 220px; overflow: hidden; }
        .school-card .card-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform .4s; }
        .school-card:hover .card-img-wrap img { transform: scale(1.06); }
        .school-card .img-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(140,3,5,.85) 0%, transparent 55%);
        }
        .school-card .overlay-title {
            position: absolute; bottom: 0; left: 0; right: 0;
            padding: 20px 18px 16px;
            color: #fff;
        }
        .school-card .card-no-img {
            height: 200px;
            background: linear-gradient(135deg, var(--color-primary-light) 0%, #fff 100%);
            display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 8px;
        }
        .school-card .card-body { padding: 16px 18px; }

        /* -- Student achievement card ----------------------------------- */
        .student-card-wrap { border-radius: 14px; overflow: hidden; transition: transform .25s, box-shadow .25s; }
        .student-card-wrap:hover { transform: translateY(-6px); box-shadow: 0 16px 40px rgba(0,0,0,.12) !important; }
        .student-card-wrap .card-img-wrap { position: relative; height: 180px; overflow: hidden; }
        .student-card-wrap .card-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform .4s; }
        .student-card-wrap:hover .card-img-wrap img { transform: scale(1.06); }
        .student-card-wrap .card-no-img {
            height: 140px;
            display: flex; align-items: center; justify-content: center;
        }
        .student-card-wrap .card-body { padding: 16px 18px; }
        .student-card-wrap .student-meta { font-size: .82rem; color: #777; }

        /* category accent colors */
        .cat-Academic  { --cat-bg:#e8f0fe; --cat-color:#1a56db; }
        .cat-Sports    { --cat-bg:#d1fae5; --cat-color:#057a55; }
        .cat-Cultural  { --cat-bg:#fce8ff; --cat-color:#7e3af2; }
        .cat-Arts      { --cat-bg:#fff3cd; --cat-color:#d97706; }
        .cat-Other     { --cat-bg:#f1f5f9; --cat-color:#475569; }

        .cat-badge {
            display: inline-block;
            padding: 3px 12px;
            border-radius: 50px;
            font-size: .75rem;
            font-weight: 700;
            background: var(--cat-bg);
            color: var(--cat-color);
        }

        /* -- Stats strip ------------------------------------------------ */
        .stats-strip { background: var(--color-primary); border-radius: 14px; }
        .stats-strip .stat-val { font-size: 2rem; font-weight: 800; color: #fff; line-height: 1; }
        .stats-strip .stat-lbl { font-size: .8rem; color: rgba(255,255,255,.75); text-transform: uppercase; letter-spacing: .06em; }

        /* -- Section heading -------------------------------------------- */
        .section-heading { display: flex; align-items: center; gap: 14px; margin-bottom: 32px; }
        .section-heading .sh-icon {
            width: 48px; height: 48px; border-radius: 50%;
            background: var(--color-primary-light);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .section-heading .sh-icon i { color: var(--color-primary); font-size: 1.2rem; }
        .section-heading h4 { margin: 0; font-weight: 700; color: var(--color-primary); }
        .section-heading .sh-line { flex: 1; height: 2px; background: linear-gradient(to right, var(--color-primary-border), transparent); }
    </style>
@endsection

@section('content')

    <a href="https://api.whatsapp.com/send/?phone={{ config('site.whatsapp') }}&text=Hello%20Dass%20and%20Brown%20World%20School&type=phone_number&app_absent=0"
       class="whatsapp-button" target="_blank">
        <i class="fab fa-whatsapp"></i> Contact Us
    </a>

    {{-- Page Hero --}}
    <div class="page-hero">
        <div class="page-hero-blob page-hero-blob-1"></div>
        <div class="page-hero-blob page-hero-blob-2"></div>
        <div class="page-hero-content">
            <h1 class="page-hero-title" data-aos="fade-up">Our Achievements</h1>
            <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="120">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home.get') }}"><i class="fas fa-home me-1"></i>Home</a></li>
                    <li class="breadcrumb-item active">Achievements</li>
                </ol>
            </nav>
        </div>
        <div class="page-hero-wave">
            <svg viewBox="0 0 1440 56" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,28 C360,56 1080,0 1440,28 L1440,56 L0,56 Z" fill="#f4f6f9"/>
            </svg>
        </div>
    </div>

    @php
        $schoolList  = $achievements->where('type', 'school');
        $studentList = $achievements->where('type', 'student');
        $cats        = ['All', 'Academic', 'Sports', 'Cultural', 'Arts', 'Other'];
        $catIcons    = ['All'=>'th-large','Academic'=>'book','Sports'=>'running','Cultural'=>'music','Arts'=>'palette','Other'=>'star'];
    @endphp

    <div class="container py-5">

        {{-- -- Stats strip ------------------------------------------------ --}}
        @if ($achievements->isNotEmpty())
        <div class="stats-strip p-4 mb-5" data-aos="fade-up">
            <div class="row text-center g-3">
                <div class="col-6 col-md-3">
                    <div class="stat-val">{{ $achievements->count() }}</div>
                    <div class="stat-lbl">Total Achievements</div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-val">{{ $schoolList->count() }}</div>
                    <div class="stat-lbl">School Awards</div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-val">{{ $studentList->count() }}</div>
                    <div class="stat-lbl">Student Wins</div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-val">{{ $studentList->pluck('category')->unique()->filter()->count() }}</div>
                    <div class="stat-lbl">Categories</div>
                </div>
            </div>
        </div>
        @endif

        {{-- -- Tab switcher ------------------------------------------------ --}}
        <ul class="nav achieve-tabs justify-content-center mb-5" id="achieveTabs" data-aos="fade-up">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#school-tab">
                    <i class="fas fa-school me-2"></i>School Achievements
                    <span class="ms-2 badge rounded-pill" style="background:rgba(255,255,255,.25);font-size:.7rem;">{{ $schoolList->count() }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#student-tab">
                    <i class="fas fa-user-graduate me-2"></i>Student Achievements
                    <span class="ms-2 badge rounded-pill" style="background:rgba(255,255,255,.25);font-size:.7rem;">{{ $studentList->count() }}</span>
                </a>
            </li>
        </ul>

        <div class="tab-content">

            {{-- ------------------ SCHOOL TAB ------------------------------ --}}
            <div class="tab-pane fade show active" id="school-tab">

                <div class="section-heading" data-aos="fade-up">
                    <div class="sh-icon"><i class="fas fa-award"></i></div>
                    <h4>School Awards &amp; Recognition</h4>
                    <div class="sh-line"></div>
                </div>

                @if ($schoolList->isEmpty())
                    <div class="text-center py-5" data-aos="fade-up">
                        <i class="fas fa-trophy fa-4x mb-3" style="color:var(--color-primary);opacity:.2;"></i>
                        <p class="text-muted">School achievements will be listed here soon.</p>
                    </div>
                @else
                    <div class="row g-4">
                        @foreach ($schoolList as $a)
                            <div class="col-12 col-sm-6 col-lg-4" data-aos="fade-up"
                                 data-aos-delay="{{ ($loop->index % 3) * 80 }}">
                                <div class="card h-100 border-0 shadow-sm school-card">
                                    @if ($a->image_path)
                                        <div class="card-img-wrap">
                                            <img src="{{ Storage::url($a->image_path) }}" alt="{{ $a->title }}">
                                            <div class="img-overlay"></div>
                                            <div class="overlay-title">
                                                <h6 class="fw-bold mb-0" style="text-shadow:0 1px 4px rgba(0,0,0,.4);">
                                                    {{ $a->title }}
                                                </h6>
                                            </div>
                                        </div>
                                        @if ($a->description)
                                            <div class="card-body">
                                                <p class="text-muted small mb-0">{{ $a->description }}</p>
                                            </div>
                                        @endif
                                    @else
                                        <div class="card-no-img">
                                            <i class="fas fa-award fa-3x" style="color:var(--color-primary);opacity:.35;"></i>
                                        </div>
                                        <div class="card-body">
                                            <h6 class="fw-bold mb-2" style="color:var(--color-primary);">{{ $a->title }}</h6>
                                            @if ($a->description)
                                                <p class="text-muted small mb-0">{{ $a->description }}</p>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- ------------------ STUDENT TAB ----------------------------- --}}
            <div class="tab-pane fade" id="student-tab">

                <div class="section-heading" data-aos="fade-up">
                    <div class="sh-icon"><i class="fas fa-medal"></i></div>
                    <h4>Student Achievements</h4>
                    <div class="sh-line"></div>
                </div>

                {{-- Category filter --}}
                <div class="d-flex flex-wrap gap-2 justify-content-center mb-4" data-aos="fade-up" id="catFilters">
                    @foreach ($cats as $cat)
                        <button class="cat-pill {{ $cat === 'All' ? 'active' : '' }}" data-cat="{{ $cat }}">
                            <i class="fas fa-{{ $catIcons[$cat] }} me-1"></i>{{ $cat }}
                        </button>
                    @endforeach
                </div>

                @if ($studentList->isEmpty())
                    <div class="text-center py-5" data-aos="fade-up">
                        <i class="fas fa-medal fa-4x mb-3" style="color:var(--color-primary);opacity:.2;"></i>
                        <p class="text-muted">Student achievements will be listed here soon.</p>
                    </div>
                @else
                    <div class="row g-4" id="studentGrid">
                        @foreach ($studentList as $a)
                            @php $catClass = 'cat-' . ($a->category ?? 'Other'); @endphp
                            <div class="col-12 col-sm-6 col-lg-4 student-item"
                                 data-cat="{{ $a->category ?? 'Other' }}"
                                 data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 80 }}">
                                <div class="card h-100 border-0 shadow-sm student-card-wrap {{ $catClass }}">
                                    @if ($a->image_path)
                                        <div class="card-img-wrap">
                                            <img src="{{ Storage::url($a->image_path) }}" alt="{{ $a->title }}">
                                        </div>
                                    @else
                                        <div class="card-no-img" style="background:var(--cat-bg, #f8f8f8);">
                                            <i class="fas fa-{{ $catIcons[$a->category ?? 'Other'] ?? 'star' }} fa-2x"
                                               style="color:var(--cat-color, var(--color-primary));opacity:.5;"></i>
                                        </div>
                                    @endif
                                    <div class="card-body">
                                        @if ($a->category)
                                            <span class="cat-badge {{ $catClass }} mb-2 d-inline-block">
                                                {{ $a->category }}
                                            </span>
                                        @endif
                                        <h6 class="fw-bold mb-2" style="color:var(--color-primary);">{{ $a->title }}</h6>
                                        <div class="student-meta d-flex align-items-center gap-2 mb-2">
                                            <span class="d-flex align-items-center gap-1">
                                                <i class="fas fa-user-circle" style="color:var(--cat-color, var(--color-primary));"></i>
                                                <strong>{{ $a->student_name }}</strong>
                                            </span>
                                            @if ($a->class_name)
                                                <span class="text-muted">·</span>
                                                <span><i class="fas fa-chalkboard me-1"></i>{{ $a->class_name }}</span>
                                            @endif
                                        </div>
                                        @if ($a->description)
                                            <p class="text-muted small mb-0">{{ $a->description }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>
    </div>

@push('scripts')
<script>
    document.querySelectorAll('#catFilters .cat-pill').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('#catFilters .cat-pill').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const cat = btn.dataset.cat;
            document.querySelectorAll('.student-item').forEach(card => {
                card.style.display = (cat === 'All' || card.dataset.cat === cat) ? '' : 'none';
            });
        });
    });
</script>
@endpush

@endsection
