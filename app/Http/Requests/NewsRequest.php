<?php

namespace project2\Http\Requests;

class NewsRequest extends Request
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
        $actionName = \Request::route()->getName();
        if ($actionName == 'postNewsAdd') {
            return [
                'cate' => 'exists:categories,id',
                'title' => 'required|max:255|unique:news,title',
                'intro' => 'required',
                'full' => 'required',
                'image' => 'required|image',
            ];
        } elseif ($actionName == 'postNewsEdit') {
            return [
                'cate' => 'exists:categories,id',
                'title' => 'required|max:255|unique:news,title,' . $this->id,
                'intro' => 'required',
                'full' => 'required',
                'image' => 'image',
            ];
        }
    }
}
