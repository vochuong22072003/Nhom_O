<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Contracts\Service\Attribute\Required;

class StorePostCatalogueParentRequest extends FormRequest
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
            'post_catalogue_parent_name' => 'required | string | unique:post_catalogue_parent| min: 2 | max: 255 | regex:/^[^<>&]*$/ ',
            'post_catalogue_parent_description' => 'nullable|string | regex:/^[^<>&]*$/ '
        ];
    }
    public function messages(): array
    {
        return [
            'post_catalogue_parent_name.required' => 'Bạn chưa nhập tên danh mục cha ',
            'post_catalogue_parent_name.string' => 'Tên danh mục cha phải là kí tự',
            'post_catalogue_parent_name.min' => 'Tên danh mục cha phải nhập tối thiểu 2 kí tự trở lên ',
            'post_catalogue_parent_name.max' => 'Tên danh mục cha không được nhập tối đa 255 kí tự  ',
            'post_catalogue_parent_name.regex' => 'Tên danh mục cha không được chứa các ký tự <, >, &',
            'post_catalogue_parent_description.regex' => 'Mô tả danh mục cha không được chứa các ký tự <, >, &',
            'post_catalogue_parent_description.string' => 'Mô tả danh mục cha phải là kí tự',

            'post_catalogue_parent_name.unique' =>  'Tên danh mục cha đã tồn tại, vui lòng chọn tên danh mục khác'
        ];
    }
}
