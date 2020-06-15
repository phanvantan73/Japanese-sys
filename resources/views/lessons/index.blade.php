@extends('adminlte::page')

@section('content_header')
    <h1>Quản lý bài học</h1>
    {{ Breadcrumbs::render('lessons') }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Quản lý bài học</h3>
                    <a class="btn btn-primary pull-right" title="Thêm mới" href="{{ route('lessons.create') }}">
                        <i class="fa fa-fw fa-plus-square"></i>
                        Thêm mới
                    </a>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped text-center">
                        <tbody>
                            <tr>
                                <th style="width: 10px;">#</th>
                                <th>Khóa học</th>
                                <th>Tên</th>
                                <th style="width: 40%;">Tiêu đề</th>
                                <th>Ngày tạo</th>
                                <th>Ngày cập nhật cuối cùng</th>
                                <th>Hành động</th>
                            </tr>
                            @foreach ($lessons as $lesson)
                                <tr>
                                    <td style="vertical-align: middle;">{{ $loop->iteration }}</td>
                                    <td style="vertical-align: middle;">{{ $lesson->course->name }}</td>
                                    <td style="vertical-align: middle;">{{ $lesson->name }}</td>
                                    <td style="vertical-align: middle;">{{ $lesson->content }}</td>
                                    <td style="vertical-align: middle;">{{ $lesson->created_at }}</td>
                                    <td style="vertical-align: middle;">{{ $lesson->updated_at }}</td>
                                    <td style="vertical-align: middle;">
                                        <div class="btn-group">
                                            <a class="btn" title="Chỉnh sửa" href="{{ route('lessons.edit', $lesson->id) }}">
                                                <i class="fa fa-fw fa-edit"></i>
                                            </a>
                                            <form action="{{ route('lessons.destroy', $lesson->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="Xóa" 
                                                    style="border: none; background-color: none; color: #3c8dbc;"
                                                >
                                                    <i class="fa fa-fw fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
