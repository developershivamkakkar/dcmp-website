@extends('admin/layouts/app')

@section('admin-title', 'Edit Blog – ' . config('site.name') . ' Admin Panel')
@section('admin-description', 'Edit and update blog post content')
@section('admin-keywords', 'edit blog, update, articles, content, admin')

@section('main')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Blog</h1>
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
                        <a href="{{ route('admin.blogs.get') }}" class="btn btn-primary mb-2"> Back</a>
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Blog</h3>
                            </div>

                            <div class="card-body">
                                <form class="edit-blog-form" method="POST"
                                    action="{{ route('admin.blog.update', ['blog_id' => $blog->id]) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <label for="blog_image"> Image
                                        </label>
                                        <input type="file" name="blog_image" class="form-control"
                                            accept="image/jpeg, image/png, image/jpg,image/webp">
                                        @error('blog_image')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="blog_title">Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title" value="{{ $blog->title }}"
                                            class="form-control update_blog_title" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="content">Content <span class="text-danger">*</span></label>
                                        <textarea name="content" id="editor" class="form-control">{{ $blog->content }}</textarea>
                                        @error('content')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="published_date">Published Date <span
                                                class="text-danger">*</span></label>
                                        <input type="date" name="published_date" class="form-control"
                                            value="{{ $blog->published_date->format('Y-m-d') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="author">Author <span class="text-danger">*</span></label>
                                        <input type="text" name="author" class="form-control"
                                            value="{{ $blog->author }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Slug <span class="text-danger">*</span></label>
                                        <input type="text" name="slug" value="{{ $blog->slug }}"
                                            class="form-control update_blog_slug" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="status" style="margon-left:2px">Status <span
                                                class="text-danger">*</span>
                                        </label>
                                        <select class="p-1 rounded" name="status" required>
                                            <option class="p-2 rounded" value="draft"
                                                {{ $blog->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                            <option class="p-2 rounded" value="archived"
                                                {{ $blog->status == 'archived' ? 'selected' : '' }}>Archived</option>
                                            <option class="p-2 rounded" value="published"
                                                {{ $blog->status == 'published' ? 'selected' : '' }}>Published
                                            </option>
                                        </select>
                                        @error('status')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
