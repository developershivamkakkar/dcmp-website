@extends('admin/layouts/app')

@section('admin-title', 'Create Resource – ' . config('site.name') . ' Admin Panel')
@section('admin-description', 'Upload and create new downloadable resources')
@section('admin-keywords', 'create resource, upload, documents, admin')

@section('main')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Resource-Create</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('resources.get') }}">Resource List</a></li>
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
                                <h3 class="card-title">Add Resource</h3>
                            </div>

                            <form method="POST" action="{{ route('resource.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="resource_name">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="resource_name" class="form-control" id="resource_name"
                                            required placeholder="Enter Resource Name" value="{{ old('resource_name') }}">
                                        @error('resource_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                        <label for="session">Session <span class="text-danger">*</span></label>
                                        <input type="text" name="session" class="form-control" id="session" required
                                            placeholder="Enter Session" value="{{ old('session') }}">
                                        @error('session')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                        <label for="resource_file">Resource file <span class="text-danger">*</span> </label>
                                        <input type="file" name="resource_file" class="form-control" id="resource_file"
                                            accept=".pdf" required>
                                        @error('resource_file')
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
