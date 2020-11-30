@extends('admin.layouts.master')
@section('title','首頁')
@section('content')
@section('head')
{{--   <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js" integrity="sha512-LGXaggshOkD/at6PFNcp2V2unf9LzFq6LE+sChH7ceMTDP0g2kn6Vxwgg7wkPP7AAtX+lmPqPdxB47A0Nz0cMQ==" crossorigin="anonymous"></script> --}}
@endsection

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
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <post v-for='(value,index) in posts' v-bind=value :key=index></post>
      <div class="border-bottom" style="padding: 5px" v-if="notFound">搜尋不到相關文章</div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
    <div v-if="notSearching">
      {{ $posts->links() }}
    </div>
  </div>
  
  @endsection

  @section('footer')
  @endsection

  @push('script')


  @endpush
