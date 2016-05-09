@extends('admin.master')
@section('controller','Thành viên')
@section('action','Chỉnh sửa')
@section('content')
    <form class="form-horizontal" role="form" method="POST" action="">
        <div class="col-lg-7" style="padding-bottom:120px">
            {!! csrf_field() !!}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Tên</label>

                <div class="col-md-6">
                    <input type="text" class="form-control" name="name" value="{{ old('name',$user->name) }}">

                    @if ($errors->has('name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Địa chỉ email</label>

                <div class="col-md-6">
                    <input type="email" class="form-control " name="email" disabled
                           value="{{ old('email',$user->email) }}">

                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Quyền</label>

                <div class="col-md-6">
                    <select name="role_id" class="form-control" {{ ($user->id == 1) ? 'disabled' : '' }}>
                        <option value="0">-- Chọn quyền --</option>
                        @foreach($roles as $item)
                            @if($user->role_id == $item->id)
                                <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                            @else
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @if ($errors->has('role_id'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('role_id') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-default">Lưu</button>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label class="control-label">Danh mục có thể truy cập</label>
                <select name="can[]" id="" class="form-control" multiple style="height: 200px;">
                    @foreach($categories as $item)
                        @if(in_array($item->id, $can))
                            <option selected value="{{ $item->id }}">{{ $item->name }}</option>
                        @else
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
    </form>

@endsection
