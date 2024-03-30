<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Backend\Role;
use Illuminate\Http\Request;
use App\Models\Backend\Module;
use App\Models\Backend\Permission;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function index()
    {
        if (Gate::allows('role-index')) {
            $roles = Role::with('permissions')->latest()->get();
            return view('admin.role.index', compact('roles'));
        }
        return abort(404);
    }
    public function create()
    {
        if (Gate::allows('role-store')) {
            $modules = Module::with('permissions')->get();
            return view('admin.role.create', compact('modules'));
        }
        return abort(404);
    }

    public function store(Request $request, FlasherInterface $flasher)
    {
        $validated = Validator::make($request->all(), [
            'role_name' => 'required|string',
            'permissions' => 'required|array'
        ])->validate();
        $validated['role_slug'] = Str::slug($validated['role_name']);
        Role::create($validated)->permissions()->sync($validated['permissions']);
        $flasher->addSuccess('Role Created Successfully.');
        return redirect()->route('role.index');
    }

    public function edit(Role $role)
    {
        if (Gate::allows('role-edit')) {
            $modules = Module::with('permissions')->get();
            return view('admin.role.edit', compact('modules', 'role'));
        }
        return abort(404);
    }

    public function update(Request $request, Role $role, FlasherInterface $flasher)
    {
        $validated = Validator::make($request->all(), [
            'role_name' => 'required|string',
            'permissions' => 'required|array'
        ])->validate();
        $validated['role_slug'] = Str::slug($validated['role_name']);
        $role->update($validated);
        $role->permissions()->sync($validated['permissions']);
        $flasher->addSuccess('Module Updated Successfully.');
        return redirect()->route('role.index');
    }

    public function destroy(Role $role, FlasherInterface $flasher)
    {
        if (Gate::allows('role-delete')) {
            $role->delete();
            $flasher->addSuccess('Module Deleted Successfully.');
            return back();
        }
        return abort(404);
    }
}
