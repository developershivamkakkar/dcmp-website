<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\PageContent;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:module-manage-menu-items', ['only' => ['index', 'store', 'update', 'reorder']]);
        $this->middleware('permission:module-menu-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $menu_items = MenuItem::whereNull('parent_id')
            ->with('children.children')
            ->orderBy('display_order')
            ->get();
        $all_items = MenuItem::orderBy('display_order')->get();
        return view('admin.menu.index', compact('menu_items', 'all_items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'url'           => 'nullable|string|max:255',
            'parent_id'     => 'nullable|exists:menu_items,id',
            'status'        => 'required|in:active,inactive',
        ]);

        $maxOrder = MenuItem::where('parent_id', $validated['parent_id'] ?? null)->max('display_order') ?? 0;

        $menuItem = MenuItem::create([
            'name'          => $validated['name'],
            'url'           => $validated['url'],
            'parent_id'     => $validated['parent_id'] ?? null,
            'display_order' => $maxOrder + 1,
            'status'        => $validated['status'],
        ]);

        // Auto-create a blank page for this menu item
        PageContent::create([
            'menu_item_id' => $menuItem->id,
            'title'        => $menuItem->name,
            'content'      => null,
        ]);

        return redirect()->route('menu-items.index')->with('success', 'Menu item created successfully!');
    }

    public function update(Request $request, MenuItem $menuItem)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'url'       => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:menu_items,id',
            'status'    => 'required|in:active,inactive',
        ]);

        // Prevent setting item as its own parent
        if ($validated['parent_id'] == $menuItem->id) {
            return redirect()->route('menu-items.index')->with('error', 'An item cannot be its own parent.');
        }

        $menuItem->update([
            'name'      => $validated['name'],
            'url'       => $validated['url'],
            'parent_id' => $validated['parent_id'] ?? null,
            'status'    => $validated['status'],
        ]);

        return redirect()->route('menu-items.index')->with('success', 'Menu item updated successfully!');
    }

    public function destroy(MenuItem $menuItem)
    {
        // Explicit permission check
        if (!auth()->user()->hasPermissionTo('module-menu-delete')) {
            abort(403, 'Unauthorized action.');
        }

        // Promote children to top-level before deleting
        MenuItem::where('parent_id', $menuItem->id)->update(['parent_id' => $menuItem->parent_id]);
        $menuItem->delete();
        return redirect()->route('menu-items.index')->with('success', 'Menu item deleted.');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
        ]);

        foreach ($request->items as $item) {
            MenuItem::where('id', $item['id'])->update([
                'display_order' => $item['order'],
                'parent_id'     => $item['parent_id'] ?: null,
            ]);
        }

        return response()->json(['success' => true]);
    }
}
