@extends('admin.master')
@section('controller','Danh mục')
@section('action','Danh sách')
@section('content')

@include('admin.partials.alert_msg')
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
        <tr align="center">
            <th>STT</th>
            <th>Tên</th>
            <th>Xóa</th>
            <th>Sửa</th>
        </tr>
        </thead>
        <tbody>
        {{ show_cate($categories) }}
        {{--@foreach($categories as $item)
            <tr class="odd gradeX" align="center">
                <td>{{ $i++ }}</td>
                <td>{{ $item->name }}</td>
                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a
                            onclick="return confirmDel('Có chắc chắn xóa không?')"
                            href="{{ route('getCateDelete',$item->id) }}"> Xóa</a></td>
                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a
                            href="{{ route('getCateEdit',$item->id) }}"> Sửa</a></td>
            </tr>
        @endforeach--}}
        </tbody>
    </table>

@endsection