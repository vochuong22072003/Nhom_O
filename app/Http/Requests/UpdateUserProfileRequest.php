<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UpdateUserProfileRequest extends FormRequest
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
        $rules = [
            'name' => 'required|min:2|max:80|string|regex:/^[^\d]+$/|regex:/^[^<>&]*$/',
            'phone' => 'required|string|regex:/^0[0-9]{9}$/|regex:/^[^<>&]*$/',
            'image' => 'nullable|regex:/^[^<>&]*$/',
            'address' => 'nullable|regex:/^[^<>&]*$/',
            'user_catalogue_id' => [
                'required',
                'integer',
                'gt:0',

                function ($attribute, $value, $fail) {

                    $user_logged = Auth::guard('web')->user();
                    $exists = User::where('user_catalogue_id', 1);
                    if ($user_logged->user_catalogue_id == 1 && $value != 1) {
                        $fail('Bạn đang là Quản Trị Viên, nếu bạn muốn chuyển đổi chức vụ vui lòng liên hệ admin sđt: 0333444555.');
                    } elseif ($user_logged->user_catalogue_id != 1 && $value == 1 && $exists) {
                        $fail('Nhóm quản trị viên này đã có người đảm nhận.');
                    }
                },
            ],
            'description' => 'nullable|regex:/^[^<>&]*$/',
            'oldpassword' => [
                'required',
                'regex:/^[^<>&]*$/',
                function ($attribute, $value, $fail) {
                    $user = Auth::guard('web')->user();
                    if (!Hash::check($value, $user->password)) {
                        $fail('Mật khẩu cũ không đúng.');
                    }
                },
            ],
        ];

        $password = request('password');
        if ($password != '') {
            $rules['password'] = [
                'required',
                'string',
                'min:5',
                'max:50',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[^\w<>&]/',
                'regex:/^(?!.*[<>&]).*$/',
            ];

            $rules['repassword'] = [
                'required',
                'same:password',
                'regex:/^(?!.*[<>&]).*$/',
            ];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Bạn chưa nhập họ tên',
            'name.min' => 'Tên phải nhập tổi thiểu từ 2 ký tự trở lên',
            'name.max' => 'Tên không được nhập quá 80 ký tự',
            'name.string' => 'Tên phải là dạng ký tự',
            'name.regex' => 'Tên không được chứa ký tự số và không được chứa ký tự <, >, &',
            'phone.required' => 'Bạn chưa nhập số điện thoại',
            'phone.regex' => 'Số điện không hợp lệ vui lòng nhập theo định dạng: 0xxxxxxxxx và không được chứa ký tự <, >, &',
            'oldpassword.required' => 'Vui lòng nhập lại mật khẩu cũ để xác thực người sửa đổi thông tin chính là bạn',
            'oldpassword.regex' => 'mật khẩu cũ không được chứa ký tự <, >, &',
            'password.required' => 'Bạn chưa nhập vào mật khẩu mới hoặc bạn đang nhập ký tự khoảng trắng',
            'password.string' => 'Mật khẩu phải là dạng ký tự',
            'password.min' => 'Độ dài mật khẩu mới tối thiểu 5 ký tự',
            'password.max' => 'Độ dài mật khẩu mới tối đa 50 ký tự',
            'password.regex' => 'Mật khẩu mới không được chứa ký tự <, >, &, có ít nhật 1 chữ thường, 1 chữ HOA và 1 chữ số cũng như 1 ký tự đặc biệt',
            'repassword.required' => 'Bạn chưa nhập lại mật khẩu mới hoặc bạn đang nhập ký tự khoảng trắng',
            'repassword.regex' => 'Mật khẩu mới không được chứa ký tự <, >, &, có ít nhật 1 chữ thường, 1 chữ HOA và 1 chữ số cũng như 1 ký tự đặc biệt',
            'repassword.same' => 'Mật khẩu nhập lại không khớp',
            'image.regex' => 'Đường dẫn ảnh đại diện không được chứa ký tự <, >, &',
            'address.regex' => 'Địa chỉ không được chứa ký tự <, >, &',
            'description.regex' => 'Ghi chú không được chứa ký tự <, >, &'
        ];
    }
}
