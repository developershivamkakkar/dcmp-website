@extends('admin/layouts/app')
@section('admin-title', 'Permissions – ' . config('site.name') . ' Admin Panel')
@section('admin-description', 'Manage user permissions and access control')
@section('admin-keywords', 'permissions, access control, roles, admin, management')
@section('main')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Permissions</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
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

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                @if (auth()->user()->can('create permission'))
                                    <button id="add-gallery" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#createPermissionModal">
                                        <i class="fas fa-plus"></i> &nbsp;Add Permission
                                    </button>
                                @endif
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th width="20%">#</th>
                                            <th width="60%">Name</th>
                                            <th width="20%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($permissions && count($permissions) > 0)
                                            @foreach ($permissions as $key => $permission)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $permission->name }}</td>
                                                    <td>
                                                        @if (auth()->user()->can('update permission'))
                                                            <button class="btn btn-sm btn-success edit-permission"
                                                                data-permission_id="{{ $permission->id }}"
                                                                data-permission_name="{{ $permission->name }}"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editPermissionModal">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                        @endif
                                                        @if (auth()->user()->can('delete permission'))
                                                            <button id="alert-delete" type="button"
                                                                data-permission_id="{{ $permission->id }}"
                                                                data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                                                class="btn btn-sm btn-danger delete-permission">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="3" class="text-center">No Permissions available.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Add Permission Modal -->
    <div class="modal fade" id="createPermissionModal" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="createPermissionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="createPermissionModalLabel">Add Permission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('permissions.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="permission" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Permission Name"
                                required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Permission Modal -->
    <div class="modal fade" id="editPermissionModal" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="editPermissionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="editPermissionModalLabel">Edit Permission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit-permission-form" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="edit_permission" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit-permission-name" name="name"
                                placeholder="Enter Permission Name" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Show on Permissions Delete button --}}
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Are You Sure you want to delete?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="delete-permission-form" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- JS for the Update Permission Modal --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let editButtons = document.querySelectorAll('.edit-permission');
            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    let permissionId = this.getAttribute('data-permission_id');
                    let permissionName = this.getAttribute('data-permission_name');

                    let form = document.getElementById('edit-permission-form');
                    form.action = "{{ route('permissions.update', '') }}/" + permissionId;

                    document.getElementById('edit-permission-name').value = permissionName;
                });
            });
        });
    </script>
    <script>
        // Js for Delete button
        document.addEventListener('DOMContentLoaded', function() {
            let deleteButtons = document.querySelectorAll('.delete-permission');
            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    let permissionId = this.getAttribute('data-permission_id');
                    let form = document.getElementById('delete-permission-form');
                    form.action = "{{ route('permissions.delete', '') }}/" + permissionId;
                });
            });
        });
    </script>
@endsection
