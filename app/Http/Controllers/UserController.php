<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests;
use App\Role;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {

    }

    public function getIndex()
    {
        $users = User::all();
        $i = 1;

        return view('admin.user.list', compact('users', 'i'));
    }

    public function getAdd()
    {
        $roles = Role::select('id', 'name')->where('name', '!=', 'Root')->get();
        $categories = Category::select('id', 'name')->get();

        return view('admin.user.add', compact('roles', 'categories'));
    }

//
    public function postAdd(Requests\UserRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
            'can' => json_encode($request->can),
        ]);

        return redirect()->route('getUserIndex')
            ->with('message', 'Thêm thành công!')
            ->with('level', 'success');
    }

    public function getEdit($id)
    {
        $user = User::find($id);
        $roles = Role::select('id', 'name')->get();
        $categories = Category::select('id', 'name')->get();
        $can = json_decode($user->can, true);

        return view('admin.user.edit', compact('user', 'roles', 'categories', 'can'));
    }

    public function postEdit($id, Requests\UserRequest $request)
    {
        $user = User::find($id);
        $user->name = $request->name;

//      disable input role_id
        if (isset($request->role_id)) {
            $user->role_id = $request->role_id;
            $user->can = json_encode($request->can);
        }
        $user->save();

        return redirect()->route('getUserIndex')
            ->withInput()
            ->with('message', 'Cập nhật thành công!')
            ->with('level', 'success');
    }

    public function getDelete($id)
    {
        if ($id != 1) {
            User::destroy($id);
            return redirect()->route('getUserIndex')
                ->with('message', 'Xóa thành công!');
        } else {
            return redirect()->route('getUserIndex')
                ->with('message', 'Xóa thất bại!<br>Đây là Root!')
                ->with('level', 'warning');
        }
    }
}
