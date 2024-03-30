<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit()
    {
        $user = auth()->user();
        return view('admin.profile.edit', compact('user'));
    }

    public function update(Request $request, FlasherInterface $flasher)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'nullable',
            'email' => 'nullable|email',
            'image' => 'nullable|image'
        ])->validate();


        $user = auth()->user();
        $this->imageUpload($request, $user);
        $user->update($validated);
        $flasher->addSuccess('Profile Updated Successfully.');
        return back();
    }

    private function imageUpload($request, $user)
    {
        $path = 'admin/img/profile/';
        $image = $request->file('image');
        $name = $user->id . '.' . $image->getClientOriginalExtension();
        $save_path = $path . $name;

        Image::make($image)->resize(300, 300)->save(public_path($save_path));
        $user->image = $name;
        $user->save();
    }



    // /**
    //  * Update the user's profile information.
    //  */
    // public function update(ProfileUpdateRequest $request): RedirectResponse
    // {
    //     $request->user()->fill($request->validated());

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     $request->user()->save();

    //     return Redirect::route('profile.edit')->with('status', 'profile-updated');
    // }

    // /**
    //  * Delete the user's account.
    //  */
    // public function destroy(Request $request): RedirectResponse
    // {
    //     $request->validateWithBag('userDeletion', [
    //         'password' => ['required', 'current_password'],
    //     ]);

    //     $user = $request->user();

    //     Auth::logout();

    //     $user->delete();

    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return Redirect::to('/');
    // }
}
