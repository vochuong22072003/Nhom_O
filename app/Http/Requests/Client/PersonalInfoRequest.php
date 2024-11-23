<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PersonalInfoRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cus_name' => 'required|string|max:255',
            'birth_date' => 'nullable|date|date_format:d-m-Y|before_or_equal:today',
            'cus_phone' => 'nullable|regex:/^[0-9]{10,15}$/',
            'address' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[a-zA-Z0-9\s,.-]+$/',
            ],
            'gender' => 'required|in:Male,Female,Other',
            'cus_avt' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
        ];
    }
    public function messages(): array
    {
        return [
            'cus_name.string' => 'Tên hiển thị phải là một chuỗi ký tự.',
            'cus_name.max' => 'Tên hiển thị không được vượt quá 255 ký tự.',
            
            'birth_date.date' => 'Ngày sinh phải là một ngày hợp lệ.',
            'birth_date.date_format' => 'Ngày sinh phải có định dạng dd-mm-yyyy.',
            'birth_date.before_or_equal' => 'Ngày sinh không được sau ngày hiện tại.',
            
            'cus_phone.regex' => 'Số điện thoại sai định dạng.',
            
            'address.string' => 'Địa chỉ phải là một chuỗi ký tự.',
            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
            'address.regex' => 'Địa chỉ chỉ được chứa chữ, số, khoảng trắng, dấu phẩy, dấu chấm, và dấu gạch ngang.',
            
            'gender.required' => 'Giới tính là bắt buộc.',
            'gender.in' => 'Giới tính phải là một trong các giá trị: male, female, other.',
            
            'cus_avt.image' => 'Ảnh đại diện phải là một hình ảnh.',
            'cus_avt.mimes' => 'Ảnh đại diện phải có định dạng jpeg, png, jpg hoặc gif.',
            'cus_avt.max' => 'Ảnh đại diện không được vượt quá 5MB.',
        ];
    }
}
