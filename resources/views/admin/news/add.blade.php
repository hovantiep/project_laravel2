@extends('admin.master')
@section('controller','Tin tức')
@section('action','Thêm mới')
@section('content')

    <form action="" method="POST" enctype="multipart/form-data">
        @include('admin.partials.vali_msg')
        <div class="col-lg-7" style="padding-bottom:120px">
            <div class="form-group">
                <label>Tên danh mục</label>
                <select class="form-control" name="cate">
                    <option value="0">Chọn danh mục</option>
                    <?php cate($categories,0,'',old('cate')) ?>
                </select>
            </div>
            <div class="form-group">
                <label>Tiêu đề tin</label>
                <input class="form-control" name="title" placeholder="Tiêu đề"
                       value="{{ old('title') }}"/>
            </div>
            <div class="form-group">
                <label>Trích dẫn</label>
                <textarea class="form-control" rows="3" name="intro">{{ old('intro') }}</textarea>
                <script type="text/javascript">ckeditor('intro')</script>
            </div>
            <div class="form-group">
                <label>Nội dung tin</label>
                <textarea class="form-control" rows="6" name="full">{{ old('full') }}</textarea>
                <script type="text/javascript">ckeditor('full')</script>
            </div>
            <div class="form-group">
                <label>Hình đại diện</label>
                <input type="file" name="image">
            </div>
            <div class="form-group">
                <label>Công bố tin</label>
                <label class="radio-inline">
                    <input name="status" value="1" checked type="radio">Có
                </label>
                <label class="radio-inline">
                    <input name="status" value="0" type="radio">Không
                </label>
            </div>
            <button type="submit" class="btn btn-default">Thêm tin</button>
            <button type="reset" class="btn btn-default">Làm lại</button>
            {{ csrf_field() }}
        </div>
    </form>
@endsection