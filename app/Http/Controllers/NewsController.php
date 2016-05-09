<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests;
use App\News;

class NewsController extends Controller
{
    public function getIndex()
    {
        $news = News::all();
        $i = 1;

        return view('admin.news.list', compact('news', 'i'));
    }


    public function getAdd()
    {
        $categories = Category::select('id', 'name', 'parent_id')->get();
        return view('admin.news.add', compact('categories'));
    }

    public function postAdd(Requests\NewsRequest $request)
    {
        $file = $request->file('image');
        $image = $file->getClientOriginalName();

        News::create([
            'title' => $request->title,
            'author' => \Auth::user()->name,
            'intro' => $request->intro,
            'full' => $request->full,
            'image' => $image,
            'status' => $request->status,
            'category_id' => $request->cate,
            'user_id' => \Auth::user()->id,
        ]);

        $file->move('upload/', $image);

        return redirect()->route('getNewsIndex')
            ->with('message', 'Thêm thành công!')
            ->with('level', 'success');
    }

    public function getEdit($id)
    {
        $news = News::find($id);
        $user = \Auth::user();
        if ($user->role->name == 'User' && $user->id != $news->user_id) {
            return redirect()->route('getNewsIndex')
                ->with('level', 'warning')
                ->with('message', 'Sửa thất bại<br>Bài viết này không do bạn tạo!');
        }
        $cate_parent = Category::select('id', 'name', 'parent_id')->where('id', '!=', $id)->get();

        return view('admin.news.edit', compact('news', 'cate_parent'));
    }

    public function postEdit($id, Requests\NewsRequest $request)
    {

        $news = News::find($id);
        $file = $request->file('image');
        if (!empty($file)) {
            $old_image = $news->image;
            \File::delete('upload/' . $old_image);

            $image = $file->getClientOriginalName();
            $file->move('upload/', $image);
            $news->image = $image;
        }

        $news->title = $request->title;
        $news->intro = $request->intro;
        $news->full = $request->full;
        $news->status = $request->status;
        $news->category_id = $request->cate;
        $news->save();

        return redirect()->route('getNewsIndex')
            ->withInput()
            ->with('message', 'Cập nhật thành công!')
            ->with('level', 'success');
    }

    public function getDelete($id)
    {
        $news = News::find($id);
        $user = \Auth::user();
//      Root can delete
        if ($user->role->name == 'Root' || $user->id == $news->user_id) {
            \File::delete('upload/' . $news->image);
            $news->delete();

            return redirect()->route('getNewsIndex')
                ->with('level', 'success')
                ->with('message', 'Xóa thành công!');
        }
        return redirect()->route('getNewsIndex')
            ->with('level', 'warning')
            ->with('message', 'Xóa thất bại<br>Bài viết này không do bạn tạo!');
    }
}
