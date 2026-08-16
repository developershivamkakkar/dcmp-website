@extends('admin.layouts.app')

@section('admin-title', 'Achievements – ' . config('site.name') . ' Admin Panel')
@section('admin-description', 'Manage student and school achievements')
@section('admin-keywords', 'achievements, awards, accomplishments, admin, management')

@section('main')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Achievements</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Achievements</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            @if (Session::has('success'))
                <div id="session-alert" class="alert alert-success">{{ Session::get('success') }}</div>
            @endif

            {{-- Tabs --}}
            <ul class="nav nav-tabs mb-3" id="achievementTabs">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#tab-all">All</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tab-school">
                        <i class="fas fa-school me-1"></i> School
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tab-student">
                        <i class="fas fa-user-graduate me-1"></i> Student
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                @foreach (['all' => $achievements, 'school' => $achievements->where('type','school'), 'student' => $achievements->where('type','student')] as $tabKey => $tabRows)
                <div class="tab-pane fade {{ $tabKey === 'all' ? 'show active' : '' }}" id="tab-{{ $tabKey }}">
                    <div class="card">
                        <div class="card-header">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAchievementModal">
                                <i class="fas fa-plus me-1"></i> Add Achievement
                            </button>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover table-striped align-middle">
                                <thead>
                                    <tr>
                                        <th width="4%">#</th>
                                        <th width="10%">Image</th>
                                        <th width="10%">Type</th>
                                        <th width="28%">Title</th>
                                        <th width="28%">Details</th>
                                        <th width="10%">Category</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($tabRows as $a)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if ($a->image_path)
                                                    <img src="{{ Storage::url($a->image_path) }}"
                                                         alt="{{ $a->title }}"
                                                         style="width:72px;height:54px;object-fit:cover;border-radius:4px;">
                                                @else
                                                    <span class="text-muted small">�</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($a->type === 'school')
                                                    <span class="badge bg-primary">School</span>
                                                @else
                                                    <span class="badge bg-success">Student</span>
                                                @endif
                                            </td>
                                            <td>
                                                <strong>{{ $a->title }}</strong>
                                                @if ($a->description)
                                                    <div class="text-muted small">{{ Str::limit($a->description, 60) }}</div>
                                                @endif
                                            </td>
                                            <td class="small">
                                                @if ($a->type === 'student')
                                                    <div><i class="fas fa-user fa-xs me-1 text-muted"></i>{{ $a->student_name }}</div>
                                                    @if ($a->class_name)
                                                        <div><i class="fas fa-chalkboard fa-xs me-1 text-muted"></i>{{ $a->class_name }}</div>
                                                    @endif
                                                @else
                                                    <span class="text-muted">�</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($a->category)
                                                    <span class="badge bg-secondary">{{ $a->category }}</span>
                                                @else
                                                    <span class="text-muted small">�</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button"
                                                    data-achievement-id="{{ $a->id }}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteAchievementModal"
                                                    class="btn btn-sm btn-danger btn-delete-achievement">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-4">No achievements found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>
</div>

{{-- Add Achievement Modal --}}
<div class="modal fade" id="addAchievementModal" data-bs-backdrop="static" tabindex="-1"
     aria-labelledby="addAchievementModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAchievementModalLabel">Add Achievement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.achievements.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold">Achievement Type <span class="text-danger">*</span></label>
                        <div class="d-flex gap-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="typeSchool" value="school"
                                       {{ old('type', 'school') === 'school' ? 'checked' : '' }}>
                                <label class="form-check-label" for="typeSchool">
                                    <i class="fas fa-school me-1"></i> School Achievement
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="typeStudent" value="student"
                                       {{ old('type') === 'student' ? 'checked' : '' }}>
                                <label class="form-check-label" for="typeStudent">
                                    <i class="fas fa-user-graduate me-1"></i> Student Achievement
                                </label>
                            </div>
                        </div>
                    </div>
                    <div id="studentFields" style="display:{{ old('type') === 'student' ? 'block' : 'none' }};">
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Student Name <span class="text-danger">*</span></label>
                                <input type="text" name="student_name" class="form-control"
                                       value="{{ old('student_name') }}" placeholder="e.g. Rahul Sharma">
                                @error('student_name')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Class</label>
                                <input type="text" name="class_name" class="form-control"
                                       value="{{ old('class_name') }}" placeholder="e.g. Class 10-A">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Category <span class="text-danger">*</span></label>
                            <select name="category" class="form-control">
                                <option value="">� Select Category �</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title') }}" placeholder="e.g. Gold Medal � District Science Olympiad" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3"
                                  placeholder="Brief description (optional)">{{ old('description') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image <span class="text-muted small">(optional � jpg/png/webp � max 2 MB)</span></label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                               accept="image/jpeg,image/png,image/webp">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Save Achievement</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Delete Confirmation Modal --}}
<div class="modal fade" id="deleteAchievementModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Are you sure you want to delete this achievement?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteAchievementForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    setTimeout(() => { const el = document.getElementById('session-alert'); if (el) el.style.display = 'none'; }, 4000);

    const studentFields = document.getElementById('studentFields');

    // Toggle on radio change
    document.querySelectorAll('input[name="type"]').forEach(radio => {
        radio.addEventListener('change', () => {
            studentFields.style.display = radio.value === 'student' ? 'block' : 'none';
        });
    });

    // Auto-open modal if validation errors exist (form was submitted)
    @if ($errors->any())
        const addModal = new bootstrap.Modal(document.getElementById('addAchievementModal'));
        addModal.show();
    @endif

    document.querySelectorAll('.btn-delete-achievement').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('deleteAchievementForm').action = `/admin/achievements/${btn.dataset.achievementId}`;
        });
    });
</script>
@endpush

@endsection
