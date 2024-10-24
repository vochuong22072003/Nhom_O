<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'post_name' => 'required|string|unique:posts| min: 2 | max: 255 | regex:/^[^<>&]*$/',
            'post_catalogue_parent_id' => 'required|integer|gt:0',
            'post_content' => 'nullable|string|regex:/^(?!.*<script>).*/',
            'post_excerpt' => 'nullable|string|regex:/^(?!.*<script>).*/',
        ];
    }

    public function messages(): array
    {
        return [
            'post_name.required' => 'Bạn chưa nhập tiêu đề bài viết',
            'post_name.string' => 'Tiêu đề bài viết phải là dạng ký tự',
            'post_name.unique' => 'Tên bài viết này đã tồn tại. Hãy nhập tên khác',
            'post_catalogue_parent_id' => 'Bạn chưa chọn danh mục cha',
            'post_name.min' => 'Tiêu đề bài viết phải nhập tối thiểu 2 kí tự trở lên ',
            'post_name.max' => 'Tiêu đề bài viết không được nhập tối đa 255 kí tự  ',
            'post_name.regex' => 'Tiêu đề bài viết không được chứa các ký tự <, > ',

            'post_excerpt.regex' => 'Mô tả ngắn bài viết không được chứa các ký tự <, > ',
            'post_content.regex' => 'Nội dung bài viết không được chứa các ký tự <, > '  
        ];
    }
}
