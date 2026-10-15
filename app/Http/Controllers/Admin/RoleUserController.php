<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\RoleUserDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleUser\RoleUserCreateRequest;
use App\Http\Requests\Admin\RoleUser\RoleUserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RoleUserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:access management']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(RoleUserDataTable $dataTable)
    {
        return $dataTable->render('admin.role-permission.role-user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.role-permission.role-user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleUserCreateRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => 'admin',
        ]);

        $user->assignRole($request->role);
        return to_route('admin.role-users.index')
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
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.role-permission.role-user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleUserUpdateRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot update your own account.');
        }
        if ($user->hasRole('Super Admin') && User::role('Super Admin')->count() <= 1) {
            return back()->with('error', 'You cannot update the last Super Admin.');
        }
        $user->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'user_type' => 'admin',
        ]);

        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        $user->syncRoles([$request->role]);

        return to_route('admin.role-users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        if ($user->hasRole('Super Admin') && User::role('Super Admin')->count() <= 1) {
            return back()->with('error', 'You cannot delete the last Super Admin.');
        }

        $user->delete();
        return to_route('admin.role-users.index')
            ->with('success', 'User deleted successfully.');
    }
}
