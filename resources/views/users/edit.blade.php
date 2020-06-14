@extends('adminlte::page')

@section('content_header')
    <h1>
        Quản lý người dùng
        <small>Chỉnh sửa</small>
    </h1>
    {{ Breadcrumbs::render('users.edit', $user) }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Chỉnh sửa người dùng</h3>
                    <a href="{{ route('users.index') }}" class="btn btn-primary pull-right">
                        <i class="fa fa-fw fa-arrow-circle-left"></i>
                        Về danh sách
                    </a>
                </div>
                <form action="{{ route('users.update', $user->id) }}" role="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" value="{{ $user->id }}" name="id">
                    <div class="box-body">
                        <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">Tên</label>
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('birthday') ? 'has-error' : '' }}">
                            <label for="birthday">Ngày sinh</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right datepicker" name="birthday" value="{{ $user->birthday }}">
                                @if ($errors->has('birthday'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('birthday') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('address') ? 'has-error' : '' }}">
                            <label for="address">Địa chỉ</label>
                            <textarea class="form-control" rows="3" name="address">{{ $user->address }}</textarea>
                            @if ($errors->has('address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });
    </script>
@stop
