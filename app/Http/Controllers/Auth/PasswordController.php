<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate(
            [
                'current_password' => ['required', 'current_password'],
                'password' => ['required', Password::defaults(), 'confirmed'],
            ],
            [
                'current_password.required' => 'Mật khẩu hiện tại không được để trống.',
                'current_password.current_password' => 'Mật khẩu hiện tại không đúng.',

                'password.required' => 'Mật khẩu mới không được để trống.',
                'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
                'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
                'password.mixedCase' => 'Mật khẩu phải chứa ít nhất một chữ hoa và một chữ thường.',
                'password.letters' => 'Mật khẩu phải chứa ít nhất một chữ cái.',
                'password.numbers' => 'Mật khẩu phải chứa ít nhất một chữ số.',
                'password.symbols' => 'Mật khẩu phải chứa ít nhất một ký tự đặc biệt.',
            ],
        );
        $request->user()->update([
            'cus_pass' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'Cập nhập mật khẩu mới thành công');
    }
}
