<?php

namespace App\Http\Requests;

class CategoryRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cateName' => 'required|unique:categories,name,' . $this->id,
        ];
    }

    public function messages()
    {
        return [
            'cateName.required' => 'Chưa nhập tên danh mục',
            'cateName.unique' => 'Danh mục này đã có',
        ];
    }
}
