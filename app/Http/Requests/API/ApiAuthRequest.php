<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiAuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|regex:/^[^<>&]*$/',
            'token' => 'required|regex:/^[^<>&]*$/',
            'roleAccount' => 'gt:0',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'=>'* Bạn chưa nhập email.',
            'email.email'=>'* Email chưa đúng định dạng. VD: abc@gmail.com',
            'password.required'=>'* Bạn chưa nhập vào mật khẩu',
            'password.regex' => '* Mật khẩu không được chứa ký tự <, >, &',
            'token.required'=>'* Bạn chưa nhập token',
            'token.regex' => '* Token không được chứa ký tự <, >, &',
            'roleAccount.gt'=>'* Bạn chưa chọn loại tài khoản',
        ];
    }
}
