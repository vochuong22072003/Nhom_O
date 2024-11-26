<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'search'=>'string|min:3|max:255|regex:/^[^<>&]*$/',
        ];
    }

    public function messages(): array
    {
        return [
            'search.min' => 'Bạn phải nhập ít nhất 3 ký tự',
            'search.max' => 'Từ khóa không được vượt quá 255 ký tự',
            'search.regex' => 'Vui lòng nhập từ khóa tìm kiếm hợp lệ và không chứa các kí tự đặc biệt',
        ];
    }
}
