@extends('admin.layouts.master')
@section('title','編輯')
@section('head')
  <link rel="stylesheet" href={{ asset('admin/plugins/select2/css/select2.min.css') }}>
  <link rel="stylesheet" href={{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}>
  <link rel="stylesheet" href={{ asset('admin/dist/css/adminlte.min.css') }}>	
  <script src={{ asset('admin/ckeditor/ckeditor.js') }}></script>
@endsection
@section('content')
<section class="content-header">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>修改文章</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">文章</a></li>
              <li class="breadcrumb-item active">編輯</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="offset-lg-1 col-lg-8">
            <!-- general form elements -->
            <div class="card card-secondary">
              <div class="card-header">
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form">
                <div class="card-body">
                	<div class="row">
		                  <div class="col-lg-6 form-group">
		                    <label for="exampleInputEmail1">標題</label>
		                    <input type="text" class="form-control" id="exampleInputEmail1" value="{{ $post->title }}">
		                  </div>
		                  <div class="col-lg-6 form-group">
		                    <label for="exampleInputPassword1">作者</label>
		                    <input type="text" class="form-control" id="exampleInputPassword1" value="{{ $post->user->name }}" >
		                  </div>
                    </div>
                <div class="form-group">
                  <label>類型</label>
                  <select class="form-control select2" style="width: 100%;">
                    <option >請選擇...</option>
                    @foreach($types as $type)
                    <option value="$type->id" @if($post->type == $type->id)selected @endif>{{ $type->name }}</option>
                    @endforeach
                    
                  </select>
                </div>
                  <div class="form-group">
                  <label>Tags</label>
                  <select class="select2" multiple="multiple" data-placeholder="請選擇..." style="width: 100%;">
                    @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" @foreach($post->tags as $ps)
                        @if($ps->id == $tag->id)
                          selected 
                        @endif
                      @endforeach >{{ $tag->name }}</option>
                    @endforeach
                  </select>
            	</div>
                    <div class="form-group">
                         <label>內容</label>
                         <textarea name="content">{{ $post->content }}</textarea>
                         <script>
                         CKEDITOR.replace( 'content' );
                        </script>
                    </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">送出</button>
                  <a class="ml-3 btn btn-primary" href={{ route('admin.posts.index') }} role="button">返回</a>
                </div>
              </form>
            </div>
            <!-- /.card -->

            
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
          <!-- right column -->
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
@section('footer')
<script src={{ asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}></script>
<script src={{ asset('admin/plugins/select2/js/select2.full.min.js') }}></script>
<script type="text/javascript">

</script>
<script>
$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    
  })
</script>
@endsection