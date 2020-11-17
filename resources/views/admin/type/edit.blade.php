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
            <h1><b>變更類型</b></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">類型</a></li>
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
              <form role="form" method="POST" action=" {{ route('admin.types.update',$type->id) }} }}">
                @csrf
                @method('PATCH')
                <div class="card-body">
                  <div class="col-lg-6 form-group">
                        <label for="exampleInputEmail1">類型</label>
                        <input name="name" type="text" class="form-control" id="exampleInputEmail1" value="{{ $type->name }}" >
                      </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">送出</button>
                 <a class="ml-3 btn btn-primary" href={{ route('admin.types.index') }} role="button">返回</a>
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