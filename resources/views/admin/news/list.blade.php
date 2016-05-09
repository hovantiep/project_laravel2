@extends('admin.master')
@section('controller','Tin tức')
@section('action','Danh sách')
@section('content')
    @include('admin.partials.alert_msg')
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
        <tr align="center">
            <th>STT</th>
            <th>Tiêu đề</th>
            <th>Tác giả</th>
            <th>Thời gian</th>
            <th>Xóa</th>
            <th>Sửa</th>
        </tr>
        </thead>
        <tbody>
        @foreach($news as $item)
            <tr class="odd gradeX" align="center">
                <td>{{ $i++ }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->author }}</td>
                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d / m / Y') }}</td>
                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a
                            onclick="return confirmDel('Bạn có chắc chắn xóa')"
                            href="{{ route('getNewsDelete',$item->id) }}"> Xóa</a></td>
                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a
                            href="{{ route('getNewsEdit',$item->id) }}"> Sửa</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection