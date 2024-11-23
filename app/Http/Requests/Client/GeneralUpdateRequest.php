<?php

namespace App\Http\Requests\Client;

use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GeneralUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'cus_user' => ['required', 'string', 'min:3', 'max:255',
            Rule::unique(Customer::class)->ignore($this->user()->cus_id, 'cus_id')],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:100', Rule::unique(Customer::class)->ignore($this->user()->cus_id, 'cus_id')],
        ];
    }

    public function messages(): array
    {
        return [
            'cus_user.required' => 'Không được bỏ trống username.',
            'cus_user.string' => 'Username phải là kiểu chuỗi',
            'cus_user.min' => 'Độ dài username phải dài tối tiểu 3 ký tự.',
            'cus_user.max' => 'Độ dài username phải dài tối đa 255 ký tự.',
            'cus_user.unique' => 'Username đã tồn tại.',
            
            'email.required' => 'Email is required.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã tồn tại.',
        ];
    }
}
