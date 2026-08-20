<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Download;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;




class DownloadController extends Controller
{
    // To Implement Permissions
    public function __construct()
    {
        $this->middleware('permission:module-downloads', ['only' => ['index', 'store', 'delete']]);
    }
    public function index()
    {
        $downloads = Download::orderBy('created_at', 'DESC')->get();
        return view('admin.downloads.index', compact('downloads'));
    }

    // Function to create a Download  and store it in the database
    public function store(Request $request)
    {
        // Validate Incoming Request
        $validator = $this->validate_request($request);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Upload Image
        $data = $this->upload_file($request);

        Download::create($data);
        // Flash a success message to the session
        Session::flash('success', 'Downlod Resource  created successfully!');
        return redirect()->route('downloads.get');
    }

    public function delete(Request $request, $id)
    {
        // Explicit permission check
        if (!auth()->user()->hasPermissionTo('module-downloads')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            // Find the download to delete
            $deleted_download = Download::findOrFail($id);

            // Delete the associated file if it exists
            if ($deleted_download->download_file_path) {
                Storage::disk('public')->delete($deleted_download->download_file_path);
            }

            // Delete the download from the database
            $deleted_download->delete();

            // Flash a success message to the session
            Session::flash('success', 'Download Resource deleted successfully!');
            return redirect()->route('downloads.get');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred. Please try again.']);
        }
    }

    // Common function for validate request during creation and updation
    protected function validate_request(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'download_file' => ['required', 'mimes:pdf']
        ]);

        return $validator;
    }

    //Common function for File Upload
    protected function upload_file(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('download_file')) {
            $file = $request->file('download_file');
            $name = str::slug(strtolower($request->input('name')));
            $file_name = time() . '_' . $name . '_' . '.' . $file->getClientOriginalExtension();
            $folder_path = 'assets/downloads';
            $file->storeAs($folder_path, $file_name, 'public');
            $data['download_file_path'] = $folder_path . '/' . $file_name;
        }

        return $data;
    }

}
