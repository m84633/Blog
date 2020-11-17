@extends('admin.layouts.master')
@section('title','首頁')
@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><b>文章列表</b></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      @foreach($posts as $post)
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{!! htmlspecialchars($post->title) !!}</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>

          </div>
        </div>
        <div class="card-body" overflow: hidden;>
          {!! $post->content !!}
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      @endforeach
      <!-- /.card -->

    </section>
    <!-- /.content -->
     {{ $posts->links() }}
  </div>
  
  @endsection
