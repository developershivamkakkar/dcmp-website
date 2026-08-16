@extends('admin/layouts/app')

@section('admin-title', 'Downloads – ' . config('site.name') . ' Admin Panel')
@section('admin-description', 'Manage downloadable files and documents for students')
@section('admin-keywords', 'downloads, files, documents, admin, management')

@section('main')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Downloads</h1>
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
                                    data-bs-target="#createDownloadModal"><i class="fas fa-plus"></i> &nbsp;Add
                                    Download</a>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover  table-striped">
                                    <thead>
                                        <tr>
                                            <th width="20%">#</th>
                                            <th width="30%">Name</th>
                                            <th width="30%">View</th>
                                            <th width="20%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($downloads !== null && count($downloads) > 0)
                                            @foreach ($downloads as $key => $download)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $download->name }}</td>

                                                    <td>
                                                        <button class="btn btn-primary">
                                                            <a style="color: white" target="_blank"
                                                                href="{{ Storage::url($download->download_file_path) }}">View/Download</a>
                                                        </button>
                                                    </td>

                                                    <td>
                                                        <button id="alert-delete" type="submit"
                                                            data-download_id={{ $download->id }} data-bs-toggle="modal"
                                                            data-bs-target="#staticBackdrop"
                                                            class="btn btn-sm btn-danger delete-download"><i
                                                                class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5" class="text-center">No Albums found.</td>
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

    <!-- Create Download Modal -->
    <div class="modal fade" id="createDownloadModal" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="createDownloadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createDownloadModalLabel">Download Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('download.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 mt-3">
                            <label for="name" class="form-label"> Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Download Name"
                                required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 mt-3">

                            <label for="upload_pdf" class="form-label"> Upload Pdf <i class="fa-solid fa-upload"
                                    aria-hidden="true"></i><span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="download_file" accept=".pdf" required>
                            @error('download_file_path')
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
                    <form id="delete-download-form" method="POST" action="">
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
            let editButtons = document.querySelectorAll('.edit-gallery');
            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    let albumId = this.getAttribute('data-album_id');
                    let albumName = this.getAttribute('data-album_name');
                    let albumMenu = this.getAttribute('data-album_menu');

                    let form = document.getElementById('update-gallery-form');
                    form.action = "{{ route('gallery.update', '') }}/" + albumId;

                    document.getElementById('update_album_name').value = albumName;
                    document.getElementById('update_album_parent_menu').value = albumMenu;
                });
            });
        });
    </script>

    <script>
        // Js for Delete button
        document.addEventListener('DOMContentLoaded', function() {
            let deleteButtons = document.querySelectorAll('.delete-download');
            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    let downloadId = this.getAttribute('data-download_id');
                    let form = document.getElementById('delete-download-form');
                    form.action = "{{ route('download.delete', '') }}/" + downloadId;
                });
            });
        });
    </script>
@endsection
