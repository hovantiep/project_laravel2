<?php

namespace project2\Http\Controllers;

use project2\Category;
use project2\Http\Requests;

class CategoryController extends Controller
{
    public function getIndex()
    {
        $categories = Category::all();
        $i = 1;

        return view('admin.cate.list', compact('categories', 'i'));
    }

    public function save($cate, $request)
    {
        $cate->name = $request->cateName;
        $cate->parent_id = $request->cateParent;
        $cate->save();
    }

    public function getAdd()
    {
        $cate_parent = Category::select('id', 'name', 'parent_id')->get();

        return view('admin.cate.add', compact('cate_parent'));
    }

    public function postAdd(Requests\CategoryRequest $request)
    {
        $cate = new Category();
        $this->save($cate, $request);

        return redirect()->route('getCateIndex')
            ->with('message', 'Thêm thành công!')
            ->with('level', 'success');
    }

    public function getEdit($id)
    {
        $cate = Category::find($id);
        $cate_parent = Category::select('id', 'name', 'parent_id')->where('id', '!=', $id)->get();

        return view('admin.cate.edit', compact('cate', 'cate_parent'));
    }

    public function postEdit($id, Requests\CategoryRequest $request)
    {
        $cate = Category::find($id);
        $this->save($cate, $request);

        return redirect()->route('getCateIndex')
            ->withInput()
            ->with('message', 'Cập nhật thành công!')
            ->with('level', 'success');
    }

    public function getDelete($id)
    {
        $hasCate_child = Category::select('id')->where('parent_id', $id)->groupBy('parent_id')->count();
        if ($hasCate_child == 0) {
            Category::destroy($id);
            return redirect()->route('getCateIndex')
                ->with('message', 'Xóa thành công!');
        } elseif ($hasCate_child > 0) {
            return redirect()->route('getCateIndex')
                ->with('message', 'Xóa thất bại!<br>Đây là danh mục cha, vui lòng xóa danh mục con trước!')
                ->with('level', 'warning');

        }

    }
}
