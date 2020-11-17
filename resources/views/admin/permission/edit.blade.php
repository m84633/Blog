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
            <h1>新增許可</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">許可</a></li>
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
              <form role="form" method="POST" action={{ route('admin.permissions.store') }}>
                  @csrf
                <div class="card-body">

                    @if(count($errors)>0)
          @foreach($errors->all() as $error)
              <div class="row">
                <div class="offset-lg-2 col-lg-6">
                  <div style="padding: 0px" class="alert alert-danger fade show" role="alert">
                  <strong> {{ $error }}</strong> 
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                </div>
            </div>
          @endforeach
          @endif


                  <div class="row">
                      <div class="col-lg-6 form-group">
                        <label for="exampleInputEmail1">名稱</label>
                        <input name="name" type="text" class="form-control" id="exampleInputEmail1" value="{{ $permission->name }}">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6 form-group">
                        <label for="for">Permission for</label>
                        <select name="for" id="for" class="form-control">
                          <option disabled value="">請選擇...</option>
                          <option @if($permission->for == "user") selected @endif value="user">User</option>
                          <option @if($permission->for == "post") selected @endif value="post">Post</option>
                          <option @if($permission->for == "other") selected @endif value="other">Other</option>
                        </select>
                      </div>
                    </div>
                
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">送出</button>
                  <a class="ml-3 btn btn-primary" href={{ route('admin.permissions.index') }} role="button">返回</a>
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

     var content=$("input[type='text']:first").val();
     $("input[type='text']:first").val("").focus().val(content);
  })
</script>
@endsection