@extends('admin/layouts/app')

@section('admin-title', 'Upload Gallery Images – ' . config('site.name') . ' Admin Panel')
@section('admin-description', 'Upload and manage gallery images')
@section('admin-keywords', 'upload, gallery, images, admin')

@section('main')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="m-0">Gallery Name <span style="font-weight: 600">({{ $album_name }})</span>
                        </h4>
                        <span>The Size of Image Should not be more than 1Mb</span>
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
                    <div id= "session-alert" class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Upload Images</h3>
                            </div>
                            <form method="POST" action="{{ route('gallery.upload') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="banner_image">Upload <i class="fa-solid fa-upload"></i> <span
                                                class="text-danger">*</span>
                                        </label>
                                        <input type="hidden" name="album_id" value="{{ $album_id }}">
                                        <input type="file" name="images[]" class="form-control" required
                                            accept=".jpg,.jpeg,.webp" multiple>
                                        @error('images')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        @error('images.*')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>

                        </div>
                    </div>

                    @foreach ($images as $image)
                        <div class="col-md-3 mb-3">
                            <div class="card card-secondary h-100">
                                <div class="card-body position-relative"> <!-- Added position-relative class here -->
                                    <img src="{{ asset('storage/' . $image->album_image_path) }}" class="img-fluid">
                                    <div class="position-absolute top-0 end-0">
                                        <!-- Added position-absolute, top-0, end-0 classes here -->
                                        <form method="POST"
                                            action="{{ route('gallery.image.delete', ['image_id' => $image->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i
                                                    class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
        </section>
    </div>
@endsection
