@extends('adminlte::page')

@section('content_header')
    <h1>
        Quản lý khóa học
        <small>Thêm mới</small>
    </h1>
    {{ Breadcrumbs::render('courses.create') }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Tạo mới khóa học</h3>
                    <a href="{{ route('courses.index') }}" class="btn btn-primary pull-right">
                        <i class="fa fa-fw fa-arrow-circle-left"></i>
                        Về danh sách
                    </a>
                </div>
                <form action="{{ route('courses.store') }}" role="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">Tên</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="description">Mô tả</label>
                            <textarea class="form-control" rows="5" name="description"></textarea>
                            @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('image') ? 'has-error' : '' }}">
                            <label for="image">Ảnh mô tả</label>
                            <input type="file" name="image">
                            @if ($errors->has('image'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
