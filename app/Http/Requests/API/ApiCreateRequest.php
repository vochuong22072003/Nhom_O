<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class ApiCreateRequest extends FormRequest
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
            'modelToken' => 'gt:0',
            'userIdToken' => [
                'required',
                function ($attribute, $value, $fail) {
                    $modelToken = request()->input('modelToken'); // Lấy giá trị modelToken từ request
                    // dd($modelToken);
                    if ($modelToken == 1) {
                        // Kiểm tra trong bảng users
                        if (!\DB::table('users')->where('id', $value)->whereNull('deleted_at')->exists()) {
                            $fail('* ID nhận token này không tồn tại trong bảng Users.');
                        }
                    } elseif ($modelToken == 2) {
                        // Kiểm tra trong bảng customers
                        if (!\DB::table('customers')->where('cus_id', $value)->whereNull('deleted_at')->exists()) {
                            $fail('* ID nhận token này không tồn tại trong bảng Customers.');
                        }
                    } else {
                        $fail('* Model không hợp lệ.');
                    }
                },
            ],
            'expiresAt' => 'gt:0',
            'abilities' => [
                'required',
                'array',
                function ($attribute, $value, $fail) {
                    if (in_array('0', $value)) {
                        $fail('* Không được chọn giá trị mặc định "Chọn option".');
                    }
                },
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'=>'* Bạn chưa nhập email.',
            'email.email'=>'* Email chưa đúng định dạng. VD: abc@gmail.com',
            'password.required'=>'* Bạn chưa nhập vào mật khẩu',
            'password.regex' => '* Mật khẩu không được chứa ký tự <, >, &',
            'modelToken.gt'=>'* Bạn chưa chọn model nhận token',
            'userIdToken.required'=>'* Bạn chưa nhập ID nhận token',
            'userIdToken.exists' => '* ID nhận token không tồn tại trong hệ thống.',
            'expiresAt.gt'=>'* Bạn chưa chọn thời hạn token',
            'abilities.required'=>'* Bạn chưa chọn khả năng token',
        ];
    }
}
