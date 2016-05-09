@extends('admin.master')
@section('controller','Thành viên')
@section('action','Danh sách')
@section('content')
    @include('admin.partials.alert_msg')
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
        <tr align="center">
            <th>STT</th>
            <th>Tên</th>
            <th>Cấp độ</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $item)
            <tr class="odd gradeX" align="center">
                <td>{{ $i++ }}</td>
                <td>{{ $item->name }}</td>
                <td>
                    {{ $item->role->name }}
                </td>
                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a
                            onclick="return confirmDel('Bạn có chắc chắn xóa?')"
                            href="{{ route('getUserDelete',$item->id) }}"> Xóa</a></td>
                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{ route('getUserEdit',$item->id) }}">
                        Sửa</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
