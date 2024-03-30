<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Backend\Module;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class ModuleController extends Controller
{
    public function index()
    {

        if (Gate::allows('module-index')) {
            $modules = Module::latest()->get();
            return view('admin.module.index', compact('modules'));
        }
        return abort(404);
    }
    public function create()
    {
        if (Gate::allows('module-store')) {
            return view('admin.module.create');
        }
        return abort(404);
    }

    public function store(Request $request, FlasherInterface $flasher)
    {
        $validated = Validator::make($request->all(), [
            'module_name' => 'required|string',
        ])->validate();
        $validated['module_slug'] = Str::slug($validated['module_name']);

        Module::create($validated);
        $flasher->addSuccess('Module Created Successfully.');
        return redirect()->route('module.index');
    }

    public function edit(Module $module)
    {
        if (Gate::allows('module-edit')) {
            return view('admin.module.edit', compact('module'));
        }
        return abort(404);
    }

    public function update(Request $request, Module $module, FlasherInterface $flasher)
    {
        $validated = Validator::make($request->all(), [
            'module_name' => 'required|string',
        ])->validate();
        $validated['module_slug'] = Str::slug($validated['module_name']);
        $module->update($validated);
        $flasher->addSuccess('Module Updated Successfully.');
        return redirect()->route('module.index');
    }

    public function destroy(Module $module, FlasherInterface $flasher)
    {

        if (Gate::allows('module-delete')) {
            $module->delete();
            $flasher->addSuccess('Module Deleted Successfully.');
            return back();
        }
        return abort(404);
    }
}
