<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::orderBy('name')->get();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::orderBy('name')->get();
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request): RedirectResponse
    {
        $role = Role::create($request->all());
        //Paso a int los ids para que la libreria no los busque en los names
        $role->syncPermissions(array_map('intval', $request->permissions));
        return redirect()->route('admin.roles.show', compact('role'))
            ->with('status', 'success')
            ->with('msg', 'Rol creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $permissions = $role->permissions->sortBy('name');
        return view('admin.roles.show', compact('role', 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::orderBy('name')->get();
        $permissions->map(fn ($permission) => $permission->has = $role->permissions->contains('id', $permission->id));
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, Role $role): RedirectResponse
    {
        $role->update($request->all());

        //Paso a int los ids para que la libreria no los busque en los names
        $role->syncPermissions(array_map('intval', $request->permissions));

        return redirect()->route('admin.roles.show', compact('role'))
            ->with('status', 'success')
            ->with('msg', 'Rol editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('admin.roles.index')
            ->with('status', 'success')
            ->with('msg', 'Rol eliminado correctamente.');
    }
}
