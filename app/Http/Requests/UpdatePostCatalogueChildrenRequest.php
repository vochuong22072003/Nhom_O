<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostCatalogueChildrenRequest extends FormRequest
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
            'post_catalogue_children_name' => 'required | string | unique:post_catalogue_children,post_catalogue_children_name, ' . $this->id . ' | min: 2 | max: 255 | regex:/^[^<>&]*$/',
            'post_catalogue_children_description' => 'string | regex:/^[^<>&]*$/ ',
            'post_catalogue_parent_id' => 'exists:post_catalogue_parent,id'
        ];
    }
    public function messages(): array
    {
        return [
            'post_catalogue_children_name.required' => 'Bạn chưa nhập tên danh mục con ',
            'post_catalogue_children_name.string' => 'Tên danh mục con phải là kí tự',
            'post_catalogue_children_name.min' => 'Tên danh mục con phải nhập tối thiểu 2 kí tự trở lên ',
            'post_catalogue_children_name.max' => 'Tên danh mục con không được nhập tối đa 255 kí tự  ',
            'post_catalogue_children_name.regex' => 'Tên danh mục con không được chứa các ký tự <, >, & ',
            'post_catalogue_children_description.string' => 'Mô tả danh mục con phải là kí tự',
            'post_catalogue_children_description.regex' => 'Mô tả danh mục con không được chứa các ký tự <, >, & ',
            'post_catalogue_children_name.unique' =>  'Tên danh mục con đã tồn tại, vui lòng chọn tên danh mục khác',
            'post_catalogue_parent_id.exists' => 'Danh mục cha không tồn tại.'
        ];
    }
}
