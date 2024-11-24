<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\GeneralUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AccountController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(): View
    {
        return view('client.account-setting-partials.general');
    }

    /**
     * Display the user's profile form.
     */
    public function changePassword(Request $request): View
    {
        // return view('profile.edit', [
        //     'user' => $request->user(),
        //     'userInfo' => Auth::guard('customers')->user()->customerInfo(),
        // ]);
        return view('client.account-setting-partials.change-password');
    }

    /**
     * Update the user's profile information.
     */
    public function update(GeneralUpdateRequest $request): RedirectResponse
    {
        $request->merge(['cus_user' => strtolower($request->input('cus_user'))]);

        $request->user()->update($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->verify_at = null;
        }

      return Redirect::route('setting.general')->with('success', 'Cập nhập thành công');
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
