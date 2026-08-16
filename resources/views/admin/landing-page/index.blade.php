@extends('admin.layouts.app')

@section('admin-title', 'Landing Page Editor – ' . config('site.name') . ' Admin Panel')
@section('admin-description', 'Edit landing page sections and content')
@section('admin-keywords', 'landing page, editor, content, admin, management')

@section('main')
<style>
    .lp-section-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.07);
        margin-bottom: 1.5rem;
    }
    .lp-section-card .card-header {
        background: linear-gradient(135deg, #1a2a4a 0%, #243b5e 100%);
        color: #fff;
        border-radius: 12px 12px 0 0 !important;
        padding: 14px 24px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .lp-section-card .card-header h5 { margin: 0; font-size: 15px; font-weight: 600; }
    .lp-section-card .card-body { padding: 24px; }
    .form-label { font-weight: 600; font-size: 13px; color: #444; margin-bottom: 5px; }
    .form-control { border-radius: 8px; border-color: #d8dde6; font-size: 14px; }
    .affects-badge {
        display: inline-block;
        font-size: 10.5px;
        font-weight: 600;
        padding: 2px 8px;
        border-radius: 20px;
        background: #e0f2fe;
        color: #0369a1;
        margin-top: 4px;
        text-transform: uppercase;
        letter-spacing: .3px;
    }
    .stat-card {
        background: #f8fafc;
        border: 1px solid #e8ecf0;
        border-radius: 10px;
        padding: 16px;
    }
    .stat-card label { font-size: 11px; text-transform: uppercase; color: #888; letter-spacing: .4px; }
    .sticky-save-bar {
        position: sticky;
        bottom: 0;
        background: #fff;
        border-top: 1px solid #e4e8f0;
        padding: 14px 24px;
        z-index: 100;
        box-shadow: 0 -4px 16px rgba(0,0,0,0.07);
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .preview-link { font-size: 12px; }
</style>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="fas fa-graduation-cap me-2 text-primary"></i>Admissions Page Editor</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Admissions Page Editor</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger mb-3">
                    <i class="fas fa-exclamation-circle me-2"></i> Please fix the errors below.
                </div>
            @endif

            {{-- Info bar --}}
            <div class="alert alert-info mb-3 py-2 d-flex align-items-center gap-2">
                <i class="fas fa-eye"></i>
                <span>Editing the <strong>Admissions page</strong> content.
                <a href="{{ url('admissions') }}" target="_blank" class="alert-link ms-1">Preview admissions page <i class="fas fa-external-link-alt fa-xs"></i></a></span>
            </div>

            <form action="{{ route('admin.landing-page.save') }}" method="POST" id="lpForm">
                @csrf

                {{-- ── Admissions Page ─────────────────────────── --}}
                <div class="card lp-section-card">
                    <div class="card-header" style="background: linear-gradient(135deg, #031D3D, #052A56);">
                        <i class="fas fa-graduation-cap"></i>
                        <h5>Admissions Page <small style="font-size:11px;opacity:.8;margin-left:6px;">
                            <a href="{{ url('admissions') }}" target="_blank" style="color:#00A859;">Preview <i class="fas fa-external-link-alt fa-xs"></i></a>
                        </small></h5>
                    </div>
                    <div class="card-body">

                        {{-- SEO --}}
                        <h6 class="fw-bold text-muted mb-3 border-bottom pb-2">Page Title &amp; Meta</h6>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Admissions Page Title</label>
                                <input type="text" name="adm_page_title" class="form-control"
                                       value="{{ old('adm_page_title', $settings['adm_page_title'] ?? '') }}"
                                       placeholder="Admissions 2026-27 | {{ config('site.name') }}">
                                <span class="affects-badge">Browser &lt;title&gt; on /admissions</span>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Admissions Meta Description</label>
                                <textarea name="adm_meta_description" rows="2" class="form-control"
                                          placeholder="Short description for Google search results...">{{ old('adm_meta_description', $settings['adm_meta_description'] ?? '') }}</textarea>
                            </div>
                        </div>

                        {{-- Hero --}}
                        <h6 class="fw-bold text-muted mb-3 border-bottom pb-2">Hero Banner</h6>
                        <div class="row g-3 mb-4">
                            <div class="col-md-5">
                                <label class="form-label">Hero Title <span class="text-danger">*</span></label>
                                <input type="text" name="adm_hero_title"
                                       class="form-control @error('adm_hero_title') is-invalid @enderror"
                                       value="{{ old('adm_hero_title', $settings['adm_hero_title'] ?? '') }}"
                                       placeholder="Admissions 2026–27">
                                <span class="affects-badge">Large heading in the page hero banner</span>
                                @error('adm_hero_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-7">
                                <label class="form-label">Hero Subtitle</label>
                                <textarea name="adm_hero_subtitle" rows="2" class="form-control"
                                          placeholder="Secure your child's future at D-Bels...">{{ old('adm_hero_subtitle', $settings['adm_hero_subtitle'] ?? '') }}</textarea>
                                <span class="affects-badge">Tagline below the hero title</span>
                            </div>
                        </div>

                        {{-- Process Steps --}}
                        <h6 class="fw-bold text-muted mb-3 border-bottom pb-2">Admission Process Steps</h6>
                        <p class="text-muted small mb-3">Enter a Font Awesome icon class e.g. <code>fas fa-paper-plane</code>.</p>
                        <div class="row g-3">
                            @foreach([1,2,3,4] as $i)
                            <div class="col-md-3">
                                <div class="stat-card">
                                    <label>Step {{ $i }} — Icon class</label>
                                    <input type="text" name="adm_step_{{ $i }}_icon" class="form-control mb-2"
                                           value="{{ old('adm_step_'.$i.'_icon', $settings['adm_step_'.$i.'_icon'] ?? '') }}"
                                           placeholder="fas fa-circle">
                                    <label>Step {{ $i }} — Title</label>
                                    <input type="text" name="adm_step_{{ $i }}_title" class="form-control mb-2"
                                           value="{{ old('adm_step_'.$i.'_title', $settings['adm_step_'.$i.'_title'] ?? '') }}"
                                           placeholder="Step {{ $i }}">
                                    <label>Step {{ $i }} — Description</label>
                                    <textarea name="adm_step_{{ $i }}_text" rows="3" class="form-control"
                                              placeholder="What happens in this step...">{{ old('adm_step_'.$i.'_text', $settings['adm_step_'.$i.'_text'] ?? '') }}</textarea>
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>

                {{-- ── Sticky Save Bar ──────────────────────────────── --}}
                <div class="sticky-save-bar">
                    <button type="submit" class="btn btn-primary px-5">
                        <i class="fas fa-save me-2"></i> Save Landing Page
                    </button>
                    <span class="text-muted small" id="saveHint"></span>
                </div>

            </form>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
    var hint  = document.getElementById('saveHint');
    var dirty = false;
    document.getElementById('lpForm').addEventListener('change', function () {
        if (!dirty) { hint.textContent = 'You have unsaved changes.'; hint.style.color = '#e67e22'; dirty = true; }
    });
</script>
@endsection
