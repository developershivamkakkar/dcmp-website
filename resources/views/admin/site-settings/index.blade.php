@extends('admin/layouts/app')

@section('admin-title', 'Site Settings – ' . config('site.name') . ' Admin Panel')
@section('admin-description', 'Configure global site settings and preferences')
@section('admin-keywords', 'settings, configuration, preferences, admin')

@section('main')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Website Settings</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Website Settings</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">

                @if (Session::has('success'))
                    <div id="session-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('admin.site-settings.save') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- General --}}
                    <div class="card card-primary card-outline mb-4">
                        <div class="card-header"><h5 class="card-title mb-0">General</h5></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Short Name <span class="text-danger">*</span></label>
                                    <input type="text" name="site_name" class="form-control"
                                           value="{{ old('site_name', $settings['site_name'] ?? '') }}" required maxlength="255">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" name="site_full_name" class="form-control"
                                           value="{{ old('site_full_name', $settings['site_full_name'] ?? '') }}" maxlength="255">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Tagline</label>
                                    <input type="text" name="site_tagline" class="form-control"
                                           value="{{ old('site_tagline', $settings['site_tagline'] ?? '') }}" maxlength="255">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Favicon</label>
                                    <input type="file" name="favicon" class="form-control" accept=".ico,.png,.jpg,.jpeg,.svg,.webp">
                                    @if (!empty($settings['favicon_path']))
                                        <div class="mt-2">
                                            <small class="text-muted">Current:</small>
                                            <img src="{{ asset($settings['favicon_path']) }}" alt="Favicon" height="32" class="ms-2 border rounded p-1">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Contact --}}
                    <div class="card card-primary card-outline mb-4">
                        <div class="card-header"><h5 class="card-title mb-0">Contact &amp; Address</h5></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Address Line 1</label>
                                    <input type="text" name="address_line1" class="form-control"
                                           value="{{ old('address_line1', $settings['address_line1'] ?? '') }}" maxlength="255">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Address Line 2</label>
                                    <input type="text" name="address_line2" class="form-control"
                                           value="{{ old('address_line2', $settings['address_line2'] ?? '') }}" maxlength="255">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">City</label>
                                    <input type="text" name="address_city" class="form-control"
                                           value="{{ old('address_city', $settings['address_city'] ?? '') }}" maxlength="100">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">State</label>
                                    <input type="text" name="address_state" class="form-control"
                                           value="{{ old('address_state', $settings['address_state'] ?? '') }}" maxlength="100">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Country</label>
                                    <input type="text" name="address_country" class="form-control"
                                           value="{{ old('address_country', $settings['address_country'] ?? '') }}" maxlength="100">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Postal Code</label>
                                    <input type="text" name="address_postal" class="form-control"
                                           value="{{ old('address_postal', $settings['address_postal'] ?? '') }}" maxlength="20">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control"
                                           value="{{ old('phone', $settings['phone'] ?? '') }}" maxlength="30">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">WhatsApp</label>
                                    <input type="text" name="whatsapp" class="form-control"
                                           value="{{ old('whatsapp', $settings['whatsapp'] ?? '') }}" maxlength="30">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Email (Admissions)</label>
                                    <input type="email" name="email_admissions" class="form-control"
                                           value="{{ old('email_admissions', $settings['email_admissions'] ?? '') }}" maxlength="255">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Email (Info)</label>
                                    <input type="email" name="email_info" class="form-control"
                                           value="{{ old('email_info', $settings['email_info'] ?? '') }}" maxlength="255">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Social Media --}}
                    <div class="card card-primary card-outline mb-4">
                        <div class="card-header"><h5 class="card-title mb-0">Social Media</h5></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label"><i class="fab fa-facebook text-primary me-1"></i> Facebook URL</label>
                                    <input type="url" name="social_facebook" class="form-control"
                                           value="{{ old('social_facebook', $settings['social_facebook'] ?? '') }}" maxlength="255">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label"><i class="fab fa-instagram text-danger me-1"></i> Instagram URL</label>
                                    <input type="url" name="social_instagram" class="form-control"
                                           value="{{ old('social_instagram', $settings['social_instagram'] ?? '') }}" maxlength="255">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label"><i class="fab fa-linkedin text-info me-1"></i> LinkedIn URL</label>
                                    <input type="url" name="social_linkedin" class="form-control"
                                           value="{{ old('social_linkedin', $settings['social_linkedin'] ?? '') }}" maxlength="255">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label"><i class="fab fa-twitter text-info me-1"></i> Twitter / X URL</label>
                                    <input type="url" name="social_twitter" class="form-control"
                                           value="{{ old('social_twitter', $settings['social_twitter'] ?? '') }}" maxlength="255">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label"><i class="fab fa-youtube text-danger me-1"></i> YouTube URL</label>
                                    <input type="url" name="social_youtube" class="form-control"
                                           value="{{ old('social_youtube', $settings['social_youtube'] ?? '') }}" maxlength="255">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Important Links --}}
                    <div class="card card-primary card-outline mb-4">
                        <div class="card-header"><h5 class="card-title mb-0">Important Links</h5></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Admissions URL</label>
                                    <input type="text" name="admissions_url" class="form-control"
                                           value="{{ old('admissions_url', $settings['admissions_url'] ?? '') }}" maxlength="255">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Registration URL</label>
                                    <input type="text" name="registration_url" class="form-control"
                                           value="{{ old('registration_url', $settings['registration_url'] ?? '') }}" maxlength="255">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Enquiry URL</label>
                                    <input type="text" name="enquiry_url" class="form-control"
                                           value="{{ old('enquiry_url', $settings['enquiry_url'] ?? '') }}" maxlength="255">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Brochure --}}
                    <div class="card card-primary card-outline mb-4">
                        <div class="card-header"><h5 class="card-title mb-0">Brochure</h5></div>
                        <div class="card-body">
                            <div class="row align-items-end">
                                <div class="col-md-5 mb-3">
                                    <label class="form-label">Upload Brochure PDF <small class="text-muted">(max 10 MB)</small></label>
                                    <input type="file" name="brochure_file" class="form-control" accept=".pdf">
                                    @if (!empty($settings['brochure_path']))
                                        <div class="mt-2 d-flex align-items-center gap-2">
                                            <i class="fas fa-file-pdf text-danger fa-lg"></i>
                                            <a href="{{ asset($settings['brochure_path']) }}" target="_blank" class="small">
                                                View current brochure
                                            </a>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-7 mb-3">
                                    <label class="form-label">Brochure URL <small class="text-muted">(auto-filled on upload, or set manually)</small></label>
                                    <input type="text" name="brochure_url" class="form-control"
                                           value="{{ old('brochure_url', $settings['brochure_url'] ?? '') }}" maxlength="255"
                                           placeholder="/brochures/brochure.pdf or https://...">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Sidebar Register Now CTA --}}
                    <div class="card card-primary card-outline mb-4">
                        <div class="card-header"><h5 class="card-title mb-0">Sidebar "Register Now" Button</h5></div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-3 mb-3">
                                    <div class="form-check form-switch mt-2">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                               name="sidebar_register_enabled" id="sidebarToggle" value="1"
                                               {{ ($settings['sidebar_register_enabled'] ?? '0') === '1' ? 'checked' : '' }}>
                                        <label class="form-check-label fw-semibold" for="sidebarToggle">Show on Website</label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Button Text</label>
                                    <input type="text" name="sidebar_register_text" class="form-control"
                                           value="{{ old('sidebar_register_text', $settings['sidebar_register_text'] ?? 'Register Now') }}"
                                           maxlength="100" placeholder="Register Now">
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label class="form-label">Button URL</label>
                                    <input type="text" name="sidebar_register_url" class="form-control"
                                           value="{{ old('sidebar_register_url', $settings['sidebar_register_url'] ?? '') }}"
                                           maxlength="255" placeholder="https://admissions.yourschool.com">
                                </div>
                            </div>
                            <p class="text-muted small mb-0"><i class="fas fa-info-circle me-1"></i> A fixed button appears on the right side of every frontend page.</p>
                        </div>
                    </div>

                    {{-- Maps & Analytics --}}
                    <div class="card card-primary card-outline mb-4">
                        <div class="card-header"><h5 class="card-title mb-0">Maps &amp; Analytics</h5></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Google Analytics ID <small class="text-muted">(e.g. G-XXXXXXXXXX)</small></label>
                                    <input type="text" name="google_analytics_id" class="form-control"
                                           value="{{ old('google_analytics_id', $settings['google_analytics_id'] ?? '') }}" maxlength="50">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Google Tag Manager ID <small class="text-muted">(e.g. GTM-XXXXXXX)</small></label>
                                    <input type="text" name="google_tag_manager_id" class="form-control"
                                           value="{{ old('google_tag_manager_id', $settings['google_tag_manager_id'] ?? '') }}" maxlength="50">
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Google Maps Embed URL</label>
                                    <input type="text" name="maps_embed" class="form-control"
                                           value="{{ old('maps_embed', $settings['maps_embed'] ?? '') }}" maxlength="2000"
                                           placeholder="https://www.google.com/maps/embed?...">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- SEO --}}
                    <div class="card card-primary card-outline mb-4">
                        <div class="card-header"><h5 class="card-title mb-0">SEO</h5></div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Meta Description</label>
                                <textarea name="meta_description" class="form-control" rows="3" maxlength="500">{{ old('meta_description', $settings['meta_description'] ?? '') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Meta Keywords <small class="text-muted">(comma-separated)</small></label>
                                <textarea name="meta_keywords" class="form-control" rows="2" maxlength="1000">{{ old('meta_keywords', $settings['meta_keywords'] ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-1"></i> Save Settings
                        </button>
                    </div>
                </form>

            </div>
        </section>
    </div>

    @push('scripts')
        <script>
            setTimeout(function () {
                const el = document.getElementById('session-alert');
                if (el) el.remove();
            }, 4000);
        </script>
    @endpush
@endsection
