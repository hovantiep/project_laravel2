@extends('admin.master')
@section('controller','Danh mục')
@section('action','Chỉnh sửa')
@section('content')

    <div class="col-lg-7" style="padding-bottom:120px">
        @include('admin.partials.vali_msg')
        <form action="" method="POST">
            <div class="form-group">
                <label>Danh mục cha</label>
                <select class="form-control" name="cateParent">
                    <option value="0">Chọn danh mục</option>
                    <?php cate($cate_parent,0,"",$cate->parent_id) ?>
                </select>
            </div>
            <div class="form-group">
                <label>Tên danh mục</label>
                <input class="form-control" name="cateName" placeholder="Tên danh mục"
                       value="{{ $cate->name }}"/>
            </div>
            <button type="submit" class="btn btn-default">Cập nhật</button>
            {{ csrf_field() }}
        </form>
    </div>

@endsection
