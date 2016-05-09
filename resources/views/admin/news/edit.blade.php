@extends('admin.master')
@section('controller','Tin tức')
@section('action','Chỉnh sửa')
@section('content')

    <form action="" method="POST" enctype="multipart/form-data">
        @include('admin.partials.vali_msg')
        <div class="col-lg-7" style="padding-bottom:120px">
            <div class="form-group">
                <label>Tên danh mục</label>
                <select class="form-control" name="cate">
                    <option value="0">Chọn danh mục</option>
                    <?php cate($cate_parent, 0, '', $news->category_id) ?>
                </select>
            </div>
            <div class="form-group">
                <label>Tiêu đề tin</label>
                <input class="form-control" name="title" placeholder="Tiêu đề"
                       value="{{ old('title', $news->title) }}"/>
            </div>
            <div class="form-group">
                <label>Trích dẫn</label>
                <textarea class="form-control" rows="3" name="intro">{{ old('intro', $news->intro) }}</textarea>
                <script type="text/javascript">ckeditor('intro')</script>
            </div>
            <div class="form-group">
                <label>Nội dung tin</label>
                <textarea class="form-control" rows="6" name="full">{{ old('full', $news->full) }}</textarea>
                <script type="text/javascript">ckeditor('full')</script>
            </div>
            <div class="form-group">
                <label>Hình hiện tại</label>
                <img src="{!! asset('upload/'.$news->image)!!}" alt="{{ $news->title }}"
                     class="img-responsive img-thumbnail img-thumbnail-current"
                     style="height: auto;width: 300px;">
            </div>
            <div class="form-group">
                <label>Hình đại diện</label>
                <input type="file" name="image" value="">
            </div>
            <div class="form-group">
                <label>Công bố tin</label>
                <label class="radio-inline">
                    <input name="status" value="1" {{ ($news->status == 1)?'checked':'' }} type="radio">Có
                </label>
                <label class="radio-inline">
                    <input name="status" value="0" {{ ($news->status == 0)?'checked':'' }} type="radio">Không
                </label>
            </div>
            <button type="submit" class="btn btn-default">Cập nhật</button>
            {{ csrf_field() }}
        </div>
    </form>
@endsection