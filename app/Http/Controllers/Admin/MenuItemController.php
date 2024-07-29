<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuItemRequest;
use App\Models\MenuItem;
use Illuminate\Http\RedirectResponse;

class MenuItemController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu_items = MenuItem::orderBy('position')->get();
        return view('admin.menu-items.index', compact('menu_items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.menu-items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuItemRequest $request): RedirectResponse
    {
        MenuItem::create($request->all());
        return redirect()->route('admin.menu-items.index')
            ->with('status', 'success')
            ->with('msg', 'Item creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(MenuItem $menu_item)
    {
        return view('admin.menu-items.show', compact('menu_item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MenuItem $menu_item)
    {
        return view('admin.menu-items.edit', compact('menu_item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuItemRequest $request, MenuItem $menu_item): RedirectResponse
    {
        $menu_item->update($request->all());
        return redirect()->route('admin.menu-items.show', compact('menu_item'))
            ->with('status', 'success')
            ->with('msg', 'Item editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MenuItem $menu_item)
    {
        $cant_parent = MenuItem::where('parent_id', $menu_item->id)->get()->count();

        if ($menu_item->id == $menu_item->id && $cant_parent > 1) {
            return redirect()->route('admin.menu-items.index')
                ->with('status', 'danger')
                ->with('msg', 'El item a eliminar contiene hijos');
        } else {
            $menu_item->update(['parent_id' => 9]);
            $menu_item->delete();

            return redirect()->route('admin.menu-items.index')
                ->with('status', 'success')
                ->with('msg', __('Item eliminado correctamente.'));
        }
    }
}
