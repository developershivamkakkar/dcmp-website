@extends('admin/layouts/app')

@section('admin-title', 'Upload Explore Banner – ' . config('site.name') . ' Admin Panel')
@section('admin-description', 'Upload promotional banners for the explore section')
@section('admin-keywords', 'upload banner, promotional, explore, admin')

@section('main')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Explore Banner</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('banners.get') }}">Hero Banners</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content h-100">
            <div class="container-fluid h-100">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Add Banner</h3>
                            </div>

                            <form method="POST" action="{{ route('explore-upload.banner') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="banner_image">Upload Banner <span class="text-danger">*</span> </label>
                                        <input type="file" name="banner_image" class="form-control" id="banner_image"
                                            required accept=".jpg,.jpeg,.webp">
                                        @error('banner_image')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
