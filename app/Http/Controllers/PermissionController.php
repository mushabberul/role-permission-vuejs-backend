<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Backend\Module;
use App\Models\Backend\Permission;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;



class PermissionController extends Controller
{
    public function index()
    {
        if (Gate::allows('permission-index')) {
            $permissions = Permission::latest()->get();
            return view('admin.permission.index', compact('permissions'));
        }
        return abort(404);
    }
    public function create()
    {
        if (Gate::allows('permission-store')) {
            $modules = Module::orderBy('created_at')->get();
            return view('admin.permission.create', compact('modules'));
        }
        return abort(404);
    }

    public function store(Request $request, FlasherInterface $flasher)
    {
        $validated = Validator::make($request->all(), [
            'permission_name' => 'required|string',
            'module_id' => 'required|integer'
        ])->validate();
        $validated['permission_slug'] = Str::slug($validated['permission_name']);

        Permission::create($validated);
        $flasher->addSuccess('Permission Created Successfully.');
        return redirect()->route('permission.index');
    }

    public function edit(Permission $permission)
    {
        if (Gate::allows('permission-edit')) {
            $modules = Module::orderBy('created_at')->get();
            return view('admin.permission.edit', compact('permission', 'modules'));
        }
        return abort(404);
    }

    public function update(Request $request, Permission $permission, FlasherInterface $flasher)
    {
        $validated = Validator::make($request->all(), [
            'permission_name' => 'required|string',
            'module_id' => 'required|integer'
        ])->validate();
        $validated['permission_slug'] = Str::slug($validated['permission_name']);
        $permission->update($validated);
        $flasher->addSuccess('Module Updated Successfully.');
        return redirect()->route('permission.index');
    }

    public function destroy(Permission $permission, FlasherInterface $flasher)
    {
        if (Gate::allows('permission-delete')) {
            $permission->delete();
            $flasher->addSuccess('Module Deleted Successfully.');
            return back();
        }
        return abort(404);
    }
}
