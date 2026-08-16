@extends('admin.layouts.app')

@section('admin-title', 'Learning Partners – ' . config('site.name') . ' Admin Panel')
@section('admin-description', 'Manage learning partners and their logos')
@section('admin-keywords', 'learning partners, partnerships, admin, management')

@section('main')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Learning Partners</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Learning Partners</li>
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

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h4 class="alert-heading">Errors!</h4>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row mb-3">
                <div class="col-sm-12">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPartnerModal">
                        <i class="fas fa-plus me-2"></i>Add Learning Partner
                    </button>
                </div>
            </div>

            <div class="row">
                @forelse($partners as $partner)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            @if($partner->logo_path)
                                <div class="card-img-top bg-light p-4 text-center" style="height: 180px; overflow: hidden;">
                                    <img src="{{ Storage::url($partner->logo_path) }}"
                                         alt="{{ $partner->name }}"
                                         class="img-fluid"
                                         style="max-height: 100%; object-fit: contain;">
                                </div>
                            @else
                                <div class="card-img-top bg-light p-4 text-center d-flex align-items-center justify-content-center" style="height: 180px;">
                                    <span class="text-muted">No logo</span>
                                </div>
                            @endif

                            <div class="card-body">
                                <h5 class="card-title">{{ $partner->name }}</h5>
                                @if($partner->description)
                                    <p class="card-text text-muted small">{{ Str::limit($partner->description, 80) }}</p>
                                @endif

                                <div class="mb-3">
                                    @if($partner->status === 'active')
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </div>
                            </div>

                            <div class="card-footer bg-transparent border-top">
                                <button class="btn btn-sm btn-info"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editPartnerModal"
                                        onclick="editPartner({{ $partner->toJson() }})">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <form method="POST" action="{{ route('admin.learning-partners.destroy', $partner->id) }}"
                                      style="display:inline;" onsubmit="return confirm('Delete this partner?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>No learning partners added yet.
                        </div>
                    </div>
                @endforelse
            </div>

        </div>
    </section>
</div>

{{-- Add Partner Modal --}}
<div class="modal fade" id="addPartnerModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Learning Partner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('admin.learning-partners.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Partner Name *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               id="name" name="name" required value="{{ old('name') }}">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description" name="description" rows="3">{{ old('description') }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="logo" class="form-label">Logo (Image)</label>
                        <input type="file" class="form-control @error('logo') is-invalid @enderror"
                               id="logo" name="logo" accept="image/*">
                        <small class="text-muted">Supported formats: JPEG, PNG, JPG, GIF (Max 5MB)</small>
                        @error('logo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="website_url" class="form-label">Website URL</label>
                        <input type="url" class="form-control @error('website_url') is-invalid @enderror"
                               id="website_url" name="website_url" value="{{ old('website_url') }}">
                        @error('website_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status *</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Partner</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit Partner Modal --}}
<div class="modal fade" id="editPartnerModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Learning Partner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" id="editForm" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Partner Name *</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Description</label>
                        <textarea class="form-control" id="edit_description" name="description" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="edit_logo" class="form-label">Logo (Image)</label>
                        <input type="file" class="form-control" id="edit_logo" name="logo" accept="image/*">
                        <small class="text-muted">Leave empty to keep current logo</small>
                    </div>

                    <div class="mb-3">
                        <label for="edit_website_url" class="form-label">Website URL</label>
                        <input type="url" class="form-control" id="edit_website_url" name="website_url">
                    </div>

                    <div class="mb-3">
                        <label for="edit_status" class="form-label">Status *</label>
                        <select class="form-select" id="edit_status" name="status" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Partner</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function editPartner(partner) {
    document.getElementById('edit_name').value = partner.name;
    document.getElementById('edit_description').value = partner.description || '';
    document.getElementById('edit_website_url').value = partner.website_url || '';
    document.getElementById('edit_status').value = partner.status;
    document.getElementById('editForm').action = `/admin/learning-partners/${partner.id}`;
}
</script>
@endsection
