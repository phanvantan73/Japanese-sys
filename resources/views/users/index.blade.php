@extends('adminlte::page')

@section('content_header')
    <h1>Quản lý người dùng</h1>
    {{ Breadcrumbs::render('users') }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Quản lý người dùng</h3>
                    <a class="btn btn-primary pull-right" title="Thêm mới" href="{{ route('users.create') }}">
                        <i class="fa fa-fw fa-plus-square"></i>
                        Thêm mới
                    </a>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped text-center">
                        <tbody>
                            <tr>
                                <th style="width: 10px;">#</th>
                                <th>Ảnh đại diện</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Ngày sinh</th>
                                <th>Số điện thoại</th>
                                <th>Hành động</th>
                            </tr>
                            @foreach ($users as $user)
                                <tr>
                                    <td style="vertical-align: middle;">{{ $loop->iteration }}</td>
                                    <td style="vertical-align: middle;">
                                        <div style="width: 82px; height: 82px;">
                                            <img src="{{ $user->avatar }}" alt="ảnh đại diện" style="border-radius: 50%; width: 100%; height: 100%;">
                                        </div>
                                    </td>
                                    <td style="vertical-align: middle;">{{ $user->name }}</td>
                                    <td style="vertical-align: middle;">{{ $user->email }}</td>
                                    <td style="vertical-align: middle;">{{ $user->birthday }}</td>
                                    <td style="vertical-align: middle;">{{ $user->phone }}</td>
                                    <td style="vertical-align: middle;">
                                        <div class="btn-group">
                                            <a class="btn" title="Chỉnh sửa" href="{{ route('users.edit', $user->id) }}">
                                                <i class="fa fa-fw fa-edit"></i>
                                            </a>
                                            <form action="{{ route('users.destroy', $user->id)}}" method="post">
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
