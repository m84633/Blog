@extends('admin.layouts.master')
@section('title','編輯')
@section('head')
  <link rel="stylesheet" href={{ asset('admin/plugins/select2/css/select2.min.css') }}>
  <link rel="stylesheet" href={{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}>
  <link rel="stylesheet" href={{ asset('admin/dist/css/adminlte.min.css') }}>	
@endsection
@section('content')
<section class="content-header">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>新增管理者</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">使用者</a></li>
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
              <form role="form" method="POST" action={{ route('admin.users.store') }} enctype="multipart/form-data">
                  @csrf

                <div class="card-body">
                    @include('message')
                	<div class="row">
		                  <div class="col-lg-6 form-group">
		                    <label for="exampleInputEmail1">名稱</label>
		                    <input name="name" type="text" class="form-control" id="exampleInputEmail1" value="">
		                  </div>
                      <div class="col-lg-6 form-group">
                        <label for="exampleInputEmail1">電子信箱</label>
                        <input name="email" type="email" class="form-control" id="exampleInputEmail1" value="">
                      </div>
		                  <div class="col-lg-6 form-group">
		                    <label for="exampleInputPassword1">密碼</label>
		                    <input name="password" type="password" class="form-control" id="exampleInputPassword1" value="">
		                  </div>
                      <div class="col-lg-6 form-group">
                        <label for="exampleInputPassword1">再次輸入密碼</label>
                        <input name="password_confirmation" type="password" class="form-control" id="exampleInputPassword1" value="">
                      </div>
                     <div class="col-lg-7 form-group">
                        <label>角色</label>
                        <select name="roles[]" class="select2" multiple="multiple" data-placeholder="請選擇..." style="width: 100%;">
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                             @endforeach
                        </select>
                      </div>
                    <div class="col-lg-7 form-group">
                      <label for="exampleInputFile">上傳大頭貼</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input name="avatar" type="file" class="custom-file-input" id="exampleInputFile">
                          <label class="custom-file-label" for="exampleInputFile"></label>
                        </div>

                      </div>
                    </div>
                    </div>
                
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">送出</button>
                  <a class="ml-3 btn btn-primary" href={{ route('admin.users.index') }} role="button">返回</a>
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
<script src={{ asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }} ></script>
<script type="text/javascript">
  $(document).ready(function () {
  bsCustomFileInput.init();
});
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