@extends('admin/layouts/app')

@section('admin-title', 'Transfer Certificates – ' . config('site.name') . ' Admin Panel')
@section('admin-description', 'Manage student transfer certificates')
@section('admin-keywords', 'transfer certificates, documents, admin, management')

@section('main')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Transfer Certificates</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Transfer Certificates</li>
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

            {{-- ── Upload + Filters row ──────────────────────────────────────── --}}
            <div class="row mb-3">
                {{-- Upload button --}}
                <div class="col-auto">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadTcModal">
                        <i class="fas fa-upload me-1"></i> Upload TC
                    </button>
                </div>

                {{-- Session filter --}}
                <div class="col-auto">
                    <form method="GET" action="{{ route('admin.tc.index') }}" class="d-flex gap-2">
                        <select name="session" class="form-control" onchange="this.form.submit()">
                            <option value="">All Sessions</option>
                            @foreach ($sessions as $s)
                                <option value="{{ $s }}" {{ request('session') == $s ? 'selected' : '' }}>
                                    {{ $s }}
                                </option>
                            @endforeach
                        </select>

                        {{-- Search --}}
                        <input type="text" name="search" class="form-control" placeholder="Admission No. / Name"
                               value="{{ request('search') }}">
                        <button class="btn btn-secondary" type="submit"><i class="fas fa-search"></i></button>
                        @if(request('session') || request('search'))
                            <a href="{{ route('admin.tc.index') }}" class="btn btn-outline-secondary">Clear</a>
                        @endif
                    </form>
                </div>
            </div>

            {{-- ── Table ────────────────────────────────────────────────────── --}}
            <div class="card">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Admission No.</th>
                                <th>Student Name</th>
                                <th>Father Name</th>
                                <th>Session</th>
                                <th>TC File</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tcs as $tc)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><strong>{{ $tc->admission_number }}</strong></td>
                                    <td>{{ $tc->student_name }}</td>
                                    <td>{{ $tc->father_name }}</td>
                                    <td>{{ $tc->session }}</td>
                                    <td>
                                        <a href="{{ Storage::url($tc->tc_file_path) }}" target="_blank"
                                           class="btn btn-sm btn-info">
                                            <i class="fas fa-file-pdf me-1"></i> View
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.tc.delete', $tc->id) }}" method="POST"
                                              onsubmit="return confirm('Delete this TC?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">No records found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
</div>

{{-- ── Upload Modal ──────────────────────────────────────────────────────── --}}
<div class="modal fade" id="uploadTcModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('admin.tc.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Upload Transfer Certificate</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Admission Number <span class="text-danger">*</span></label>
                        <input type="text" name="admission_number" class="form-control text-uppercase"
                               value="{{ old('admission_number') }}" required placeholder="e.g. DBELS-2024-001">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Student Name <span class="text-danger">*</span></label>
                        <input type="text" name="student_name" class="form-control"
                               value="{{ old('student_name') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Father's Name <span class="text-danger">*</span></label>
                        <input type="text" name="father_name" class="form-control"
                               value="{{ old('father_name') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Session <span class="text-danger">*</span></label>
                        <select name="session" class="form-control" required>
                            <option value="">— Select Session —</option>
                            @foreach ($sessionOptions as $opt)
                                <option value="{{ $opt }}" {{ old('session') == $opt ? 'selected' : '' }}>
                                    {{ $opt }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">TC File (PDF only, max 5 MB) <span class="text-danger">*</span></label>
                        <input type="file" name="tc_file" class="form-control" accept=".pdf" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-upload me-1"></i> Upload</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Re-open modal if validation failed --}}
@if ($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var modal = new bootstrap.Modal(document.getElementById('uploadTcModal'));
        modal.show();
    });
</script>
@endif

@endsection
