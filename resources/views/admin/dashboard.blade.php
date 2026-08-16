@extends('admin/layouts/app')

@section('admin-title', 'Dashboard – ' . config('site.name') . ' Admin Panel')
@section('admin-description', 'Admin dashboard for managing ' . config('site.full_name') . ' website content.')
@section('admin-keywords', 'admin, dashboard, management, site control')

@section('main')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a target="_blank" href="{{ route('home.get') }}">View Website</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content h-100">
            <div class="container-fluid h-100">
                <div class="row">
                    <div class="col-md-12 welcome-panel text-center">
                        <div>
                            <h1>Welcome To Admin
                                Panel</h1>
                            <p class="card-text">Choose options from the left panel.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
