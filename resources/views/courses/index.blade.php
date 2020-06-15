@extends('adminlte::page')

@section('content_header')
    <h1>Quản lý khóa học</h1>
    {{ Breadcrumbs::render('courses') }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Quản lý khóa học</h3>
                    <a class="btn btn-primary pull-right" title="Thêm mới" href="{{ route('courses.create') }}">
                        <i class="fa fa-fw fa-plus-square"></i>
                        Thêm mới
                    </a>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped text-center">
                        <tbody>
                            <tr>
                                <th style="width: 10px;">#</th>
                                <th>Tên</th>
                                <th>Mô tả</th>
                                <th>Ngày tạo</th>
                                <th>Ngày cập nhật cuối cùng</th>
                                <th>Hành động</th>
                            </tr>
                            @foreach ($courses as $course)
                                <tr>
                                    <td style="vertical-align: middle;">{{ $loop->iteration }}</td>
                                    <td style="vertical-align: middle;">{{ $course->name }}</td>
                                    <td style="vertical-align: middle;">{{ $course->description }}</td>
                                    <td style="vertical-align: middle;">{{ $course->created_at }}</td>
                                    <td style="vertical-align: middle;">{{ $course->updated_at }}</td>
                                    <td style="vertical-align: middle;">
                                        <div class="btn-group">
                                            <a class="btn" title="Chỉnh sửa" href="{{ route('courses.edit', $course->id) }}">
                                                <i class="fa fa-fw fa-edit"></i>
                                            </a>
                                            <form action="{{ route('courses.destroy', $course->id)}}" method="post">
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
