@extends('layouts.master')

@section('title', '文章編輯')

@section('test')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    編輯：{{ $post->title }}
                </div>
                <div class="card-body">
                    <div class="container-fiuld">
                        <form action="{{ route('posts.update', ['id' => $post->id]) }}" method="POST" class="mt-2">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="form-group row">
                                <label for="title" class="col-sm-2 col-form-label-sm text-md-right">標題</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-sm" name="title" id="title" value="{{ $post->title ?? '' }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="type" class="col-sm-2 col-form-label-sm text-md-right">分類</label>
                                <div class="col-sm-8">
                                    <select name="type" id="type" class="form-control form-control-sm">
                                        <option value="0">請選擇...</option>
                                        @foreach($post_types as $post_type)
                                            <option value="{{ $post_type->id }}" {{ ($post->type == $post_type->id)?"selected":"" }}>
                                                {{ $post_type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @isset($post_tags)
                                <div class="form-group row">
                                    <label for="type" class="col-sm-2 col-form-label-sm text-md-right">Tags</label>
                                    <div class="col-sm-8">
                                        <select name="tags[]" title="請選擇..."  class="form-control form-control-sm selectpicker {{ $errors->has('type') ? ' is-invalid' : '' }}" multiple>
                                            @foreach($post_tags as $tag) 
                                              <option value="{{ $tag->id }}" {{ ($post->tags->contains($tag->id)) ? 'selected':'' }}>{{ $tag->name }}</option>
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
                                    <textarea name="content" id="content" rows="15" class="form-control form-control-sm" style="resize: vertical;">{{ $post->content ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10 offset-sm-2">
                                    <button type="submit" class="btn btn-md btn-primary">儲存</button>
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