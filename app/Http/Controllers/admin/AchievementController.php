<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AchievementController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:module-achievements', ['only' => ['index', 'store', 'delete']]);
    }

    public function index()
    {
        $achievements = Achievement::latest('created_at')->get();
        $categories   = ['Academic', 'Sports', 'Cultural', 'Arts', 'Other'];
        return view('admin.achievements.index', compact('achievements', 'categories'));
    }

    public function store(Request $request)
    {
        $rules = [
            'type'         => ['required', 'in:school,student'],
            'title'        => ['required', 'string', 'max:255'],
            'description'  => ['nullable', 'string'],
            'image'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];

        if ($request->type === 'student') {
            $rules['student_name'] = ['required', 'string', 'max:255'];
            $rules['class_name']   = ['nullable', 'string', 'max:100'];
            $rules['category']     = ['required', 'in:Academic,Sports,Cultural,Arts,Other'];
        }

        $request->validate($rules);

        $data = $request->only('type', 'category', 'student_name', 'class_name', 'title', 'description');

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('achievements', 'public');
        }

        Achievement::create($data);

        Session::flash('success', 'Achievement added successfully.');
        return redirect()->route('admin.achievements.index');
    }

    public function delete(int $id)
    {
        // Explicit permission check
        if (!auth('web')->check() || !auth('web')->user()->hasPermissionTo('module-achievements')) {
            abort(403, 'Unauthorized action.');
        }

        $achievement = Achievement::findOrFail($id);

        if ($achievement->image_path) {
            Storage::disk('public')->delete($achievement->image_path);
        }

        $achievement->delete();

        Session::flash('success', 'Achievement deleted successfully.');
        return redirect()->route('admin.achievements.index');
    }
}
