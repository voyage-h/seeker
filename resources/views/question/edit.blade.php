@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">修改问题</div>

                <div class="card-body">
                    <form method="post" action="/question/{{ $question->id }}">
                    {{method_field('PATCH')}}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="form-group">
                        <label for="question">问题</label>
                        <input type="text" name="title" class="form-control" id="question" value="{{ old('title') ?? $question->title }}">
                        @if ($errors->has('title'))
                        <p class="alert alert-danger">{{ $errors->first('title') }}</p>
                        @endif
                      </div>
                      <div class="form-group">
                        <label for="description">问题描述</label>
                        <textarea class="form-control" name="description" id="description" rows="12">{{old('description') ?? $question->description }}</textarea>
                        @if ($errors->has('description'))
                            <p class="alert alert-danger">{{ $errors->first('description') }}</p>
                        @endif
                      </div>
                      <div class="form-group">
                        <label for="Label">标签</label>
                        <input type="text" class="form-control" name="labels" id="labels" value="{{ old('labels') ?? implode(array_column($question->labels->toArray(),'name'),' ') }}" placeholder="多个标签用空格分隔">
                       @if ($errors->has('labels'))
                       <p class="alert alert-danger">{{ $errors->first('labels') }}</p>
                       @endif
                      </div>
                      <button type="submit" class="btn btn-primary">提交</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
