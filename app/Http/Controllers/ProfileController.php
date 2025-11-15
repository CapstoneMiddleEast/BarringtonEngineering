<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ProfileController extends Controller
{
    //View user profile
    public function view(Request $request): View
    {
        return view('profile.view', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
        session()->flash('type', 'success');
        session()->flash('message', 'Your profile updated successfully!');
        return redirect()->route('profile.view');

        //return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }


    /**
     * Display the user's password form.
     */
    public function password(Request $request): View
    {
        return view('profile.password', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Display the user's picture page.
     */
    public function picture(Request $request): View
    {
        return view('profile.picture', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Display the user's picture page.
     */
    public function upload(Request $request)
    {
        $validater = Validator::make($request->all(), [
            'profile_picture' =>
            'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validater->passes()) {

            if ($request->user()->profile_picture) {
                Storage::delete($request->user()->profile_picture);
            }

            $path = $request->file('profile_picture')->store('profile_pictures', 'public');

            $request->user()->profile_picture = $path;
            $request->user()->save();
            return redirect()->route('profile.view');
        } else {
            return redirect()->route('profile.picture')->withInput()->withErrors($validater);
        }
    }

    /**
     * Display the user's delete page.
     */
    public function delete(Request $request): View
    {
        return view('profile.delete', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
