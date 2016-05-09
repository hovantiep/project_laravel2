<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
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
//        dd(\Route::getCurrentRoute()->getActionName());
        $actionName = \Request::route()->getName();
        if ($actionName == 'postUserAdd') {
            return [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $this->id,
                'password' => 'required|min:6|confirmed',
                'role_id' => 'exists:roles,id',
            ];
        }elseif ($actionName == 'postUserEdit'){
            return [
                'name' => 'required|max:255',
                'role_id' => 'exists:roles,id',
            ];
        }
    }

    public function messages(){
        return [
            'name.required' => 'Chưa nhập tên',
            'name.max' => 'Tên tối đa 255',
            'email.required' => 'Chưa nhập email',
            'email.max' => 'Email tối đa 255',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu ít nhất 6 ký tự',
            'password.confirmed' => 'Mật khẩu xác nhận chưa đúng',
            'role_id.exists' => 'Chưa chọn quyền hoặc chưa đúng',
        ];
    }
}
