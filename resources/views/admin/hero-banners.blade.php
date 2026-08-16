@extends('admin/layouts/app')

@section('admin-title', 'Hero Banners – ' . config('site.name') . ' Admin Panel')
@section('admin-description', 'Manage hero banners and featured images for the homepage')
@section('admin-keywords', 'banners, hero, featured, images, admin, management')

@section('main')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Hero Banners </h1>
                        <span class="font-size:10px;">Banner-Size: 26.5(w) x 9(h) in
                            inches</span>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('upload.banner') }}">Add Banner</a></li>
                            <li class="breadcrumb-item"><a target="_blank" href="{{ route('home.get') }}">View
                                    (HomePage) on Website</a>
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
                                <a href="{{ route('upload.banner') }}" class="btn btn-primary btn"><i
                                        class="fas fa-plus"></i> &nbsp;Add Banner</a>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap table-striped">
                                    <thead>
                                        <tr>
                                            <th width="100">#</th>
                                            <th width="100">Image</th>
                                            <th width="100">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($banners !== null && count($banners) > 0)
                                            @foreach ($banners as $key => $banner)
                                                @php
                                                    $sno = $loop->index + 1; // Manually incrementing the S.No
                                                @endphp
                                                <tr>
                                                    <td>{{ $sno }}</td>
                                                    <td>
                                                        <img src="{{ Storage::url($banner->banner_image_path) }}"
                                                            alt="banner-image"
                                                            style="width: 200px; height:100px; object-fit:cover">
                                                    </td>
                                                    <td>
                                                        <form class="d-inline" method="POST"
                                                            action="{{ route('banner.delete', ['id' => $banner->id]) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"><i
                                                                    class="fas fa-trash"></i></button>
                                                        </form>
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
@endsection
