@extends('admin/layouts/app')

@section('admin-title', 'Resources – ' . config('site.name') . ' Admin Panel')
@section('admin-description', 'Manage downloadable resources and documents for ' . config('site.full_name'))
@section('admin-keywords', 'resources, documents, files, admin, management')

@section('main')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Resource List</h1>
                        <span class="font-size:10px;">The resource file must be a file of type: pdf.</span>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('resource.create') }}">Create Resource</a></li>
                            <li class="breadcrumb-item"><a target="_blank" href="{{ route('resource-list') }}">View
                                    (Resource List) on Website</a>
                            </li>
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
                                <a href="{{ route('resource.create') }}" class="btn btn-primary btn"><i
                                        class="fas fa-plus"></i> &nbsp;Create</a>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap table-striped">
                                    <thead>
                                        <tr>
                                            <th width="50">#</th>
                                            <th width="100">Name</th>
                                            <th width="100">Session</th>
                                            <th width="100">File</th>
                                            <th width="100">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($lists !== null && count($lists) > 0)
                                            @foreach ($lists as $key => $list)
                                                @php
                                                    $sno = $loop->index + 1; // Manually incrementing the S.No
                                                @endphp
                                                <tr>
                                                    <td>{{ $sno }}</td>
                                                    <td>{{ $list->resource_name }}</td>
                                                    <td>{{ $list->session }}</td>
                                                    <td>
                                                        <button class="btn btn-primary">
                                                            <a style="color: white" target="_blank"
                                                                href="{{ Storage::url($list->resource_file_path) }}">View/Download</a>
                                                        </button>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-sm btn-success"
                                                            href="{{ route('update.resource', ['id' => $list->id]) }}"><i
                                                                class="fas fa-edit"></i></a>
                                                        <button id="alert-delete" data-bs-toggle="modal"
                                                            data-bs-target="#staticBackdrop"
                                                            data-resource_id="{{ $list->id }}" type="button"
                                                            class="btn btn-sm btn-danger delete-resource"><i
                                                                class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5" class="text-center">No records found.</td>
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

    {{-- Modal Show on Delete button --}}
    <!-- Modal -->
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
                    <form id="delete-resource-form" method="POST" action="">
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
            let deleteButtons = document.querySelectorAll('.delete-resource');
            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    let resourceId = this.getAttribute('data-resource_id');
                    let form = document.getElementById('delete-resource-form');
                    form.action = "{{ route('resource.delete', '') }}/" + resourceId;
                });
            });
        });
    </script>
@endsection
