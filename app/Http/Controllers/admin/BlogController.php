<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class BlogController extends Controller
{
    // To Implement Permissions
    public function __construct()
    {
        $this->middleware('permission:module-blogs', ['only' => ['index', 'store', 'edit', 'update', 'delete']]);
    }
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.blogs.index', compact('blogs'));
    }

    // Function to Create a Blog
    public function store(Request $request)
    {
        $validator = $this->validate_request($request);
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(); // Preserve input data for user convenience.
        }
        try {
            $data = $this->upload_image($request);
            Blog::create($data);
            // Flash a success message to the session
            Session::flash('success', 'Blog created successfully!');
            return redirect()->route('admin.blogs.get');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred. Please try again.']);
        }

    }


    public function edit(Request $request, $blog_id)
    {
        $blog = Blog::findOrFail($blog_id);
        return view('admin.blogs.edit-blog', compact('blog'));
    }

    // Function to Update a Blog
    public function update(Request $request, $blog_id)
    {
        // Validate the request data
        $validator = $this->validate_request($request, $blog_id);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(); // Preserve input data for user convenience.
        }

        try {
            // Find the existing blog post by ID
            $blog = Blog::findOrFail($blog_id);

            // Upload the image (if there's any file to upload)
            $data = $this->upload_image($request);

            // Update the blog data (we're assuming $data contains the necessary fields)
            $blog->update($data);

            // Flash a success message to the session
            Session::flash('success', 'Blog updated successfully!');

            // Redirect back to the blogs list
            return redirect()->route('admin.blogs.get');
        } catch (Exception $e) {
            // In case of an error, redirect back with an error message
            return redirect()->back()->withErrors(['error' => 'An error occurred. Please try again.']);
        }
    }

    // Function to delete a Blog
    public function delete($blog_id)
    {
        // Explicit permission check
        if (!auth()->user()->hasPermissionTo('module-blogs')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $blog = Blog::findOrFail($blog_id);
            $blog_image_path = $blog->blog_image_path;
            $blog->delete();
            // Check if the image file exists in storage before attempting to delete it
            if (Storage::disk('public')->exists($blog_image_path)) {
                // Delete the image file from storage
                Storage::disk('public')->delete($blog_image_path);
            }

        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred. Please try again.']);
        }

        return redirect()->route('admin.blogs.get'); // Redirect back to the blog list

    }


    //Common Function to Validate a Request
    protected function validate_request(Request $request, $blog_id = null)
    {
        // Validate the request fields
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'max:255'], // Title is required and must not exceed 255 characters.
            'slug' => [
                'required',
                'max:191',
                'unique:blogs,slug,' . $blog_id,  // Ignore current blog slug during update
            ],
            'author' => ['required', 'max:255'], // Author name is required.
            'content' => ['required'], // Content is required.
            'published_date' => ['required', 'date'], // Published date is required and must be a valid date.
            'status' => ['required', 'in:draft,published,archived'], // Status must be one of the enum values.
            'blog_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'], // Blog image is required and must be a valid image file.
        ]);

        return $validator;

    }
    // Function to  Upload a Image
    protected function upload_image(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('blog_image')) {
            $file = $request->file('blog_image');
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            $folder_path = 'assets/blog-images';
            $file->storeAs($folder_path, $file_name, 'public');
            $data['blog_image_path'] = $folder_path . '/' . $file_name;
        }

        return $data;
    }
}
