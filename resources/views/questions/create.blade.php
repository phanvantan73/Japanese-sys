@extends('adminlte::page')

@section('content_header')
    <h1>
        Quản lý câu hỏi
        <small>Thêm mới</small>
    </h1>
    {{ Breadcrumbs::render('questions.create') }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Tạo mới câu hỏi</h3>
                    <a href="{{ route('questions.index') }}" class="btn btn-primary pull-right">
                        <i class="fa fa-fw fa-arrow-circle-left"></i>
                        Về danh sách
                    </a>
                </div>
                <form action="{{ route('questions.store') }}" role="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="lesson_id">Bài học</label>
                            <select class="form-control select2" name="lesson_id">
                                @foreach ($lessons as $id => $lesson)
                                    <option value="{{ $id }}">{{ $lesson }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('lesson_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('lesson_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label for="title">Tiêu đề</label>
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                            @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('content') ? 'has-error' : '' }}">
                            <label for="content">Nội dung</label>
                            <input type="text" class="form-control" name="content" value="{{ old('content') }}">
                            @if ($errors->has('content'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="type">Loại câu hỏi</label>
                            <select class="form-control select2" name="type">
                                @foreach ($questionTypes as $key => $type)
                                    <option value="{{ $key }}">{{ $type }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('type'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('type') }}</strong>
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

@section('js')
    <script>
        $('.select2').select2();
    </script>
@stop
