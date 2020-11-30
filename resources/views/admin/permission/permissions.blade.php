@extends('admin.layouts.master')
@section('title','許可')
@section('head')
<link rel="stylesheet" href={{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}>
<link rel="stylesheet" href={{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}>
@endsection

@section('content')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><b>許可</b> <a class="float-right btn btn-info" href={{ route('admin.permissions.create') }} role="button">新許可</a></h1>

          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href={{ route('admin.home') }}>首頁</a></li>
              <li class="breadcrumb-item active">許可</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>

              @if(count($errors)>0)
                @foreach($errors->all() as $error)
                    <div class="row">
                      <div class="offset-lg-2 col-lg-6">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong> {{ $error }}</strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      </div>
                  </div>
              @endforeach
            @endif

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  @include('message')
                  <thead>
                  <tr>
                    <th>順序</th>
                    <th>名稱</th>
                    <th>Permission For</th>
                    <th>編輯</th>
                    <th>刪除</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($permissions as $permission)
                    <tr>
                        <td>{{ ($loop->index)+1 }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->for }}</td>
                        <td><a href={{ route('admin.permissions.edit',$permission->id) }}><i class="ml-3 fas fa-edit"></i></a></td>
                        <td><a  id="submit{{ $permission->id }}" onclick="event.preventDefault();if(confirm('是否要刪除?')){document.getElementById('delete{{ $permission->id}}').submit();}" href="#"><i style="color: firebrick;" class="ml-3 fas fa-trash-alt"></i></a>
                    <form id="delete{{ $permission->id}}" style="display: hidden" class="delete" action={{ route('admin.permissions.destroy',$permission->id) }} method="POST">
                    @csrf
                    @method('DELETE')
                    </form></td>
                      </tr>
                  @endforeach
                  

                  </tbody>
                  <tfoot>
                  <tr>
                  <th>順序</th>
                    <th>名稱</th>
                    <th>Permission For</th>
                    <th>編輯</th>
                    <th>刪除</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
{{--               <div class="offset-lg-3 mt-3">
                {{ $permissions->links() }}
              </div> --}}
            </div>
            <!-- /.card -->


          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
    @endsection
    @section('footer')
		<script src={{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}></script>
		<script src={{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}></script>
		<script src={{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}></script>
		<script src={{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}></script>
		<script>
      $(function () {
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "pageLength": 5,
          "searching": true,
          "ordering": true,
          "info": false,
          "autoWidth": false,
          "responsive": true,
          "language": {
              "emptyTable":"無相關資料",
              "search":"搜尋:",
              "paginate": {
                "first":"第一頁",
                "last":"最後一頁",
                "next":"下一頁",
                "previous":"上一頁"
            },
          }
        });
      });
</script>
    @endsection