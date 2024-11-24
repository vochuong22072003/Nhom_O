<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'content' => 'required|string| min: 2 | max: 1000 | regex:/^[^<>&]*$/',
        ];
    }

    public function messages(): array
    {
        return [
            'content.required' => 'Bạn chưa nhập bình luận',
            'content.string' => 'Bình luận phải là dạng ký tự',
            'content.min' => 'Bình luận phải nhập tối thiểu 2 kí tự trở lên ',
            'content.max' => 'Bình luận không được nhập tối đa 1000 kí tự  ',
            'content.regex' => 'Bình luận không được chứa các ký tự <, >, & ',
        ];
    }
}
