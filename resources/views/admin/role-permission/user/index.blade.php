@extends('admin/layouts/app')

@section('admin-title', 'Users – ' . config('site.name') . ' Admin Panel')
@section('admin-description', 'Manage admin users and staff accounts')
@section('admin-keywords', 'users, admin, staff, accounts, management')

@section('main')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Users</h1>
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
                                @if (auth()->user()->can('create user'))
                                    <button id="add-gallery" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#createUser">
                                        <i class="fas fa-plus"></i> &nbsp;Add User
                                    </button>
                                @endif
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th width="20%">#</th>
                                            <th width="20%">Name</th>
                                            <th width="20%">Email</th>
                                            <th width="20%">Roles</th>
                                            <th width="20%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($users->count() > 0)
                                            @foreach ($users as $key => $user)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>
                                                        @if ($user->getRoleNames()->isNotEmpty())
                                                            @foreach ($user->getRoleNames() as $rolename)
                                                                <label
                                                                    class="badge bg-primary mx-1">{{ $rolename }}</label>
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (auth()->user()->can('update user'))
                                                            <button class="btn btn-sm btn-success edit-role"
                                                                data-user_id="{{ $user->id }}"
                                                                data-user_name="{{ $user->name }}"
                                                                data-user_email="{{ $user->email }}"
                                                                data-user_roles="{{ $user->getRoleNames()->implode(',') }}"
                                                                data-bs-toggle="modal" data-bs-target="#editUserModal">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                        @endif
                                                        @if (auth()->user()->can('delete user'))
                                                            <button type="button" class="btn btn-sm btn-danger delete-role"
                                                                data-role_id="{{ $user->id }}" data-bs-toggle="modal"
                                                                data-bs-target="#staticBackdrop">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5" class="text-center">No Users available.</td>
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

    <!-- Add User Modal -->
    <div class="modal fade" id="createUser" data-bs-backdrop="static" tabindex="-1" aria-labelledby="createUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="createUserModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Create Password <span
                                    class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password" placeholder="Enter Password"
                                required>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Roles <span class="text-danger">*</span></label>
                            <div id="rolesHelp" class="form-text mb-2">Select one or more roles.</div>
                            @foreach ($roles as $role)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="roles[]"
                                        value="{{ $role }}" id="role-{{ $loop->index }}" />
                                    <label class="form-check-label"
                                        for="role-{{ $loop->index }}">{{ $role }}</label>
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit-user-form" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="edit-user-id" name="user_id">
                        <div class="mb-3">
                            <label for="edit-user-name" class="form-label">Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit-user-name" name="name"
                                placeholder="Enter User Name" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="edit-user-email" class="form-label">Email <span
                                    class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="edit-user-email" name="email"
                                placeholder="Enter Email" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Roles <span class="text-danger">*</span></label>
                            <div id="rolesHelp" class="form-text mb-2">Select one or more roles.</div>
                            @foreach ($roles as $role)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="roles[]"
                                        value="{{ $role }}" id="edit-role-{{ $loop->index }}" />
                                    <label class="form-check-label"
                                        for="edit-role-{{ $loop->index }}">{{ $role }}</label>
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete User Modal -->
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
                    <form id="delete-user-form" method="POST" action="">
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle Edit Button Click
            document.querySelectorAll('.edit-role').forEach(button => {
                button.addEventListener('click', function() {
                    const userId = this.getAttribute('data-user_id');
                    const userName = this.getAttribute('data-user_name');
                    const userEmail = this.getAttribute('data-user_email');
                    const userRoles = this.getAttribute('data-user_roles').split(',');

                    document.getElementById('edit-user-id').value = userId;
                    document.getElementById('edit-user-name').value = userName;
                    document.getElementById('edit-user-email').value = userEmail;

                    // Check the roles
                    document.querySelectorAll('#editUserModal .form-check-input').forEach(input => {
                        input.checked = userRoles.includes(input.value);
                    });

                    // Set form action
                    const form = document.getElementById('edit-user-form');
                    form.action = `{{ route('users.update', '') }}/${userId}`;
                });
            });

            // Handle Delete Button Click
            document.querySelectorAll('.delete-role').forEach(button => {
                button.addEventListener('click', function() {
                    const userId = this.getAttribute('data-role_id');

                    // Set form action for delete
                    const form = document.getElementById('delete-user-form');
                    form.action = `{{ route('users.destroy', '') }}/${userId}`;
                });
            });
        });
    </script>
@endsection
