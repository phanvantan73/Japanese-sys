@extends('adminlte::page')

@section('content_header')
    <h1>
        Quản lý khóa học
        <small>Chỉnh sửa</small>
    </h1>
    {{ Breadcrumbs::render('courses.edit', $course) }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Chỉnh sửa khóa học</h3>
                    <a href="{{ route('courses.index') }}" class="btn btn-primary pull-right">
                        <i class="fa fa-fw fa-arrow-circle-left"></i>
                        Về danh sách
                    </a>
                </div>
                <form action="{{ route('courses.update', $course->id) }}" role="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="box-body">
                        <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">Tên</label>
                            <input type="text" class="form-control" name="name" value="{{ $course->name }}">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="description">Mô tả</label>
                            <textarea class="form-control" rows="5" name="description">{{ $course->description }}</textarea>
                            @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
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
