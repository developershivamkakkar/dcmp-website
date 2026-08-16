@extends('admin.layouts.app')

@section('admin-title', 'Page Editor – ' . config('site.name') . ' Admin Panel')
@section('admin-description', 'Edit website pages and manage page content')
@section('admin-keywords', 'page editor, content, pages, admin, management')

@section('main')
    <div class="content-wrapper">
        <!-- Content Header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-1">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Page Editor</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Page Editor</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Success Alert -->
                @if (Session::has('success'))
                    <div id="session-alert" class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        {{ Session::get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Page Editor Form -->
                <div class="row">
                    <div class="col-12">
                        @if ($menuItem)
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h3 class="card-title">{{ $menuItem->name }}</h3>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('page.save') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="menu_item_id" value="{{ $menuItem->id }}">

                                        <!-- Page Title -->
                                        <div class="form-group mb-4">
                                            <label for="title" class="form-label">Page Title</label>
                                            <input id="title" class="form-control" type="text" name="title"
                                                value="{{ old('title', $menuItem->pageContent->title ?? '') }}">
                                            @error('title')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Meta Title -->
                                        <div class="form-group mb-4">
                                            <label for="meta_title" class="form-label">Meta Title (SEO)</label>
                                            <input id="meta_title" class="form-control" type="text" name="meta_title"
                                                placeholder="50-60 characters recommended"
                                                value="{{ old('meta_title', $menuItem->pageContent->meta_title ?? '') }}">
                                            <small class="text-muted">Used for browser title and search results</small>
                                            @error('meta_title')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Meta Description -->
                                        <div class="form-group mb-4">
                                            <label for="meta_description" class="form-label">Meta Description (SEO)</label>
                                            <textarea id="meta_description" class="form-control" name="meta_description"
                                                rows="2" placeholder="150-160 characters recommended">{{ old('meta_description', $menuItem->pageContent->meta_description ?? '') }}</textarea>
                                            <small class="text-muted">Displayed under page title in search results</small>
                                            @error('meta_description')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Meta Keywords -->
                                        <div class="form-group mb-4">
                                            <label for="meta_keywords" class="form-label">Meta Keywords (SEO)</label>
                                            <textarea id="meta_keywords" class="form-control" name="meta_keywords"
                                                rows="2" placeholder="Enter keywords separated by commas">{{ old('meta_keywords', $menuItem->pageContent->meta_keywords ?? '') }}</textarea>
                                            <small class="text-muted">Comma-separated keywords for search engines</small>
                                            @error('meta_keywords')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Content Editor -->
                                        <div class="form-group mb-4">
                                            <label for="editor" class="form-label">Content</label>
                                            <textarea name="content" id="editor" class="form-control" placeholder="Enter Page Content Here">{{ old('content', $menuItem->pageContent->content ?? '') }}</textarea>
                                        </div>
                                        @error('content')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror

                                        <!-- Buttons -->
                                        <div class="form-group mb-4">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                            <a class="btn btn-secondary ms-2"
                                                href="{{ route('dependent-dropdown') }}">Back</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-warning" role="alert">
                                No menu item selected or found.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
