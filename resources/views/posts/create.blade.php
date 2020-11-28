@extends('layouts.master')

@section('title', '新增文章')

@section('test')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">新增文章</div>
                <div class="card-body">
                    <div class="container-fluid">
                        <form action="{{ route('posts.store') }}" method="POST" class="mt-2">
                            @csrf
                            <div class="form-group row">
                                <label for="title" class="col-sm-2 col-form-label-sm text-md-right">標題</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-sm {{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" id="title" value="{{ old('title') }}">
                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="type" class="col-sm-2 col-form-label-sm text-md-right">分類</label>
                                <div class="col-sm-8">
                                    <select name="type" id="type" class="form-control form-control-sm {{ $errors->has('type') ? ' is-invalid' : '' }}" >
                                        <option value="">請選擇...</option>
                                        @foreach($post_types as $post_type)
                                            <option value="{{ $post_type->id }}" {{ ($post_type->id== old('type')) ? 'selected' : '' }} >
                                                {{ $post_type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('type'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @isset($post_tags)
                            <div class="form-group row">
                                <label for="type" class="col-sm-2 col-form-label-sm text-md-right">Tags</label>
                                <div class="col-sm-8">
                                    <select name="tags[]" title="請選擇..."  class="form-control form-control-sm selectpicker {{ $errors->has('type') ? ' is-invalid' : '' }}" multiple>
                                        @foreach($post_tags as $tag) 
                                          <option value="{{ $tag->id }}" @if(old('tags')){{ in_array($tag->id,old('tags'))? 'selected' : '' }}@endif>{{ $tag->name }}</option>
                                        @endforeach  
                                    </select>
                                    @if ($errors->has('tags'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('tags') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @endisset
                            <div class="form-group row">
                                <label for="content" class="col-sm-2 col-form-label-sm text-md-right">內文</label>
                                <div class="col-sm-8">
                                    <textarea name="content" id="content" rows="15" class="form-control form-control-sm {{ $errors->has('content') ? ' is-invalid' : '' }}"  style="resize: vertical;">{{ old('content') }}</textarea>
                                    @if ($errors->has('content'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('content') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10 offset-sm-2">
                                    <button class="btn btn-md btn-primary">儲存</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop