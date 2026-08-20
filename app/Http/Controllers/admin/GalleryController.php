<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;



class GalleryController extends Controller
{
    // To Implement Permissions
    public function __construct()
    {
        $this->middleware('permission:module-gallery', ['only' => ['update', 'delete', 'create', 'images_view', 'upload', 'image_delete']]);
    }
    public function list_view()
    {
        $albums = Album::orderBy('created_at', 'desc')->get();
        return view('admin.gallery-list', compact('albums'));
    }

    public function update(Request $request, $id)
    {
        $validator = $this->validate_request($request);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            $album = Album::findOrFail($id);
            $data = $request->all();
            $album->update($data);
            // Flash a success message to the session
            Session::flash('success', 'Album Updated  successfully!');
            return redirect()->route('gallery.get');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred');
        }
    }

    public function delete(Request $request, $id)
    {
        // Explicit permission check
        if (!auth()->user()->hasPermissionTo('module-gallery')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $album = Album::findOrFail($id);
            $images = $album->images;
            if ($images) {
                foreach ($images as $image) {
                    $image_path = $image->album_image_path;
                    // Check if the image file exists in storage before attempting to delete it
                    if (Storage::disk('public')->exists($image_path)) {
                        // Delete the image file from storage
                        Storage::disk('public')->delete($image_path);
                    }
                }
            }

            // Delete the album, which should also delete associated images due to cascading
            $album->delete();

            // Flash a success message to the session
            Session::flash('success', 'Album deleted successfully!');
            return redirect()->route('gallery.get');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred');
        }
    }



    public function create(Request $request)
    {
        $validator = $this->validate_request($request);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        Album::create($data);
        // Flash a success message to the session
        Session::flash('success', 'Album created successfully!');
        return redirect()->route('gallery.get');
    }


    public function images_view(Request $request, $album_id)
    {
        $album = Album::findOrFail($album_id);
        $album_name = $album->album_name;
        $images = Image::where('album_id', $album_id)->get();
        return view('admin.upload-view-gallery', compact('album_id', 'album_name', 'images'));
    }

    public function upload(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'images' => 'required',
            'images.*' => 'image|mimes:jpg,jpeg,webp|max:1028',
            'album_id' => 'required|exists:albums,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $album_id = $request->input('album_id');
            $album = Album::findOrFail($album_id);
            $album_name = $album->album_name;

            if ($request->hasFile('images')) {
                $images = $request->file('images');
                foreach ($images as $image) {
                    $image_name = str_replace(' ', '_', strtolower(time() . '_' . $image->getClientOriginalName()));
                    $directory_path = 'assets/gallery-images/' . str_replace(' ', '_', strtolower($album_name));
                    $image_path = $directory_path . '/' . $image_name;
                    $image->storeAs($directory_path, $image_name, 'public');

                    Image::create([
                        'album_id' => $album_id,
                        'album_image_path' => $image_path,
                    ]);
                }
            }

            return redirect()->route('gallery.images', ['album_id' => $album_id])->with('success', 'Images uploaded successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while uploading the images.')->withInput();
        }
    }

    // Function for Image deletion
    public function image_delete($image_id)
    {
        try {
            $image = Image::findOrFail($image_id);

            // Get the image path from the model
            $image_path = $image->album_image_path;

            // Delete the image record from the database
            $image->delete();

            // Check if the image file exists in storage before attempting to delete it
            if (Storage::disk('public')->exists($image_path)) {
                // Delete the image file from storage
                Storage::disk('public')->delete($image_path);
            }

            return redirect()->back()->with('success', 'Image deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the image.')->withInput();
        }
    }

    // Function for Album Validation
    protected function validate_request(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'album_name' => ['required', 'string'],
            'album_parent_menu' => 'required|string|in:School Events,Activities,Infrastructure,News Clippings',
        ]);

        return $validator;
    }
}
