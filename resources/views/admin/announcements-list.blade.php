@extends('admin/layouts/app')

@section('admin-title', 'Announcements – ' . config('site.name') . ' Admin Panel')
@section('admin-description', 'Create and manage school announcements and notices')
@section('admin-keywords', 'announcements, notices, updates, admin, management')

@section('main')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Announcements</h1>
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
                                <a id="add-gallery" class="btn btn-primary btn" data-bs-toggle="modal"
                                    data-bs-target="#createGalleryModal"><i class="fas fa-plus"></i> &nbsp;Add
                                    Announcement</a>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover  table-striped">
                                    <thead>
                                        <tr>
                                            <th width="20%">#</th>
                                            <th width="60%">Content</th>
                                            <th width="20%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($announcements !== null && count($announcements) > 0)
                                            @foreach ($announcements as $key => $announcement)
                                                <tr>
                                                    <td>
                                                        {{ $sno = $loop->index + 1 }}
                                                    </td>
                                                    <td>
                                                        {{ $announcement->content }}
                                                    </td>

                                                    <td>
                                                        <a class="btn btn-sm btn-success edit-announcement"
                                                            data-announcement_id="{{ $announcement->id }}"
                                                            data-announcement_content="{{ $announcement->content }}"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editAnnouncementModal"><i
                                                                class="fas fa-edit"></i></a>
                                                        <button id="alert-delete" type="submit"
                                                            data-announcement_id={{ $announcement->id }}
                                                            data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                                            class="btn btn-sm btn-danger delete-announcement"><i
                                                                class="fas fa-trash"></i></button>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="12" class="text-center">No Announcements available.</td>
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

    <!-- Add Announcement Modal -->
    <div class="modal fade" id="createGalleryModal" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="createGalleryModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createGalleryModalLabel">Announcement Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('announcements.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="announcements" class="form-label"> Announcement <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="content" placeholder="Enter Announcement"
                                required>
                            @error('content')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Gallery Modal -->
    <div class="modal fade" id="editAnnouncementModal" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="editAnnouncementModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAnnouncementModalLabel">Edit Announcement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit-announcement-form" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3 mt-3">
                            <label for="edit_announcement" class="form-label"> Content <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit-announcement-content"
                                placeholder="Enter name" name=content required>
                            @error('content')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Show on Delete button --}}
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
                    <form id="delete-announcement-form" method="POST" action="">
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
    {{-- JS For the Update Model --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let editButtons = document.querySelectorAll('.edit-announcement');
            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    let announcementId = this.getAttribute('data-announcement_id');
                    let announcementContent = this.getAttribute('data-announcement_content');

                    let form = document.getElementById('edit-announcement-form');
                    form.action = "{{ route('announcements.edit', '') }}/" + announcementId;

                    document.getElementById('edit-announcement-content').value =
                        announcementContent;
                });
            });
        });
    </script>

    <script>
        // Js for Delete button
        document.addEventListener('DOMContentLoaded', function() {
            let deleteButtons = document.querySelectorAll('.delete-announcement');
            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    let announcementId = this.getAttribute('data-announcement_id');
                    let form = document.getElementById('delete-announcement-form');
                    form.action = "{{ route('announcements.delete', '') }}/" + announcementId;
                });
            });
        });
    </script>
@endsection
