@extends('admin.master')
@section('controller','Danh mục')
@section('action','Thêm mới')
@section('content')

    <div class="col-lg-7" style="padding-bottom:120px">
        @include('admin.partials.vali_msg')
        <form action="" method="POST">
            <div class="form-group">
                <label>Danh mục cha</label>
                <select class="form-control" name="cateParent">
                    <option value="0">Chọn danh mục</option>
                    <option value="1">Danh mục 1</option>
                    <option value="2">Danh mục 2</option>
                    <?php cate($cate_parent); ?>
                </select>
            </div>
            <div class="form-group">
                <label>Tên danh mục</label>
                <input class="form-control" name="cateName" placeholder="Tên danh mục"
                       value="{{ old('cateName') }}"/>
            </div>
            <button type="submit" class="btn btn-default">Thêm</button>
            <button type="reset" class="btn btn-default">Làm lại</button>
            {{ csrf_field() }}
        </form>
    </div>

@endsection
