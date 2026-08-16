@extends('admin/layouts/app')

@section('admin-title', 'Roles – ' . config('site.name') . ' Admin Panel')
@section('admin-description', 'Manage user roles and permissions')
@section('admin-keywords', 'roles, permissions, access control, admin, management')

@section('main')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Roles</h1>
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
                    <div id="session-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                @if (auth()->user()->can('create role'))
                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#createRoleModal">
                                        <i class="fas fa-plus"></i> &nbsp;Add Role
                                    </button>
                                @endif
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th width="20%">#</th>
                                            <th width="40%">Name</th>
                                            <th width="40%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($roles && count($roles) > 0)
                                            @foreach ($roles as $key => $role)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $role->name }}</td>
                                                    <td>
                                                        @if (auth()->user()->can('give-permission-to-role'))
                                                            <a class="btn btn-primary btn-sm"
                                                                href="{{ route('add_permission_to_role', $role->id) }}">
                                                                Add/Edit Permissions
                                                            </a>
                                                        @endif
                                                        @if (auth()->user()->can('update role'))
                                                            <button class="btn btn-sm btn-success edit-role"
                                                                data-role_id="{{ $role->id }}"
                                                                data-role_name="{{ $role->name }}" data-bs-toggle="modal"
                                                                data-bs-target="#editRoleModal">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                        @endif
                                                        @if (auth()->user()->can('delete role'))
                                                            <button type="button" data-role_id="{{ $role->id }}"
                                                                data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                                                class="btn btn-sm btn-danger delete-role">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        @endif

                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="3" class="text-center">No Roles available.</td>
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

    <!-- Add Role Modal -->
    <div class="modal fade" id="createRoleModal" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="createRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="createRoleModalLabel">Add Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('roles.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="role" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Role Name"
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

    <!-- Edit Role Modal -->
    <div class="modal fade" id="editRoleModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="editRoleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editRoleModalLabel">Edit Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit-role-form" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="edit_role" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit-role-name" name="name"
                                placeholder="Enter Role Name" required>
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

    <!-- Delete Role Modal -->
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
                    <form id="delete-role-form" method="POST" action="">
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
    {{-- JS for the Update Role Modal --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let editButtons = document.querySelectorAll('.edit-role');
            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    let roleId = this.getAttribute('data-role_id');
                    let roleName = this.getAttribute('data-role_name');

                    let form = document.getElementById('edit-role-form');
                    form.action = "{{ route('roles.update', '') }}/" + roleId;

                    document.getElementById('edit-role-name').value = roleName;
                });
            });
        });
    </script>
    <script>
        // JS for Delete button
        document.addEventListener('DOMContentLoaded', function() {
            let deleteButtons = document.querySelectorAll('.delete-role');
            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    let roleId = this.getAttribute('data-role_id');
                    let form = document.getElementById('delete-role-form');
                    form.action = "{{ route('roles.delete', '') }}/" + roleId;
                });
            });
        });
    </script>
@endsection
