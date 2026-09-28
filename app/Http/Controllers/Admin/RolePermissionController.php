<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\RolePermissionDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(RolePermissionDataTable $dataTable)
    {
        return $dataTable->render('admin.role-permission.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all()->groupBy('group_name');

        return view('admin.role-permission.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40', 'unique:roles,name'],
            'permissions' => ['required', 'array'],
            'permissions.*' => ['string', 'exists:permissions,name'],
        ]);

        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('admin.role.index')
            ->with('success', 'created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::find($id);
        if (!$role) {
            abort(404);
        }
        if ($role->name === 'Super Admin') {
            abort(403);
        }

        $rolePermissions = $role->permissions->pluck('name')->toArray();
        $permissions = Permission::all()->groupBy('group_name');
        return view('admin.role-permission.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40', 'unique:roles,name,' . $id],
            'permissions' => ['required', 'array'],
            'permissions.*' => ['string', 'exists:permissions,name'],
        ]);

        $role = Role::find($id);
        if (!$role) {
            abort(404);
        }

        if ($role->name === 'Super Admin') {
            abort(403);
        }


        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions);
        return redirect()->route('admin.role.index')
            ->with('success', 'Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            $role = Role::find($id);
            if (!$role) {
                abort(404, 'Role not found.');
            }


            if ($role->name === 'Super Admin') {
                return back()->with('error', "Cannot delete the Super Admin role.");
            }
            if ($role->users()->count() > 0) {
                return back()->with('error', "Cannot delete this role. It has {$role->users()->count()} user(s) assigned.");
            }

            $role->delete();

            return redirect()->route('admin.role.index')
                ->with('success', 'Role deleted successfully.');


        } catch (\Exception $e) {
            return redirect()->route('admin.role.index')
                ->with('error', 'Failed to delete role: ' . $e->getMessage());
        }
    }
}
