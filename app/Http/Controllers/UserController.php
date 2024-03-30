<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Backend\Module;
use App\Models\Backend\Role;
use App\Models\User;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        if (Gate::allows('user-index')) {

            $users = User::latest()->get();
            return view('admin.user.index', compact('users'));
        }
        return abort(404);
    }
    public function create()
    {
        if (Gate::allows('user-store')) {
            $roles = Role::get();
            return view('admin.user.create', compact('roles'));
        }
        return abort(404);
    }

    public function store(Request $request, FlasherInterface $flasher)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role_id' => 'required|integer',
        ])->validate();

        User::create($validated);
        $flasher->addSuccess('User Created Successfully.');
        return redirect()->route('user.index');
    }

    public function edit(User $user)
    {
        if (Gate::allows('user-edit')) {
            $roles = Role::get();

            return view('admin.user.edit', compact('user', 'roles'));
        }
        return abort(404);
    }

    public function update(Request $request, User $user, FlasherInterface $flasher)
    {

        $validated = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required',
            'password' => 'required',
            'role_id' => 'required|integer',
        ])->validate();

        $user->update($validated);
        $flasher->addSuccess('user Updated Successfully.');
        return redirect()->route('user.index');
    }

    public function destroy(User $user, FlasherInterface $flasher)
    {
        if (Gate::allows('user-delete')) {
            $user->delete();
            $flasher->addSuccess('user Deleted Successfully.');
            return back();
        }
        return abort(404);
    }

    public function userStatus(Request $request, FlasherInterface $flasher)
    {
        if ($request->ajax()) {
            $user = User::findOrFail($request->user_id);

            if ($user->status == 1) {
                $user->status = false;
            } else {
                $user->status = true;
            }
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Status Successfully Update'
            ]);
        }
    }
}
