@extends('admin/layouts/app')

@section('admin-title', 'Gallery – ' . config('site.name') . ' Admin Panel')
@section('admin-description', 'Manage photo galleries and albums for ' . config('site.full_name'))
@section('admin-keywords', 'gallery, photos, albums, images, admin, management')

@section('main')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Galleries</h1>
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
                                    Gallery</a>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover  table-striped">
                                    <thead>
                                        <tr>
                                            <th width="10%">#</th>
                                            <th width="30%">Name</th>
                                            <th width="20%">Menu</th>
                                            <th width="20%">View/Upload</th>
                                            <th width="20%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($albums !== null && count($albums) > 0)
                                            @foreach ($albums as $key => $album)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $album->album_name }}</td>
                                                    <td>{{ $album->album_parent_menu }}</td>
                                                    <td><button class="btn  btn-primary"><a
                                                                style="color: white; text-decoration: none"
                                                                href="{{ route('gallery.images', ['album_id' => $album->id]) }}">View/Upload</a></button>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-sm btn-success edit-gallery"
                                                            data-album_id="{{ $album->id }}"
                                                            data-album_name="{{ $album->album_name }}"
                                                            data-album_menu="{{ $album->album_parent_menu }}"
                                                            data-bs-toggle="modal" data-bs-target="#updateGalleryModal"><i
                                                                class="fas fa-edit"></i></a>

                                                        <button id="alert-delete" type="submit"
                                                            data-album_id={{ $album->id }} data-bs-toggle="modal"
                                                            data-bs-target="#staticBackdrop"
                                                            class="btn btn-sm btn-danger delete-album"><i
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

    <!-- Create Gallery Modal -->
    <div class="modal fade" id="createGalleryModal" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="createGalleryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createGalleryModalLabel">Gallery Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('gallery.create') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 mt-3">
                            <label for="album_name" class="form-label"> Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="album_name" placeholder="Enter Gallery Name"
                                required>
                            @error('album_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="album_parent_menu" class="form-label">Menu<span class="text-danger">*</span></label>
                            <select name="album_parent_menu" class="form-control" required>
                                <i class="bi bi-arrow-down-circle-fill"></i>
                                <option value="">-- Select a Menu -- </option>
                                <option value="School Events">School Events</option>
                                <option value="Activities">Activities</option>
                                <option value="Infrastructure">Infrastructure</option>
                                <option value="News Clippings">News Clippings</option>
                            </select>
                            @error('album_parent_menu')
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
    <div class="modal fade" id="updateGalleryModal" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="updateGalleryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateGalleryModalLabel">Update Gallery</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="update-gallery-form" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3 mt-3">
                            <label for="update_album_name" class="form-label"> Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="update_album_name" placeholder="Enter name"
                                name=album_name required>
                            @error('album_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="update_album_parent_menu" class="form-label">Menu<span
                                    class="text-danger">*</span></label>
                            <select name="album_parent_menu" id="update_album_parent_menu" class="form-control" required>
                                <option value="">-- Select a Menu --</option>
                                <option value="School Events">School Events</option>
                                <option value="Activities">Activities</option>
                                <option value="Infrastructure">Infrastructure</option>
                                <option value="News Clippings">News Clippings</option>
                            </select>
                            @error('album_parent_menu')
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
                    <form id="delete-album-form" method="POST" action="">
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
            let deleteButtons = document.querySelectorAll('.delete-album');
            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    let albumId = this.getAttribute('data-album_id');
                    let form = document.getElementById('delete-album-form');
                    form.action = "{{ route('gallery.delete', '') }}/" + albumId;
                });
            });
        });
    </script>
@endsection
