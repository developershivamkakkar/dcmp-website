@extends('admin/layouts/app')
@section('admin-title', 'Blogs – ' . config('site.name') . ' Admin Panel')
@section('admin-description', 'Create and manage blog posts and articles')
@section('admin-keywords', 'blogs, articles, posts, content, admin, management')
@section('main')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Blogs </h1>
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a id="add-gallery" class="btn btn-primary btn" data-bs-toggle="modal"
                                    data-bs-target="#createBlogModal"><i class="fas fa-plus"></i> &nbsp;Add
                                    Blog</a>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th width="10%">#</th>
                                            <th width="20%">Title</th>
                                            <th width="10%">Slug</th>
                                            {{-- <th width="35%">Content</th> --}}
                                            <th width="20%">Published Date</th>
                                            <th width="10%">Status</th>
                                            <th width="10%">Image</th>
                                            <th width="20%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($blogs !== null && count($blogs) > 0)
                                            @foreach ($blogs as $key => $blog)
                                                @php
                                                    $sno = $loop->index + 1; // Manually incrementing the S.No
                                                @endphp
                                                <tr>
                                                    <td>{{ $sno }}</td>
                                                    <td>{{ Str::limit($blog->title, 100) }}</td>
                                                    <td>{{ $blog->slug }}</td>
                                                    {{-- <td>{!! Str::limit($blog->content, 200) !!}</td> --}}
                                                    <td>{{ $blog->published_date->format('d F Y') }}</td>
                                                    <td>
                                                        @if ($blog->status === 'draft')
                                                            <span class="badge bg-warning text-dark">Draft</span>
                                                        @elseif ($blog->status === 'archived')
                                                            <span class="badge bg-secondary">Archived</span>
                                                        @elseif ($blog->status === 'published')
                                                            <span class="badge bg-success">Published</span>
                                                        @else
                                                            <span class="badge bg-light text-dark">Unknown</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <img class="img-fluid"
                                                            src="{{ Storage::url($blog->blog_image_path) }}">
                                                    </td>

                                                    <td>
                                                        <a href="{{ route('admin.blogs.edit', ['blog_id' => $blog->id]) }}"
                                                            class="btn btn-sm btn-success">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <button id="alert-delete" type="submit"
                                                            data-blog_id={{ $blog->id }} data-bs-toggle="modal"
                                                            data-bs-target="#deleteBlog"
                                                            class="btn btn-sm btn-danger delete-blog"><i
                                                                class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="12" class="text-center">No Blogs Found.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-2 mx-5">
                                @if ($blogs && $blogs->count())
                                    {{ $blogs->links() }}
                                @else
                                    <p>No blogs found.</p>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Add Blog Modal -->
    <div class="modal fade" id="createBlogModal" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="createBlogModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createBlogModalLabel">Add Blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="blog_image"> Image <span class="text-danger">*</span>
                            </label>
                            <input type="file" name="blog_image" class="form-control"
                                accept="image/jpeg, image/png, image/jpg,image/webp" required>
                            @error('blog_image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="blog_title">Title <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="title" class="form-control" placeholder="Enter title here"
                                value="{{ old('title') }}"required>
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="content">Content <span class="text-danger">*</span>
                            </label>
                            <textarea name="content" id="editor" class="form-control" placeholder="Enter Page Content Here"></textarea>
                            @error('content')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="published_date">Published Date <span class="text-danger">*</span>
                            </label>
                            <input value="{{ old('published_date') }}" type="date" name="published_date"
                                class="form-control" required>
                            @error('published_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="author">Author<span class="text-danger">*</span>
                            </label>
                            <input value="{{ old('author') }}" type="text" name="author" class="form-control"
                                required>
                            @error('author')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Slug">Slug<span class="text-danger">*</span>
                            </label>
                            <input value="{{ old('slug') }}" type="text" name="slug" class="form-control"
                                required>
                            @error('slug')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status" style="margon-left:2px">Status <span class="text-danger">*</span>
                            </label>
                            <select class="p-1 rounded" name="status" required>
                                <option class="p-2 rounded" value="" {{ old('status') == '' ? 'selected' : '' }}>
                                    Select a Blog Status</option>
                                <option class="p-2 rounded" value="draft"
                                    {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option class="p-2 rounded" value="archived"
                                    {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                                <option class="p-2 rounded" value="published"
                                    {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
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

    {{-- Modal Show on Delete button --}}
    <div class="modal fade" id="deleteBlog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Are You Sure you want to delete?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="delete-blog-form" method="POST" action="">
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
            let deleteButtons = document.querySelectorAll('.delete-blog');
            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    let blogId = this.getAttribute('data-blog_id');
                    let form = document.getElementById('delete-blog-form');
                    form.action = "{{ route('admin.blog.delete', '') }}/" + blogId;
                });
            });
        });
    </script>

@endsection
