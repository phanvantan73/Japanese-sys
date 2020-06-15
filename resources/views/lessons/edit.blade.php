@extends('adminlte::page')

@section('content_header')
    <h1>
        Quản lý bài học
        <small>Chỉnh sửa</small>
    </h1>
    {{ Breadcrumbs::render('lessons.edit', $lesson) }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Chỉnh sửa bài học</h3>
                    <a href="{{ route('lessons.index') }}" class="btn btn-primary pull-right">
                        <i class="fa fa-fw fa-arrow-circle-left"></i>
                        Về danh sách
                    </a>
                </div>
                <form action="{{ route('lessons.update', $lesson->id) }}" role="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="box-body">
                        <div class="form-group">
                            <label for="course_id">Khóa học</label>
                            <select class="form-control select2" name="course_id">
                                @foreach ($courses as $id => $course)
                                    <option value="{{ $id }}" {{ $id == $lesson->course->id ? 'selected' : '' }}>{{ $course }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('course_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('course_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">Tên</label>
                            <input type="text" class="form-control" name="name" value="{{ $lesson->name }}">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('content') ? 'has-error' : '' }}">
                            <label for="content">Tiêu đề</label>
                            <input type="text" class="form-control" name="content" value="{{ $lesson->content }}">
                            @if ($errors->has('content'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('content') }}</strong>
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
        $('.select2').select2();
    </script>
@stop
