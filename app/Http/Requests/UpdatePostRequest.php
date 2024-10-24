<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'post_name' => 'required|string|unique:posts,post_name, ' . $this->id . '',
            'post_catalogue_parent_id' => 'required|integer|gt:0',
        ];
    }

    public function messages(): array
    {
        return [
            'post_name.required' => 'Bạn chưa nhập tiêu đề bài viết',
            'post_name.string' => 'Tiêu đề bài viết phải là dạng ký tự',
            'post_name.unique' => 'Tên bài viết này đã tồn tại. Hãy nhập tên khác',
            'post_catalogue_parent_id' => 'Bạn chưa chọn nhóm bài viết cha',
        ];
    }
}
