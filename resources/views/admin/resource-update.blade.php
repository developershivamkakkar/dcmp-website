@extends('admin/layouts/app')

@section('admin-title', 'Update Resource – ' . config('site.name') . ' Admin Panel')
@section('admin-description', 'Edit and manage resource information')
@section('admin-keywords', 'edit resource, update, documents, admin')

@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Resource-Update</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('resource.create') }}">Create Resource</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('resources.get') }}">Resource List</a></li>
                        </ol>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content  h-100">
            <div class="container-fluid  h-100">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Update Resource - ({{ $updated_resource_item->resource_name }},
                                    {{ $updated_resource_item->session }})</h3>
                            </div>
                            {{-- Resource-Create Form --}}
                            <form method="POST" action="{{ route('resource.update', $updated_resource_item->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="resource_name">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="resource_name" class="form-control" id="resource_name"
                                            placeholder="Enter Resource Name"
                                            value="{{ old('resource_name', $updated_resource_item->resource_name) }}"
                                            required>
                                        {{-- To show errors in Resource name --}}
                                        @error('resource_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                        <label for="session">Session <span class="text-danger">*</span></label>
                                        <input type="text" name="session" class="form-control" id="session"
                                            placeholder="Enter Session"
                                            value="{{ old('session', $updated_resource_item->session) }}" required>

                                        {{-- To show errors in Resource Session --}}
                                        @error('session')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                        <label for="resource_file">Resource file <span class="text-danger">*</span></label>
                                        <input type="file" name="resource_file" class="form-control" id="resource_file"
                                            required accept=".pdf">

                                        {{-- To show errors in resource file --}}
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
            <!-- /.row -->
            <!-- /.row (main row) -->
    </div>
    <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
@endsection
