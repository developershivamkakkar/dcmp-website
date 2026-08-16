@extends('admin/layouts/app')

@section('admin-title', 'Testimonials – ' . config('site.name') . ' Admin Panel')
@section('admin-description', 'Manage student and parent testimonials')
@section('admin-keywords', 'testimonials, reviews, feedback, admin, management')

@section('main')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Opinions That Matter</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Testimonials</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content h-100">
            <div class="container-fluid h-100">

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

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTestimonialModal">
                                    <i class="fas fa-plus"></i>&nbsp; Add Testimonial
                                </button>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover table-striped align-middle">
                                    <thead>
                                        <tr>
                                            <th width="4%">#</th>
                                            <th width="8%">Photo</th>
                                            <th width="18%">Name</th>
                                            <th width="14%">Designation</th>
                                            <th width="10%">Relation</th>
                                            <th width="30%">Opinion</th>
                                            <th width="7%">Rating</th>
                                            <th width="9%">Date</th>
                                            <th width="5%">Status</th>
                                            <th width="4%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($testimonials as $testimonial)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if ($testimonial->photo_path)
                                                        <img src="{{ Storage::url($testimonial->photo_path) }}"
                                                             alt="{{ $testimonial->name }}"
                                                             class="rounded-circle"
                                                             width="44" height="44"
                                                             style="object-fit:cover;">
                                                    @else
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
                                                            $bg = $gradients[abs(crc32($testimonial->name)) % count($gradients)];
                                                        @endphp
                                                        <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold"
                                                             style="width:44px;height:44px;background:{{ $bg }};color:#fff;font-size:1.1rem;box-shadow:0 2px 6px rgba(0,0,0,.15);flex-shrink:0;">
                                                            {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                                        </div>
                                                    @endif
                                                </td>
                                                <td class="fw-semibold">{{ $testimonial->name }}</td>
                                                <td>{{ $testimonial->designation ?? '—' }}</td>
                                                <td>{{ ucfirst($testimonial->relation ?? '—') }}</td>
                                                <td>{{ Str::limit($testimonial->content, 100) }}</td>
                                                <td>
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-warning' : 'text-muted' }}" style="font-size:.75rem;"></i>
                                                    @endfor
                                                </td>
                                                <td>{{ $testimonial->testimonial_date ? \Carbon\Carbon::parse($testimonial->testimonial_date)->format('d M Y') : '—' }}</td>
                                                <td>
                                                    <span class="badge {{ $testimonial->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                                        {{ ucfirst($testimonial->status) }}
                                                    </span>
                                                </td>
                                                <td class="d-flex gap-1">
                                                    <button class="btn btn-sm btn-success edit-btn"
                                                        data-id="{{ $testimonial->id }}"
                                                        data-name="{{ $testimonial->name }}"
                                                        data-designation="{{ $testimonial->designation }}"
                                                        data-relation="{{ $testimonial->relation }}"
                                                        data-content="{{ $testimonial->content }}"
                                                        data-rating="{{ $testimonial->rating }}"
                                                        data-sort_order="{{ $testimonial->sort_order }}"
                                                        data-status="{{ $testimonial->status }}"
                                                        data-date="{{ $testimonial->testimonial_date ?? '' }}"
                                                        data-photo="{{ $testimonial->photo_path ? Storage::url($testimonial->photo_path) : '' }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editTestimonialModal">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger delete-btn"
                                                        data-id="{{ $testimonial->id }}"
                                                        data-name="{{ $testimonial->name }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteTestimonialModal">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center py-4 text-muted">No testimonials added yet.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

    {{-- ───── Add Modal ───── --}}
    <div class="modal fade" id="createTestimonialModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="createTestimonialModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTestimonialModalLabel">Add Testimonial</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="e.g. Priya Sharma" required maxlength="255">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Designation / Role</label>
                                <input type="text" name="designation" class="form-control" placeholder="e.g. Parent of Class VIII student" maxlength="255">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Relation</label>
                                <select name="relation" class="form-select">
                                    <option value="">— Select —</option>
                                    <option value="parent">Parent</option>
                                    <option value="student">Student</option>
                                    <option value="alumni">Alumni</option>
                                    <option value="staff">Staff</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Rating <span class="text-danger">*</span></label>
                                <select name="rating" class="form-select" required>
                                    <option value="5" selected>★★★★★ (5)</option>
                                    <option value="4">★★★★☆ (4)</option>
                                    <option value="3">★★★☆☆ (3)</option>
                                    <option value="2">★★☆☆☆ (2)</option>
                                    <option value="1">★☆☆☆☆ (1)</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Sort Order</label>
                                <input type="number" name="sort_order" class="form-control" value="0" min="0">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-select" required>
                                    <option value="active" selected>Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Opinion / Testimonial <span class="text-danger">*</span></label>
                                <textarea name="content" class="form-control" rows="4" maxlength="2000" required placeholder="What they said about the school..."></textarea>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Date <small class="text-muted">(optional)</small></label>
                                <input type="date" name="testimonial_date" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Photo <small class="text-muted">(optional, JPG/PNG/WebP, max 2 MB)</small></label>
                                <input type="file" name="photo" class="form-control" accept="image/jpeg,image/png,image/webp">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Testimonial</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ───── Edit Modal ───── --}}
    <div class="modal fade" id="editTestimonialModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="editTestimonialModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTestimonialModalLabel">Edit Testimonial</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="edit-testimonial-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="edit-name" class="form-control" required maxlength="255">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Designation / Role</label>
                                <input type="text" name="designation" id="edit-designation" class="form-control" maxlength="255">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Relation</label>
                                <select name="relation" id="edit-relation" class="form-select">
                                    <option value="">— Select —</option>
                                    <option value="parent">Parent</option>
                                    <option value="student">Student</option>
                                    <option value="alumni">Alumni</option>
                                    <option value="staff">Staff</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Rating <span class="text-danger">*</span></label>
                                <select name="rating" id="edit-rating" class="form-select" required>
                                    <option value="5">★★★★★ (5)</option>
                                    <option value="4">★★★★☆ (4)</option>
                                    <option value="3">★★★☆☆ (3)</option>
                                    <option value="2">★★☆☆☆ (2)</option>
                                    <option value="1">★☆☆☆☆ (1)</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Sort Order</label>
                                <input type="number" name="sort_order" id="edit-sort-order" class="form-control" min="0">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select name="status" id="edit-status" class="form-select" required>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Opinion / Testimonial <span class="text-danger">*</span></label>
                                <textarea name="content" id="edit-content" class="form-control" rows="4" maxlength="2000" required></textarea>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Date <small class="text-muted">(optional)</small></label>
                                <input type="date" name="testimonial_date" id="edit-date" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Replace Photo <small class="text-muted">(leave blank to keep existing)</small></label>
                                <input type="file" name="photo" class="form-control" accept="image/jpeg,image/png,image/webp">
                                <div id="edit-current-photo" class="mt-2 d-none">
                                    <small class="text-muted">Current:</small>
                                    <img id="edit-photo-preview" src="" alt="Current photo" height="48" class="ms-2 rounded-circle" style="object-fit:cover;width:48px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Testimonial</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ───── Delete Confirm Modal ───── --}}
    <div class="modal fade" id="deleteTestimonialModal" tabindex="-1" aria-labelledby="deleteTestimonialModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteTestimonialModalLabel">Delete Testimonial</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete the testimonial from <strong id="delete-name"></strong>? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="delete-testimonial-form" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
    <script>
        // Edit modal population
        document.querySelectorAll('.edit-btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var form = document.getElementById('edit-testimonial-form');
                form.action = '/admin/testimonials/' + this.dataset.id;

                document.getElementById('edit-name').value        = this.dataset.name;
                document.getElementById('edit-designation').value = this.dataset.designation || '';
                document.getElementById('edit-content').value     = this.dataset.content;
                document.getElementById('edit-sort-order').value  = this.dataset.sort_order;
                document.getElementById('edit-date').value         = this.dataset.date || '';

                var relationEl = document.getElementById('edit-relation');
                Array.from(relationEl.options).forEach(function (o) { o.selected = o.value === btn.dataset.relation; });

                var ratingEl = document.getElementById('edit-rating');
                Array.from(ratingEl.options).forEach(function (o) { o.selected = o.value === btn.dataset.rating; });

                var statusEl = document.getElementById('edit-status');
                Array.from(statusEl.options).forEach(function (o) { o.selected = o.value === btn.dataset.status; });

                var photoWrap = document.getElementById('edit-current-photo');
                var photoImg  = document.getElementById('edit-photo-preview');
                if (this.dataset.photo) {
                    photoImg.src = this.dataset.photo;
                    photoWrap.classList.remove('d-none');
                } else {
                    photoWrap.classList.add('d-none');
                }
            });
        });

        // Delete modal population
        document.querySelectorAll('.delete-btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                document.getElementById('delete-name').textContent = this.dataset.name;
                document.getElementById('delete-testimonial-form').action = '/admin/testimonials/' + this.dataset.id;
            });
        });
    </script>
    @endsection
@endsection
