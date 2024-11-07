<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
            'userInfo' => Auth::guard('customer')->user()->customerInfo(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // $validated = $request->validate([
        //     'cus_user' => [
        //         'required',
        //         'string',
        //         'min:3',
        //         'max:20',
        //         'regex:/^[a-zA-Z0-9._]+$/',
        //         'not_regex:/^[._]|[._]$/',
        //         'unique:customers,cus_user',
        //     ],
        //     'email' => [
        //         'required',
        //         'email',
        //         'unique:customers,email',
        //     ],
        //     'password' => [
        //         'required',
        //         'string',
        //         'min:8',
        //         'regex:/[A-Z]/',
        //         'regex:/[a-z]/',
        //         'regex:/[0-9]/', 
        //         'regex:/[@$!%*?&]/',
        //         'different:customers',
        //     ],
        // ]);

        $request->user()->fill($request->validated());
        $request->user()->update([
            'cus_user' => $request->cus_user,
        ]);

        // if ($request->user()->isDirty('email')) {
        //     $request->user()->verified_at = null;
        // }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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

        Auth::guard('customers')->logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
