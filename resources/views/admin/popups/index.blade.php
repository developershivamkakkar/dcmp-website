@extends('admin/layouts/app')

@section('admin-title', 'Popups – ' . config('site.name') . ' Admin Panel')
@section('admin-description', 'Manage website popups and notifications')
@section('admin-keywords', 'popups, notifications, modals, admin, management')

@section('main')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Popups</h1>
                        <p>Popup Should be Square (Size 500px X 500px)</p>
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
                                    data-bs-target="#createPopupModal"><i class="fas fa-plus"></i> &nbsp;Add
                                    Popup</a>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover  table-striped">
                                    <thead>
                                        <tr>
                                            <th width="10%">#</th>
                                            <th width="50%">Image</th>
                                            <th width="20%">Status</th>
                                            <th width="20%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($popups !== null && count($popups) > 0)
                                            @foreach ($popups as $key => $popup)
                                                <tr>
                                                    <td>
                                                        {{ $sno = $loop->index + 1 }}
                                                    </td>
                                                    <td>
                                                        <img src="{{ Storage::url($popup->image) }}" alt="popup-image"
                                                            style="width: 100px; height:100px; object-fit:cover">
                                                    </td>
                                                    <td
                                                        class="mt-3 badge {{ $popup->status == 'active' ? 'bg-primary' : 'bg-danger' }}">
                                                        {{ $popup->status }}
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-sm btn-success edit-popup"
                                                            data-popup_id="{{ $popup->id }}"
                                                            data-popup_status="{{ $popup->status }}" data-bs-toggle="modal"
                                                            data-bs-target="#updatePopupModal"><i
                                                                class="fas fa-edit"></i></a>

                                                        <button id="alert-delete" type="submit"
                                                            data-popup_id={{ $popup->id }} data-bs-toggle="modal"
                                                            data-bs-target="#deletePopup"
                                                            class="btn btn-sm btn-danger delete-popup"><i
                                                                class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="12" class="text-center">No Popups available.</td>
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

    <!-- Add Popup Modal -->
    <div class="modal fade" id="createPopupModal" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="createPopupModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPopupModalLabel">Add Popup</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action={{ route('popup.upload') }} method="POST" action="#" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="banner_image">Upload <span class="text-danger">*</span>
                            </label>
                            <input type="file" name="popup_image" class="form-control" id="popup_image" required
                                accept=".jpg,.jpeg,.webp">
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- <div class="form-group">
                            <label for="popup_status" style="margon-left:2px">Status <span class="text-danger">*</span>
                            </label>
                            <select class="p-1 rounded" name="status">
                                <option class="p-2 rounded" value=""> Select a Popup Status</option>
                                <option class="p-2 rounded" value="active"> Active</option>
                                <option class="p-2 rounded" value="inactive"> Inactive</option>
                            </select>
                        </div> --}}
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Update Popup Modal --}}
    <div class="modal fade" id="updatePopupModal" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="updatePopupModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPopupModalLabel">Update Popup Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit-popup-form" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="popup_status">Status <span class="text-danger">*</span></label>
                            <select id="popupStatus" class="form-control" name="status" required>
                                <option value="">Select a Popup Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let editButtons = document.querySelectorAll('.edit-popup');
            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    let popupId = this.getAttribute('data-popup_id');
                    let popupStatus = this.getAttribute('data-popup_status');

                    // Set the form action to the update route with the popup ID
                    let form = document.getElementById('edit-popup-form');
                    form.action = "{{ route('popup.update', '') }}/" + popupId;

                    // Set the selected value in the status dropdown
                    let statusSelect = document.getElementById('popupStatus');
                    statusSelect.value = popupStatus;
                });
            });
        });
    </script>


    {{-- Modal Show on Delete button --}}
    <div class="modal fade" id="deletePopup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Are You Sure you want to delete?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="delete-popup-form" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        // Js for Delete button
        document.addEventListener('DOMContentLoaded', function() {
            let deleteButtons = document.querySelectorAll('.delete-popup');
            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    let popupId = this.getAttribute('data-popup_id');
                    let form = document.getElementById('delete-popup-form');
                    form.action = "{{ route('popup.delete', '') }}/" + popupId;
                });
            });
        });
    </script>
@endsection
