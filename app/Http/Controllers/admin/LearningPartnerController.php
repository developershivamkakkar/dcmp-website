<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\LearningPartner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LearningPartnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:module-manage-learning-partners', ['only' => ['index', 'store', 'update', 'destroy']]);
    }

    public function index()
    {
        $partners = LearningPartner::orderBy('display_order')->get();
        return view('admin.learning-partners.index', compact('partners'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'description'   => 'nullable|string',
            'logo'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'website_url'   => 'nullable|url|max:255',
            'status'        => 'required|in:active,inactive',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('learning-partners', 'public');
        }

        $maxOrder = LearningPartner::max('display_order') ?? 0;

        LearningPartner::create([
            'name'          => $validated['name'],
            'description'   => $validated['description'] ?? null,
            'logo_path'     => $logoPath,
            'website_url'   => $validated['website_url'] ?? null,
            'display_order' => $maxOrder + 1,
            'status'        => $validated['status'],
        ]);

        return redirect()->route('admin.learning-partners.index')->with('success', 'Learning partner added successfully!');
    }

    public function update(Request $request, LearningPartner $partner)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'description'   => 'nullable|string',
            'logo'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'website_url'   => 'nullable|url|max:255',
            'status'        => 'required|in:active,inactive',
        ]);

        $logoPath = $partner->logo_path;
        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($partner->logo_path) {
                Storage::disk('public')->delete($partner->logo_path);
            }
            $logoPath = $request->file('logo')->store('learning-partners', 'public');
        }

        $partner->update([
            'name'          => $validated['name'],
            'description'   => $validated['description'] ?? null,
            'logo_path'     => $logoPath,
            'website_url'   => $validated['website_url'] ?? null,
            'status'        => $validated['status'],
        ]);

        return redirect()->route('admin.learning-partners.index')->with('success', 'Learning partner updated successfully!');
    }

    public function destroy(LearningPartner $partner)
    {
        if ($partner->logo_path) {
            Storage::disk('public')->delete($partner->logo_path);
        }
        $partner->delete();
        return redirect()->route('admin.learning-partners.index')->with('success', 'Learning partner deleted.');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
        ]);

        foreach ($request->items as $item) {
            LearningPartner::where('id', $item['id'])->update(['display_order' => $item['order']]);
        }

        return response()->json(['message' => 'Order updated']);
    }
}
