@extends('admin/layouts/app')

@section('admin-title', 'FAQs – ' . config('site.name') . ' Admin Panel')
@section('admin-description', 'Create and manage frequently asked questions')
@section('admin-keywords', 'faqs, questions, answers, admin, management')

@section('main')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage FAQs</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">FAQs</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content h-100">
            <div class="container-fluid h-100">

                @if (Session::has('success'))
                    <div id="session-alert" class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createFaqModal">
                                    <i class="fas fa-plus"></i>&nbsp; Add FAQ
                                </button>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th width="5%">#</th>
                                            <th width="30%">Question</th>
                                            <th width="35%">Answer</th>
                                            <th width="12%">Category</th>
                                            <th width="8%">Order</th>
                                            <th width="5%">Status</th>
                                            <th width="5%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($faqs as $key => $faq)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $faq->question }}</td>
                                                <td>{{ Str::limit(strip_tags($faq->answer), 100) }}</td>
                                                <td>{{ $faq->category ?? '—' }}</td>
                                                <td>{{ $faq->sort_order }}</td>
                                                <td>
                                                    <span class="badge {{ $faq->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                                        {{ ucfirst($faq->status) }}
                                                    </span>
                                                </td>
                                                <td class="d-flex gap-1">
                                                    <button class="btn btn-sm btn-success edit-faq-btn"
                                                        data-id="{{ $faq->id }}"
                                                        data-question="{{ $faq->question }}"
                                                        data-answer="{{ $faq->answer }}"
                                                        data-category="{{ $faq->category }}"
                                                        data-sort_order="{{ $faq->sort_order }}"
                                                        data-status="{{ $faq->status }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editFaqModal">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger delete-faq-btn"
                                                        data-id="{{ $faq->id }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteFaqModal">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">No FAQs available.</td>
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

    {{-- Add FAQ Modal --}}
    <div class="modal fade" id="createFaqModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="createFaqModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createFaqModalLabel">Add FAQ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.faqs.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Question <span class="text-danger">*</span></label>
                            <input type="text" name="question" class="form-control" placeholder="Enter question" required maxlength="500">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Answer <span class="text-danger">*</span></label>
                            <textarea name="answer" class="form-control" rows="4" placeholder="Enter answer" required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Category</label>
                                <input type="text" name="category" class="form-control" placeholder="e.g. Admissions" maxlength="100">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Sort Order</label>
                                <input type="number" name="sort_order" class="form-control" value="0" min="0">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-select" required>
                                    <option value="active" selected>Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save FAQ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit FAQ Modal --}}
    <div class="modal fade" id="editFaqModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="editFaqModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editFaqModalLabel">Edit FAQ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="edit-faq-form" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Question <span class="text-danger">*</span></label>
                            <input type="text" name="question" id="edit-question" class="form-control" required maxlength="500">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Answer <span class="text-danger">*</span></label>
                            <textarea name="answer" id="edit-answer" class="form-control" rows="4" required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Category</label>
                                <input type="text" name="category" id="edit-category" class="form-control" maxlength="100">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Sort Order</label>
                                <input type="number" name="sort_order" id="edit-sort-order" class="form-control" min="0">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select name="status" id="edit-status" class="form-select" required>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update FAQ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Delete FAQ Modal --}}
    <div class="modal fade" id="deleteFaqModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteFaqModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteFaqModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this FAQ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="delete-faq-form" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    // Auto-hide success alert
    setTimeout(() => {
        const el = document.getElementById('session-alert');
        if (el) el.style.display = 'none';
    }, 4000);

    // Edit FAQ modal population
    document.querySelectorAll('.edit-faq-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            document.getElementById('edit-question').value    = this.dataset.question;
            document.getElementById('edit-answer').value      = this.dataset.answer;
            document.getElementById('edit-category').value    = this.dataset.category || '';
            document.getElementById('edit-sort-order').value  = this.dataset.sort_order;
            document.getElementById('edit-status').value      = this.dataset.status;
            document.getElementById('edit-faq-form').action   = `/admin/faqs/${id}`;
        });
    });

    // Delete FAQ modal target
    document.querySelectorAll('.delete-faq-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.getElementById('delete-faq-form').action = `/admin/faqs/${this.dataset.id}`;
        });
    });
</script>
@endsection
